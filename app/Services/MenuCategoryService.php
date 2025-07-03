<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\MenuCategory;

class MenuCategoryService
{
    public function index()
    {
        return MenuCategory::all();
    }

    public function show($id)
    {
        return MenuCategory::findOrFail($id);
    }

    public function showBySlug($slug)
    {
        return MenuCategory::where('slug', $slug)->first();
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
