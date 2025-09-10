<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Cart;

class CheckoutPageController extends Controller
{
    public function checkoutPage(Request $request)
    {
        // Get the guest identifier from the cookie
        $guestId = $request->cookie('guest_identifier');
        
        // Initialize empty cart data
        $cart = null;
        $items = collect();
        $cartTotal = 0;
        
        if ($guestId) {
            // Find the cart for this guest
            $cart = Cart::with(['items.menuItem.images', 'items.variations'])
                ->where('guest_identifier', $guestId)
                ->first();
                
            if ($cart) {
                $items = $cart->items;
                // Calculate cart total

                
                $cartTotal = $items->sum(function($item) {
                    return $item->quantity * $item->variations->first()->price;
                });
            }
        }

        return view('web.checkout', [
            'guestId' => $guestId,
            'cart' => $cart,
            'items' => $items,
            'cartTotal' => $cartTotal
        ]);
    }
}
