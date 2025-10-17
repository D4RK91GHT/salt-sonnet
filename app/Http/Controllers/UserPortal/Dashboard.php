<?php

namespace App\Http\Controllers\UserPortal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function index(){
        
        if(Auth::check()){
            return view('web.user-portal.dashboard');
        }

    }
}
