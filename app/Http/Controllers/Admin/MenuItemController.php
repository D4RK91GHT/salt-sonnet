<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\MenuCategory;
use App\Models\GSTSlab;

class MenuItemController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::with('images')
        ->join('menu_categories', 'menu_items.category_id', '=', 'menu_categories.id')
        ->select('menu_items.*', 'menu_categories.name as category_name')
        ->get();
        
        $categories = MenuCategory::all();
        $gstSlabs = GSTSlab::all();
        return view('admin.menu-items', compact('menuItems', 'categories', 'gstSlabs'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'includes' => 'required|string',
                'category' => 'required|exists:menu_categories,id',
                'description' => 'required|string',
                "mrp" => "required|numeric|min:0",
                "discount" => "required|numeric|min:0|max:100",
                "gst" => "required|numeric|min:0|max:100",
                'images' => 'required|array|min:1',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240'
            ], [
                'images.required' => 'Please upload at least one image.',
                'images.*.image' => 'Each file must be an image.',
                'images.*.mimes' => 'Only jpeg, png, jpg, gif images are allowed.',
                'images.*.max' => 'Each image must not be larger than 10MB.',
            ]);

            // Start database transaction
            DB::beginTransaction();

            try {
                $menuItem = MenuItem::create([
                    'name' => $validated['name'],
                    'category_id' => $validated['category'],
                    'includes' => $validated['includes'],
                    'description' => $validated['description'],
                    'mrp' => $validated['mrp'],
                    'discount' => $validated['discount'],
                    'gst' => $validated['gst'],
                ]);

                // Handle image uploads
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $key => $image) {
                        $path = $image->store('menu-items', 'public');

                        $menuItem->images()->create([
                            'image_path' => $path,
                            'is_primary' => $key === 0,
                            'sort_order' => $key
                        ]);
                    }
                }

                DB::commit();

                return redirect()
                    ->route('admin.menu-items')
                    ->with('success', 'Menu item created successfully!');
            } catch (\Exception $e) {
                dd($e->getMessage());
                DB::rollBack();
                Log::error('Controller Error creating menu item: ' . $e->getMessage());

                return back()
                    ->withInput()
                    ->with('error', 'Failed to create menu item. Please try again. Error: ' . $e->getMessage());
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Validation failed. Please check the form and try again.');
        } catch (\Exception $e) {
            dd($e->getMessage());

            Log::error('Controller Error Unexpected error in menu item creation: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Controller Error An unexpected error occurred. Please try again later.');
        }
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'includes' => 'required|string',
                'category' => 'required|exists:menu_categories,id',
                'description' => 'required|string',
                "mrp" => "required|numeric|min:0",
                "discount" => "required|numeric|min:0|max:100",
                "gst" => "required|numeric|min:0|max:100",
                'images' => 'nullable|array|min:1',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240'
            ]);

            // Start database transaction
            DB::beginTransaction();

            try {
                $menuItem->update([
                    'name' => $validated['name'],
                    'category_id' => $validated['category'],
                    'includes' => $validated['includes'],
                    'description' => $validated['description'],
                    'mrp' => $validated['mrp'],
                    'discount' => $validated['discount'],
                    'gst' => $validated['gst'],
                ]);

                // Handle image updates
                if ($request->hasFile('images')) {
                    // Delete existing images
                    $menuItem->images()->delete();

                    foreach ($request->file('images') as $key => $image) {
                        $path = $image->store('menu-items', 'public');

                        $menuItem->images()->create([
                            'image_path' => $path,
                            'is_primary' => $key === 0,
                            'sort_order' => $key
                        ]);
                    }
                }

                DB::commit();

                return redirect()
                    ->route('admin.menu-items')
                    ->with('success', 'Menu item updated successfully!');
            } catch (\Exception $e) {
                dd($e->getMessage());

                DB::rollBack();
                Log::error('Controller Error updating menu item: ' . $e->getMessage());

                return back()
                    ->withInput()
                    ->with('error', 'Failed to update menu item. Please try again. Error: ' . $e->getMessage());
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->validator->errors());
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Validation failed. Please check the form and try again.');
        } catch (\Exception $e) {
            dd($e->getMessage());

            Log::error('Controller Error Unexpected error in menu item update: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Controller Error An unexpected error occurred. Please try again later.');
        }
    }

    public function destroy(MenuItem $menuItem)
    {
        try {
            $menuItem->delete();

            return redirect()
                ->route('admin.menu-items')
                ->with('success', 'Menu item deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Controller Error deleting menu item: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Failed to delete menu item. Please try again. Error: ' . $e->getMessage());
        }
    }
}
