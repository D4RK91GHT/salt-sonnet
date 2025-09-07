<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemVariationType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ItemVariationTypeController extends Controller
{
    public function index()
    {
        $variationTypes = ItemVariationType::all();
        return view('admin.item-variation-types', compact('variationTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'is_required' => 'required',
        ]);

        ItemVariationType::create($request->all());

        return redirect()->route('admin.item-variation-types')->with('success', 'Item variation type created successfully');
    }

    public function update(Request $request, ItemVariationType $variationType)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'is_required' => 'required',
        ]);

        $variationType->update($request->all());

        return redirect()->route('admin.item-variation-types')->with('success', 'Item variation type updated successfully');
    }

    public function destroy(ItemVariationType $variationType)
    {
        try {
            // Try to find the model fresh from database
            $model = ItemVariationType::find($variationType->id);
            
            if (!$model) {
                return redirect()->back()->with('error', 'Record not found');
            }

            // Try to delete
            $deleted = $model->delete();
            
            if ($deleted) {
                return redirect()->route('admin.item-variation-types')
                    ->with('success', 'Item variation type deleted successfully');
            }
            
            return redirect()->back()
                ->with('error', 'Failed to delete item variation type');
                
        } catch (\Exception $e) {
            Log::error('Delete error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
