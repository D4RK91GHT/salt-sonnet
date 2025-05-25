<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuItem;

class MenuItemController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::all();
        return view('admin.menu-items', compact('menuItems'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'includes' => 'required',
            'category' => 'required',
            'description' => 'required',
            "mrp" => "required",
            "discount" => "required",
            "rate" => "required",
            "gst" => "required",
            "price" => "required",
        ]);

        MenuItem::create([
            'name' => $request->name,
            'category_id' => $request->category,
            'includes' => $request->includes,
            'description' => $request->description,
            'mrp' => $request->mrp,
            'discount' => $request->discount,
            'rate' => $request->rate,
            'gst' => $request->gst,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.menu-items')->with('success', 'Menu Item created successfully');
    }
}
