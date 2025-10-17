<?php

namespace App\Http\Controllers\UserPortal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class Dashboard extends Controller
{
    public function index(){
        
        if(Auth::check()){
            $orders = Order::with('items.menuItem.primaryImage')->where('user_id', Auth::user()->id)->paginate(10);

            // foreach($orders as $order){
            //     // dd($order->items);
            //     foreach ($order->items as $eachitem) {
            //         // print_r($item);
            //         dd($eachitem->menuItem->primaryImage->image_path);
            //     }
            // }
            return view('web.user-portal.dashboard', compact('orders'));
        }

    }
}
