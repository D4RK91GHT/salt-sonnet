<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemVariation;

class ItemVariationController extends Controller
{
    // public function index()
    // {
    //     $itemVariations = ItemVariation::all();
    //     return view('admin.item-variations', compact('itemVariations'));
    // }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'variation_type_id' => 'required|exists:variation_types,id',
            'menu_item_id' => 'required|exists:menu_items,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'is_default' => 'boolean',
            'is_active' => 'boolean',
        ]);

        ItemVariation::create($request->all());

        // return redirect()->route('admin.menu-items')->with('success', 'Item variation created successfully');
        return response()->json([
            'success' => true,
            'message' => 'Item variation created successfully',
        ]);
    }

    public function update(Request $request, ItemVariation $itemVariation)
    {
        $request->validate([
            'variation_type_id' => 'required|exists:variation_types,id',
            'menu_item_id' => 'required|exists:menu_items,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'is_default' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        $itemVariation->update($request->all());

        // return redirect()->route('admin.menu-items')->with('success', 'Item variation updated successfully');
        return response()->json([
            'success' => true,
            'message' => 'Item variation updated successfully',
        ]);
    }

    public function destroy(ItemVariation $itemVariation)
    {
        $itemVariation->delete();

        // return redirect()->route('admin.item-variations')->with('success', 'Item variation deleted successfully');
        return response()->json([
            'success' => true,
            'message' => 'Item variation deleted successfully',
        ]);
    }
}
