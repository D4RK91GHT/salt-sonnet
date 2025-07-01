<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\MenuCategory;

class MenuCategoryController extends Controller
{
    public function index()
    {
        $categories = MenuCategory::all();
        return view('admin.item-category', compact('categories'));
    }

    public function show($id)
    {
        $category = MenuCategory::findOrFail($id);
        return response()->json($category);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        try {
            MenuCategory::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $request->image->store('menu-categories', 'public'),
            ]);
        
            return redirect()->route('admin.item-category')->with('success', 'Category created successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.item-category')->with('error', 'Failed to create category: ' . $e->getMessage());
        }
    }

    public function update(Request $request, MenuCategory $itemCategory)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'edit_name' => 'required|string|max:255',
                'edit_description' => 'required|string',
                'edit_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            DB::beginTransaction();

            try {
                $updateData = [
                    'name' => $validated['edit_name'],
                    'description' => $validated['edit_description'],
                ];

                // Handle image upload if present
                if ($request->hasFile('edit_image')) {
                    try {
                        // Delete old image if exists
                        if ($itemCategory->image) {
                            if (!Storage::disk('public')->delete($itemCategory->image)) {
                                throw new \Exception('Failed to delete old image from storage');
                            }
                        }

                        // Store new image
                        $updateData['image'] = $request->file('edit_image')->store('menu-categories', 'public');
                        if (!$updateData['image']) {
                            throw new \Exception('Failed to store the uploaded image');
                        }
                    } catch (\Exception $e) {
                        throw new \Exception('Image processing failed: ' . $e->getMessage());
                    }
                }

                // Update the category
                $updated = $itemCategory->update($updateData);
                if (!$updated) {
                    throw new \Exception('Failed to update category in database');
                }

                DB::commit();
                return redirect()
                    ->route('admin.item-category')
                    ->with('success', 'Category updated successfully');

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Category update failed: ' . $e->getMessage(), [
                    'category_id' => $itemCategory->id,
                    'exception' => $e
                ]);
                throw $e;
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->with('error', $e->validator->errors())
                ->withInput();

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to update category: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(MenuCategory $itemCategory)
    {
        try {
            Storage::disk('public')->delete($itemCategory->image);
            $itemCategory->delete();
            return response()->json('Category deleted successfully');
        } catch (\Exception $e) {
            return response()->json('Failed to delete category: ' . $e->getMessage());
        }
    }
}
