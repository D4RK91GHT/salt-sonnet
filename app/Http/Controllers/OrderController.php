<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Http\Exceptions\NotAuthenticated;
use App\Services\PaymentService;
use App\Services\MailService;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index(Request $request)
    {
            $orders = Order::with('items.menuItem.primaryImage', 'items.variations')->where('user_id', Auth::user()->id)->paginate(10);

            // dd($orders);
        // $query = Order::with(['user', 'items.menuItem', 'items.variations']);

        // // Filter by user if authenticated
        // if (Auth::check()) {
        //     $query->where('user_id', Auth::id());
        // } elseif ($request->has('guest_identifier')) {
        //     $query->where('guest_identifier', $request->guest_identifier);
        // }

        // // Filter by status if provided
        // if ($request->has('status')) {
        //     $query->where('status', $request->status);
        // }

        // // Filter by payment method if provided
        // if ($request->has('payment_method')) {
        //     $query->where('payment_method', $request->payment_method);
        // }

        // $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        // return response()->json([
        //     'success' => true,
        //     'orders' => $orders
        // ]);
        return view('web.user-portal.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['items.menuItem', 'items.variations'])
            ->findOrFail($id);

        // Check if user can view this order
        if (Auth::check() && $order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return response()->json([
            'success' => true,
            'order' => $order
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,ready,delivered,cancelled',
        ]);

        $order = Order::findOrFail($id);

        $order->update([
            'status' => $request->status
        ]);

        // Log status update
        Log::info('Order status updated', [
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'old_status' => $order->getOriginal('status'),
            'new_status' => $request->status,
            'updated_by' => Auth::id() ?? 'system'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully',
            'order' => $order
        ]);
    }

    /**
     * Get COD orders for admin
     */
    public function getCODOrders(Request $request)
    {
        $query = Order::with(['user', 'items.menuItem', 'items.variations'])
            ->where('payment_method', 'cod');

        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            'success' => true,
            'orders' => $orders
        ]);
    }

    public function checkout(Request $request)
    {
        try {

            
            // X-User-Id header should be sent by frontend
            $userId = $request->header('X-User-Id');
            
            // Check if user is authenticated, if not, redirect to login with checkout intent
            if (!$userId) {
                // Store the current URL in the session to redirect back after login
                session(['url.intended' => route('checkout')]); // Make sure 'checkout.page' matches your actual checkout route name
                throw new NotAuthenticated("User is not authenticated", 1); 
            }
            
            $request->validate([
                'customer_name' => 'required|string|max:255',
                'customer_email' => 'required|email|max:255',
                'customer_phone' => 'required|string|max:20',
                'delivery_address' => 'required|string',
                'city' => 'required|string|max:100',
                'postal_code' => 'required|string|max:20',
                'delivery_instructions' => 'nullable|string',
                'payment_method' => 'required|in:cod,card,upi,netbanking,wallet',
                'payment_gateway' => 'nullable|string',
                'payment_id' => 'nullable|string',
                'razorpay_order_id' => 'nullable|string',
                'razorpay_payment_id' => 'nullable|string',
                'razorpay_signature' => 'nullable|string',
                'gateway_response' => 'nullable|array',
            ]);

            DB::beginTransaction();

            
            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'No cart found. Please add items to cart first.'
                ], 400);
            }

            // Get cart with items and variations
            $cart = Cart::with(['items.menuItem', 'items.variations'])
                ->where('user_id', $userId)
                ->first();

            if (!$cart || $cart->items->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart is empty'
                ], 400);
            }

            // Calculate totals
            $subtotal = 0;
            $taxAmount = 0;

            foreach ($cart->items as $cartItem) {
                // Get base price from menu item
                $basePrice = $cartItem->menuItem->price ?? 0;

                // Add variation prices
                $variationsPrice = $cartItem->variations->sum('price');

                $itemTotal = ($basePrice + $variationsPrice) * $cartItem->quantity;
                $subtotal += $itemTotal;

                // Calculate tax (assuming GST from menu item)
                if ($cartItem->menuItem->gst) {
                    $taxAmount += $itemTotal * ($cartItem->menuItem->gst / 100);
                }
            }

            $deliveryFee = 0; // You can add delivery fee logic here
            $totalAmount = $subtotal + $taxAmount + $deliveryFee;

            // Handle payment processing
            $paymentData = $this->handlePayment($request, $totalAmount);

            // Create order
            $order = Order::create([
                'user_id' => $userId,
                'status' => Order::STATUS_PENDING,
                'subtotal' => $subtotal,
                'tax_amount' => $taxAmount,
                'delivery_fee' => $deliveryFee,
                'total_amount' => $totalAmount,
                'delivery_address' => $request->delivery_address,
                'delivery_phone' => $request->customer_phone,
                'delivery_instructions' => $request->delivery_instructions,
                'payment_method' => $request->payment_method,
                'payment_status' => $paymentData['status'],
                'payment_gateway' => $paymentData['gateway'],
                'payment_id' => $paymentData['payment_id'],
                'gateway_response' => $paymentData['response'],
                'notes' => "Customer: {$request->customer_name} ({$request->customer_email})",
            ]);

            // Create order items
            foreach ($cart->items as $cartItem) {
                $basePrice = $cartItem->menuItem->price ?? 0;
                $variationsPrice = $cartItem->variations->sum('price');
                $unitPrice = $basePrice + $variationsPrice;
                $totalPrice = $unitPrice * $cartItem->quantity;

                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $cartItem->menu_item_id,
                    'quantity' => $cartItem->quantity,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'special_instructions' => $cartItem->special_instructions ?? null,
                ]);

                // Attach variations to order item
                if ($cartItem->variations->isNotEmpty()) {
                    foreach ($cartItem->variations as $variation) {
                        $orderItem->variations()->attach($variation->id, [
                            'variation_price' => $variation->price
                        ]);
                    }
                }
            }

            // Clear the cart after successful order creation
            $cart->items()->delete();
            $cart->delete();

            DB::commit();

            // Send order confirmation email
            $mailService = new MailService();
            $mailService->sendOrderConfirmationAsync($order, $request->customer_email, $request->customer_name);

            // Log successful order creation
            Log::info('Order created successfully', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'payment_method' => $order->payment_method,
                'total_amount' => $order->total_amount,
                'customer_email' => $request->customer_email
            ]);

            return response()->json([
                'success' => true,
                'message' => $request->payment_method === 'cod' 
                    ? 'Order placed successfully! You will pay cash on delivery.' 
                    : 'Order placed successfully!',
                'order' => [
                    'id' => $order->id,
                    'order_number' => $order->order_number,
                    'total_amount' => $order->total_amount,
                    'status' => $order->status,
                    'payment_status' => $order->payment_status,
                    'payment_method' => $order->payment_method,
                ]
            ], 201);

        } catch (NotAuthenticated $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'redirect' => route('login')
            ], 401);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order creation failed: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to place order. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    private function handlePayment($request, $amount)
    {
        $paymentMethod = $request->payment_method;
        $gatewayResponse = null;
        $paymentId = null;
        $paymentStatus = Order::PAYMENT_STATUS_PENDING;
        $gateway = null;

        switch ($paymentMethod) {
            case 'cod':
                // Cash on Delivery - no payment processing needed
                $paymentStatus = Order::PAYMENT_STATUS_PENDING;
                $gateway = 'cod';
                $gatewayResponse = [
                    'method' => 'cod',
                    'status' => 'pending',
                    'amount' => $amount,
                    'currency' => 'INR',
                    'notes' => 'Payment to be collected on delivery'
                ];
                Log::info('COD order processed', [
                    'amount' => $amount,
                    'customer_email' => $request->customer_email
                ]);
                break;

            case 'card':
            case 'upi':
            case 'netbanking':
            case 'wallet':
                try {
                    // Initialize payment service
                    $paymentService = new PaymentService();

                    if ($request->razorpay_payment_id && $request->razorpay_order_id && $request->razorpay_signature) {
                        // Verify Razorpay payment
                        $attributes = [
                            'razorpay_order_id' => $request->razorpay_order_id,
                            'razorpay_payment_id' => $request->razorpay_payment_id,
                            'razorpay_signature' => $request->razorpay_signature
                        ];

                        if ($paymentService->verifyPaymentSignature($attributes)) {
                            $paymentId = $request->razorpay_payment_id;
                            $paymentStatus = Order::PAYMENT_STATUS_PAID;
                            $gateway = 'razorpay';
                            $gatewayResponse = $attributes;
                            
                            Log::info('Razorpay payment verified successfully', [
                                'payment_id' => $paymentId,
                                'amount' => $amount
                            ]);
                        } else {
                            $paymentStatus = Order::PAYMENT_STATUS_FAILED;
                            $gateway = 'razorpay';
                            $gatewayResponse = ['error' => 'Payment signature verification failed'];
                            
                            Log::error('Razorpay payment signature verification failed', [
                                'attributes' => $attributes
                            ]);
                        }
                    } else {
                        // Fallback to test payment
                        $paymentIntent = $paymentService->simulateTestPayment($amount, 'INR');
                        $paymentId = $paymentIntent['id'];
                        $paymentStatus = $paymentIntent['status'] === 'captured' ? Order::PAYMENT_STATUS_PAID : Order::PAYMENT_STATUS_FAILED;
                        $gateway = 'razorpay_test';
                        $gatewayResponse = $paymentIntent;
                    }

                } catch (\Exception $e) {
                    Log::error('Payment processing failed: ' . $e->getMessage());
                    $paymentStatus = Order::PAYMENT_STATUS_FAILED;
                    $gateway = 'razorpay';
                    $gatewayResponse = ['error' => $e->getMessage()];
                }
                break;

            default:
                $paymentStatus = Order::PAYMENT_STATUS_FAILED;
                $gateway = 'unknown';
                $gatewayResponse = ['error' => 'Unknown payment method'];
                break;
        }

        return [
            'status' => $paymentStatus,
            'gateway' => $gateway,
            'payment_id' => $paymentId,
            'response' => $gatewayResponse,
        ];
    }
}
