<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public static function updateCartUserIdForGuest($guestIdentifier, $userId)
    {
        $cart = Cart::where('guest_identifier', $guestIdentifier)
            ->whereNull('user_id')
            ->first();
            
        if ($cart) {
            $cart->update(['user_id' => $userId, 'guest_identifier' => null]);
        }
        
        return $cart;
    }

    public static function getGuestId(){
        return request()->cookie('guest_identifier');
    }

    public static function isLoggedIn(){
        if (Auth::check()) {
            return true;
        }
        return false;
    }
}
