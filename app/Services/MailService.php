<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderPlaced;
use App\Models\Order;
use Exception;

class MailService
{
    /**
     * Send order confirmation email
     */
    public function sendOrderConfirmation(Order $order, string $customerEmail, string $customerName): bool
    {
        try {
            $mailable = new OrderPlaced($order, $customerEmail, $customerName);
            
            Mail::to($customerEmail, $customerName)->send($mailable);
            
            Log::info('Order confirmation email sent successfully', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'customer_email' => $customerEmail,
                'customer_name' => $customerName
            ]);
            
            return true;
            
        } catch (Exception $e) {
            Log::error('Failed to send order confirmation email', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'customer_email' => $customerEmail,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return false;
        }
    }
    
    /**
     * Send order confirmation email asynchronously (queued)
     */
    public function sendOrderConfirmationAsync(Order $order, string $customerEmail, string $customerName): void
    {
        try {
            Mail::to($customerEmail, $customerName)
                ->queue(new OrderPlaced($order, $customerEmail, $customerName));
                
            Log::info('Order confirmation email queued successfully', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'customer_email' => $customerEmail,
                'customer_name' => $customerName
            ]);
            
        } catch (Exception $e) {
            Log::error('Failed to queue order confirmation email', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'customer_email' => $customerEmail,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}
