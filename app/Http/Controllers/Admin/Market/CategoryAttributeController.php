<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Admin\Market\CategoryAttribute;
use App\Models\Admin\Market\ProductCategory;
use Illuminate\Http\Request;
use function redirect;
use function view;

class CategoryAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.admin.market.Attribute.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('layouts.admin.market.Attribute.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        CategoryAttribute::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'unit' => $request->unit,
        ]);

        return redirect()->route('market.attributes.index')
            ->with('success', 'Attribute successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryAttribute $attribute)
    {
        $categories = ProductCategory::all();
        return view('layouts.admin.market.Attribute.show', ['attribute' => $attribute, 'categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryAttribute $attribute)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryAttribute $attribute)
    {

        try {
            $attribute->category_id = $request->category_id;
            $attribute->name = $request->name;
            $attribute->unit = $request->unit;
            $attribute->save();
            return redirect()->route('market.attributes.index')
                ->with('success', 'Attribute successfully updated.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->route('market.attributes.index')
                ->with('error', 'Failed to update the attribute.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryAttribute $attribute)
    {
        $attribute->delete();
        return redirect()->route('market.attributes.index')
            ->with('success', 'Attribute successfully deleted.');
    }
}
