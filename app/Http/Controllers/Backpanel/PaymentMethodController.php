<?php

namespace App\Http\Controllers\Backpanel;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use DB;
class PaymentMethodController extends Controller
{
    public function index()
    {      
        $paymentMethods = PaymentMethod::all();
        return view('backpanel.payments.payment_methods.index', compact('paymentMethods'));
    }

    // Store a new payment method
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'type' => 'required|in:bank,ewallet',
        ]);

        PaymentMethod::create($request->all());
        return redirect()->back()->with('success', 'Payment method created successfully.');
    }

    // Update an existing payment method
    public function update(Request $request, $id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'type' => 'required|in:bank,ewallet',
        ]);

        $paymentMethod->update($request->all());
        return redirect()->back()->with('success', 'Payment method updated successfully.');
    }

    // Delete a payment method
    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->delete();
        return redirect()->back()->with('success', 'Payment method deleted successfully.');
    }
}
