<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaymentService;

class RazorpayController extends Controller
{
    public function createOrder(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'currency' => 'required|string|in:INR,USD',
        ]);

        try {
            $paymentService = new PaymentService();
            $order = $paymentService->createOrder(
                $request->amount,
                $request->currency,
                'receipt_' . time(),
                [
                    'source' => 'bistro_app',
                    'guest_id' => $request->header('X-Guest-Id')
                ]
            );

            return response()->json([
                'success' => true,
                'order' => $order
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create payment order',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
