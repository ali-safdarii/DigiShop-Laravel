<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use App\Models\Admin\Payment\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.admin.payment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('layouts.admin.payment.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'user_id' => $request->user_id,
            'payment_amount' => $request->payment_amount,
            'payment_date' => $request->payment_date,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
            'description' => $request->description,
        ];

        $payment = Payment::create($data);

        // Redirect to the appropriate page or perform any additional actions

        return redirect()->route('market.payments.index')->with('success', 'Payment successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $users = User::all();
        return view('layouts.admin.payment.show', ['payment' => $payment, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {

        $payment->user_id = $request->user_id;
        $payment->payment_amount = $request->payment_amount;
        $payment->payment_date = $request->payment_date;
        $payment->payment_method = $request->payment_method;
        $payment->payment_status = $request->payment_status;
        $payment->description = $request->description;
        $payment->save();

        return redirect()->route('market.payments.index')->with('success', 'Payment successfully Updated.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('market.payments.index')->with('success', 'Payment successfully Deleted.');

    }
}
