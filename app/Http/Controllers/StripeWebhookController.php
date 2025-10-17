<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (\UnexpectedValueException $e) {
            Log::error('Invalid payload: ' . $e->getMessage());
            return response('Invalid payload', 400);
        } catch (SignatureVerificationException $e) {
            Log::error('Invalid signature: ' . $e->getMessage());
            return response('Invalid signature', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $this->handlePaymentIntentSucceeded($event->data->object);
                break;
            case 'payment_intent.payment_failed':
                $this->handlePaymentIntentFailed($event->data->object);
                break;
            default:
                Log::info('Unhandled event type: ' . $event->type);
        }

        return response('OK', 200);
    }

    private function handlePaymentIntentSucceeded($paymentIntent)
    {
        Log::info('Payment succeeded: ' . $paymentIntent->id);
        
        // Find order by payment ID and update status
        $order = Order::where('payment_id', $paymentIntent->id)->first();
        
        if ($order) {
            $order->update([
                'payment_status' => Order::PAYMENT_STATUS_PAID,
                'gateway_response' => $paymentIntent
            ]);
            
            Log::info('Order payment status updated: ' . $order->order_number);
        }
    }

    private function handlePaymentIntentFailed($paymentIntent)
    {
        Log::info('Payment failed: ' . $paymentIntent->id);
        
        // Find order by payment ID and update status
        $order = Order::where('payment_id', $paymentIntent->id)->first();
        
        if ($order) {
            $order->update([
                'payment_status' => Order::PAYMENT_STATUS_FAILED,
                'gateway_response' => $paymentIntent
            ]);
            
            Log::info('Order payment status updated to failed: ' . $order->order_number);
        }
    }
}
