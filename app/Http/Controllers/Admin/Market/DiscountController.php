<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Discount;
use App\Models\User;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.admin.market.Discount.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('layouts.admin.market.Discount.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create a new Discount instance
        $discount = new Discount();
        $discount->discount_code = $request->input('discount_code');
        $discount->start_date = $request->input('start_date');
        $discount->end_date = $request->input('end_date');
        $discount->discount_type = $request->input('discount_type');
        $discount->discount_value = $request->input('discount_value');
        $discount->minimum_order_amount = $request->input('minimum_order_amount');
        $discount->maximum_uses = $request->input('maximum_uses');
        $discount->is_active = $request->has('is_active');
        $discount->is_public = $request->has('is_public');
        $discount->user_id = $request->input('user_id');
        $discount->description = $request->input('description');

        // Save the discount
        $discount->save();

        // Redirect to a success page or perform any additional actions
        return redirect()->route('market.discounts.index')->with('success', 'Discount created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        $users = User::all();
        return view('layouts.admin.market.Discount.show',
            [
                'discount' => $discount,
                'users' => $users
            ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discount $discount)
    {

        // Update the discount with the form data
        $discount->discount_code = $request->input('discount_code');
        $discount->start_date = $request->input('start_date');
        $discount->end_date = $request->input('end_date');
        $discount->discount_type = $request->input('discount_type');
        $discount->discount_value = $request->input('discount_value');
        $discount->minimum_order_amount = $request->input('minimum_order_amount');
        $discount->maximum_uses = $request->input('maximum_uses');
        $discount->is_active = $request->has('is_active');
        $discount->is_public = $request->has('is_public');
        $discount->user_id = $request->input('user_id');
        $discount->description = $request->input('description');

        // Save the updated discount
        $discount->save();

        // Redirect to a success page or perform any additional actions
        return redirect()->route('market.discounts.index')->with('success', 'Discount updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('market.discounts.index')->with('success', 'Discount successfully Deleted.');
    }
}
