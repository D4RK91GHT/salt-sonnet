<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GSTSlab;

class GSTSlabController extends Controller
{
    public function index()
    {
        $gstSlabs = GSTSlab::all();
        return view('admin.gst-slabs', compact('gstSlabs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'percentage' => 'required',
            'description' => 'nullable',
        ]);

        GSTSlab::create([
            'percentage' => $request->percentage,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.gst-slabs')->with('success', 'GST Slab created successfully');
    }
}
