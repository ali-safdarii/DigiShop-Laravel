<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        return view('layouts.admin.market.Delivery.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return view('layouts.admin.market.Delivery.form');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       $delivery = Delivery::create([
            'name' => $request->name,
            'status'  => $request->status ,
            'amount'  => $request->amount ,
            'description'  => $request->description,
            'delivery_time'  => null
        ]);

        return redirect()->route('market.delivery.index')
            ->with('success', 'Delivery Succesfull created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Delivery $delivery)
    {
        return view('layouts.admin.market.Delivery.show',['delivery' => $delivery]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delivery $delivery)
    {

          $delivery->update([
            'name' => $request->name,
            'status'  => $request->status ,
            'amount'  => $request->amount ,
            'description'  => $request->description,
        ]);


          return redirect()->route('market.delivery.index')
              ->with('success', 'Delivery updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();
        return redirect()->route('market.delivery.index')
            ->with('success', 'Delivery deleted successfully.');
    }
}
