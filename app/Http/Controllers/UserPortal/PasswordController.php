<?php

namespace App\Http\Controllers\UserPortal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PasswordController extends Controller
{
    public function index(Request $request): View{
        return view('web.user-portal.password')->with('user', $request->user());
    }
}
