<?php

namespace App\Http\Controllers\Backpanel;

use App\Http\Controllers\Controller;
use App\Models\PaymentAccount;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentAccountController extends Controller
{
    public function index()
    {
        $accounts = PaymentAccount::with('paymentMethod')->get();
        return view('backpanel.payments.payment_accounts.index', compact('accounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method_id' => 'required|exists:payment_methods,id',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255|unique:payment_accounts,account_number',
            'account_status' => 'required|in:0,1',
        ]);

        PaymentAccount::create($request->all());
        return redirect()->back()->with('success', 'Payment account added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'payment_method_id' => 'required|exists:payment_methods,id',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255|unique:payment_accounts,account_number,' . $id,
            'account_status' => 'required|in:0,1',
        ]);

        $account = PaymentAccount::findOrFail($id);
        $account->update($request->all());

        return redirect()->back()->with('success', 'Payment account updated successfully.');
    }

    public function destroy($id)
    {
        $account = PaymentAccount::findOrFail($id);
        $account->delete();

        return redirect()->back()->with('success', 'Payment account deleted successfully.');
    }
}
