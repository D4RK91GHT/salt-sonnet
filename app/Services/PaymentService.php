<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class PaymentService
{
    private $api;

    public function __construct()
    {
        $this->api = new Api(
            config('services.razorpay.key_id'),
            config('services.razorpay.key_secret')
        );
    }

    /**
     * Create an order for the given amount
     */
    public function createOrder($amount, $currency = 'INR', $receipt = null, $notes = [])
    {
        try {
            $orderData = [
                'amount' => $amount * 100, // Convert to paise
                'currency' => $currency,
                'receipt' => $receipt ?: 'receipt_' . time(),
                'notes' => $notes
            ];

            $order = $this->api->order->create($orderData);

            return [
                'id' => $order['id'],
                'amount' => $order['amount'],
                'currency' => $order['currency'],
                'receipt' => $order['receipt'],
                'status' => $order['status'],
                'created_at' => $order['created_at']
            ];
        } catch (Exception $e) {
            Log::error('Razorpay Order creation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Verify payment signature
     */
    public function verifyPaymentSignature($attributes)
    {
        try {
            $this->api->utility->verifyPaymentSignature($attributes);
            return true;
        } catch (SignatureVerificationError $e) {
            Log::error('Razorpay Payment signature verification failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Fetch payment details
     */
    public function fetchPayment($paymentId)
    {
        try {
            $payment = $this->api->payment->fetch($paymentId);
            return [
                'id' => $payment['id'],
                'amount' => $payment['amount'],
                'currency' => $payment['currency'],
                'status' => $payment['status'],
                'method' => $payment['method'],
                'order_id' => $payment['order_id'],
                'created_at' => $payment['created_at']
            ];
        } catch (Exception $e) {
            Log::error('Razorpay Payment fetch failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Create a refund
     */
    public function createRefund($paymentId, $amount = null, $notes = [])
    {
        try {
            $refundData = [
                'payment_id' => $paymentId,
                'notes' => $notes
            ];

            if ($amount) {
                $refundData['amount'] = $amount * 100; // Convert to paise
            }

            $refund = $this->api->refund->create($refundData);

            return [
                'id' => $refund['id'],
                'amount' => $refund['amount'],
                'status' => $refund['status'],
                'payment_id' => $refund['payment_id'],
                'created_at' => $refund['created_at']
            ];
        } catch (Exception $e) {
            Log::error('Razorpay Refund creation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Handle test payment simulation
     * For testing purposes, this simulates a successful payment
     */
    public function simulateTestPayment($amount, $currency = 'INR')
    {
        // In test mode, we'll simulate a successful payment
        return [
            'id' => 'pay_test_' . time() . '_' . rand(1000, 9999),
            'status' => 'captured',
            'amount' => $amount * 100, // Convert to paise
            'currency' => $currency,
            'test_mode' => true,
            'created' => time(),
        ];
    }
}
