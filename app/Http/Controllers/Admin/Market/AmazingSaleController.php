<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Admin\Market\AmazingSale;
use App\Models\Admin\Market\Product;
use Illuminate\Http\Request;

class AmazingSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.admin.market.AmazingSale.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('layouts.admin.market.AmazingSale.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create a new Discount instance
        $amazing_sale = new AmazingSale();

        $amazing_sale->product_id = $request->input('product_id');
        $amazing_sale->start_date = $request->input('start_date');
        $amazing_sale->end_date = $request->input('end_date');
        $amazing_sale->status = $request->input('status');
        $amazing_sale->percentage = $request->input('percentage');

       

        // Save the discount
        $amazing_sale->save();

        // Redirect to a success page or perform any additional actions
        return redirect()->route('market.amazing-sale.index')->with('success', 'Amazing created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AmazingSale $amazingSale)
    {
        $products = Product::all();
        return view('layouts.admin.market.AmazingSale.show',compact('amazingSale','products'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AmazingSale $amazingSale)
    {
        $amazingSale->product_id = $request->input('product_id');
        $amazingSale->start_date = $request->input('start_date');
        $amazingSale->end_date = $request->input('end_date');
        $amazingSale->status = $request->input('status');
        $amazingSale->percentage = $request->input('percentage');

        $amazingSale->save();
        return redirect()->route('market.amazing-sale.index')->with('success', 'Amazing Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AmazingSale $amazingSale)
    {
        $amazingSale->delete();
        return redirect()->route('market.amazing-sale.index')->with('success', 'Amazing Deleted successfully.');

    }
}
