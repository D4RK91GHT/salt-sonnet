<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutPageController extends Controller
{
    public function checkoutPage()
    {
        return view('web.checkout');
    }
}
