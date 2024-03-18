<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Admin\Market\CategoryAttribute;
use App\Models\Admin\Market\CategoryValue;
use App\Models\Admin\Market\Product;
use Illuminate\Http\Request;
use function redirect;
use function view;

class CategoryValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryAttribute $attribute)
    {
        return view('layouts.admin.market.Attribute.value.index', ['attribute' => $attribute]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CategoryAttribute $attribute)
    {
        return view('layouts.admin.market.Attribute.value.create', ['attribute' => $attribute]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CategoryAttribute $attribute)
    {
        $value = json_encode(['value' => $request->value, 'price_inc' => $request->price_inc]);

        CategoryValue::create([
            'product_id' => $request->product_id,
            'category_attribute_id' => $attribute->id,
            'value' => $value,
        ]);

        return redirect()->route('market.attributes.value.index', $attribute->id)
            ->with('success', 'Product successfully updated.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryAttribute $attribute, CategoryValue $value)
    {
        return view('layouts.admin.market.Attribute.value.show', ['value' => $value, 'attribute' => $attribute]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryValue $categoryValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryAttribute $attribute, CategoryValue $value)
    {
        try {
            $value->update([
                'product_id' => $request->input('product_id'),
                'category_attribute_id' => $attribute->id,
                'value' => json_encode(['value' => $request->input('value'), 'price_inc' => $request->input('price_inc')])
            ]);

            return redirect()->route('market.attributes.value.index', $attribute->id)
                ->with('success', 'Value successfully updated.');
        } catch (\Exception $e) {
            \Log::error('updatingError', $e->getMessage());
            return redirect()->route('market.attributes.value.index', $attribute->id)
                ->with('error', 'Failed to update value.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryAttribute $attribute, CategoryValue $value)
    {
        try {
            $value->delete();
            return redirect()->route('market.attributes.value.index', $attribute->id)
                ->with('success', 'Value successfully deleted.');
        } catch (\Exception $e) {
            \Log::error('deletingError', $e->getMessage());
            return redirect()->route('market.attributes.value.index', $attribute->id)
                ->with('error', 'Failed to delete value.');
        }
    }

}
