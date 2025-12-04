<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Exceptions\NotAuthenticated;

class CheckoutPageController extends Controller
{
    public function checkoutPage(Request $request)
    {
        try {

            if (!AppController::isLoggedIn()) {
                session()->put('url.intended', route('checkout'));
                throw new NotAuthenticated("User is not authenticated", 1); 
            }

            $userId = Auth::id();

            // Initialize empty cart data
            $cart = null;
            $items = collect();
            $cartTotal = 0;

            if ($userId) {
                // Find the cart for this user
                $cart = Cart::with(['items.menuItem.images', 'items.variations'])
                    ->where('user_id', $userId)
                    ->first();

                if ($cart) {
                    $items = $cart->items;
                    // Calculate cart total

                    $cartTotal = $items->sum(function ($item) {
                        return $item->quantity * $item->variations->first()->price;
                    });
                }
            }

            return view('web.checkout', [
                'cart' => $cart,
                'items' => $items,
                'cartTotal' => $cartTotal,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
