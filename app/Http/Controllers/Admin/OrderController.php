<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Get filter parameters
        $status = $request->get('status');
        $paymentStatus = $request->get('payment_status');
        $paymentMethod = $request->get('payment_method');
        $search = $request->get('search');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        // Build query
        $query = Order::with(['user', 'items.menuItem', 'items.variations']);

        // Apply filters
        if ($status) {
            $query->where('status', $status);
        }

        if ($paymentStatus) {
            $query->where('payment_status', $paymentStatus);
        }

        if ($paymentMethod) {
            $query->where('payment_method', $paymentMethod);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('delivery_phone', 'like', "%{$search}%")
                  ->orWhere('delivery_address', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        // Get orders with pagination
        $orders = $query->orderBy('created_at', 'desc')->paginate(15);

        // Get order statistics
        $stats = $this->getOrderStats();

        $statusList = $this->statusList();
        $paymentMethods = $this->paymentMethods();
        $paymentStatusList = $this->paymentStatusList();
        return view('admin.orders', compact('orders', 'stats', 'statusList', 'paymentMethods', 'paymentStatusList'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.menuItem', 'items.variations'])
            ->findOrFail($id);

        return view('admin.order-details', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,ready,delivered,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $oldStatus = $order->status;

        $order->update([
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully',
            'order' => $order
        ]);
    }

    public function markPaymentReceived($id)
    {
        $order = Order::findOrFail($id);

        if ($order->payment_method === 'cod' && $order->payment_status === 'pending') {
            $order->update([
                'payment_status' => 'paid'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment marked as received'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Cannot mark payment as received for this order'
        ], 400);
    }

    public function printOrder($id)
    {
        $order = Order::with(['user', 'items.menuItem', 'items.variations'])
            ->findOrFail($id);

        return view('admin.order-print', compact('order'));
    }

    public function getOrderStats()
    {
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'confirmed_orders' => Order::where('status', 'confirmed')->count(),
            'preparing_orders' => Order::where('status', 'preparing')->count(),
            'ready_orders' => Order::where('status', 'ready')->count(),
            'delivered_orders' => Order::where('status', 'delivered')->count(),
            'cancelled_orders' => Order::where('status', 'cancelled')->count(),
            'cod_orders' => Order::where('payment_method', 'cod')->count(),
            'online_orders' => Order::where('payment_method', '!=', 'cod')->count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total_amount'),
            'pending_payments' => Order::where('payment_status', 'pending')->sum('total_amount'),
        ];

        return $stats;
    }

    public function exportOrders(Request $request)
    {
        // This can be implemented later for CSV/Excel export
        return response()->json(['message' => 'Export feature coming soon']);
    }

    public function statusList(){
        return array_map(function($method){
            return (object) $method;
        }, [
            ['id' => 'pending', 'name' => 'Pending'],
            ['id' => 'confirmed', 'name' => 'Confirmed'],
            ['id' => 'preparing', 'name' => 'Preparing'],
            ['id' => 'ready', 'name' => 'Ready'],
            ['id' => 'delivered', 'name' => 'Delivered'],
            ['id' => 'cancelled', 'name' => 'Cancelled'],
        ]);
    }

    public function paymentStatusList(){
        return array_map(function($method){
            return (object) $method;
        }, [
            ['id' => 'pending', 'name' => 'Pending'],
            ['id' => 'paid', 'name' => 'Paid'],
            ['id' => 'failed', 'name' => 'Failed'],
        ]);
    }


    public function paymentMethods()
    {
        return array_map(function($method) {
            return (object) $method;
        }, [
            ['id' => 'cod', 'name' => 'Cash On Delivery'],
            ['id' => 'card', 'name' => 'Card'],
            ['id' => 'upi', 'name' => 'UPI'],
        ]);
    }
}