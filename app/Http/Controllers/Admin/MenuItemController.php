<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\ProductImage;
use App\Models\MenuCategory;
use App\Models\GSTSlab;
use App\Models\ItemVariationType;
use App\Models\ItemVariation;
use App\Http\Controllers\Admin\ItemVariationController;

class MenuItemController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::with('images')
        ->join('menu_categories', 'menu_items.category_id', '=', 'menu_categories.id')
        ->select('menu_items.*', 'menu_categories.name as category_name')
        ->orderBy('menu_items.id', 'desc')
        ->paginate(10);

        // dd($menuItems);
        $categories = MenuCategory::all();
        $gstSlabs = GSTSlab::all();
        $variationTypes = ItemVariationType::all();

        return view('admin.menu-items', compact('menuItems', 'categories', 'gstSlabs', 'variationTypes'));
    }

    public function show(MenuItem $menuItem)
    {
        // dd($menuItem->id);
        $menuItem = MenuItem::with(['images', 'variations'])
            ->join('menu_categories', 'menu_items.category_id', '=', 'menu_categories.id')
            ->select('menu_items.*', 'menu_categories.name as category_name')
            ->where('menu_items.id', $menuItem->id)
            ->first();
            
        $categories = MenuCategory::all();
        $gstSlabs = GSTSlab::all();
        $variationTypes = ItemVariationType::all();
        return view('admin.iframe-pages.item-edit-form', [
            'menuItem' => $menuItem,
            'categories' => $categories,
            'gstSlabs' => $gstSlabs,
            'variationTypes' => $variationTypes,
        ]);
    }
    
    public function store(Request $request)
    {
        // dd($request->variations);
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

                foreach ($request->variations as $variation) {
                    $variation['menu_item_id'] = $menuItem->id;
                    $itemVariationController = app(ItemVariationController::class);
                    $itemVariationController->store(new Request($variation));

                    // ItemVariation::create([
                    //     'variation_type_id' => $variation['type_id'],
                    //     'menu_item_id' => $menuItem->id,
                    //     'name' => $variation['name'],
                    //     'description' => $variation['description'],
                    //     'price' => $variation['price'],
                    //     'is_default' => $variation['is_default'],
                    //     'is_active' => $variation['is_active'],
                    // ]);
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
            dd($e->validator->errors());
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

                // if ($request->hasFile('edit-images')) {
                //     $validated['images'] = $request->file('edit-images');
                // }
                // Handle image updates
                if ($request->hasFile('edit-images')) {
                    // Delete existing images
                    $menuItem->images()->delete();

                    foreach ($request->file('edit-images') as $key => $image) {
                        $path = $image->store('menu-items', 'public');

                        $menuItem->images()->create([
                            'image_path' => $path,
                            'is_primary' => $key === 0,
                            'sort_order' => $key
                        ]);
                    }
                }

                if (isset($request->variations) && count($request->variations) > 0) {
                    foreach ($request->variations as $variation) {
                        $variation['menu_item_id'] = $menuItem->id;

                        if (isset($variation['id']) && $variation['id']) {
                            ItemVariation::where('id', $variation['id'])->update($variation);
                        } else {
                            ItemVariation::create($variation);
                        }
                    }
                }
                
                DB::commit();

                return redirect()
                    ->route('admin.iframe-pages.item-edit-form', $menuItem->id)
                    ->with('success', 'Menu item updated successfully!');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Controller Error updating menu item: ' . $e->getMessage());

                return back()
                    ->withInput()
                    ->with('error', 'Failed to update menu item. Please try again. Error: ' . $e->getMessage());
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Validation failed. Please check the form and try again.');
        } catch (\Exception $e) {

            Log::error('Controller Error Unexpected error in menu item update: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Controller Error An unexpected error occurred. Please try again later.');
        }
    }


    public function destroyImage(ProductImage $image)
    {
        try {
            // Delete the file from storage
            Storage::disk('public')->delete($image->image_path);
            
            // Delete the image record
            $image->delete();
            
            return response()->json(['success' => true, 'message' => 'Image deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    public function destroy(MenuItem $menuItem)
    {
        try {

            // dd($menuItem->images);
            // Delete associated images from storage
            foreach ($menuItem->images as $image) {
                Storage::disk('public')->delete($image->image_path);
            }
            
            // Delete the menu item and its relations
            $menuItem->images()->delete();
            $menuItem->variations()->delete();
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
