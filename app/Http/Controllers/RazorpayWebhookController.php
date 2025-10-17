<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Services\PaymentService;

class RazorpayWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('X-Razorpay-Signature');
        $webhookSecret = config('services.razorpay.webhook_secret');

        try {
            // Verify webhook signature
            $expectedSignature = hash_hmac('sha256', $payload, $webhookSecret);
            
            if (!hash_equals($expectedSignature, $signature)) {
                Log::error('Razorpay webhook signature verification failed');
                return response('Invalid signature', 400);
            }

            $event = json_decode($payload, true);

            // Handle the event
            switch ($event['event']) {
                case 'payment.captured':
                    $this->handlePaymentCaptured($event['payload']['payment']['entity']);
                    break;
                case 'payment.failed':
                    $this->handlePaymentFailed($event['payload']['payment']['entity']);
                    break;
                default:
                    Log::info('Unhandled Razorpay event: ' . $event['event']);
            }

            return response('OK', 200);
        } catch (\Exception $e) {
            Log::error('Razorpay webhook processing failed: ' . $e->getMessage());
            return response('Error processing webhook', 500);
        }
    }

    private function handlePaymentCaptured($payment)
    {
        Log::info('Payment captured: ' . $payment['id']);
        
        // Find order by payment ID and update status
        $order = Order::where('payment_id', $payment['id'])->first();
        
        if ($order) {
            $order->update([
                'payment_status' => Order::PAYMENT_STATUS_PAID,
                'gateway_response' => $payment
            ]);
            
            Log::info('Order payment status updated: ' . $order->order_number);
        }
    }

    private function handlePaymentFailed($payment)
    {
        Log::info('Payment failed: ' . $payment['id']);
        
        // Find order by payment ID and update status
        $order = Order::where('payment_id', $payment['id'])->first();
        
        if ($order) {
            $order->update([
                'payment_status' => Order::PAYMENT_STATUS_FAILED,
                'gateway_response' => $payment
            ]);
            
            Log::info('Order payment status updated to failed: ' . $order->order_number);
        }
    }
}
