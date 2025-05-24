<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuCategory;

class MenuCategoryController extends Controller
{
    public function index()
    {
        $categories = MenuCategory::all();
        return view('admin.item-category', compact('categories'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $response = MenuCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image->store('menu-categories', 'public'),
        ]);
        
        return redirect()->route('admin.item-category')->with('success', 'Category created successfully');
    }
}
