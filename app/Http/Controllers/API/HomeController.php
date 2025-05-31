<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\MenuItem;
use App\Models\MenuCategory;

Class HomeController extends Controller
{
    public function index()
    {
        $items = MenuItem::with('images')->get();
        $categories = MenuCategory::where('status', 1)->get();
        
        return response()->json([
            'message' => 'success',
            'data' => [
                'items' => $items,
                'categories' => $categories,
            ],
        ], 200);
    }
}