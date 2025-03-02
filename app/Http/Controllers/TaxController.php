<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tax;

class TaxController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'employee_name' => 'required|string|max:255',
        'transaction_id' => 'required|string|max:255|unique:taxes,transaction_id',
        'description' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0',
        'payment_method' => 'required|in:Bank Transfer,Check,Cash,E-Wallet',
        'schedule_release_date' => 'required|date',
        'transaction_type' => 'required|string|in:Debit,Credit',
        'status' => 'required|string|in:Pending,Approved,Rejected',
    ]);
    Tax::create($request->all());

    return redirect()->back()->with('success', 'Account Payable added successfully.');
}

    public function show(){
        $taxes = Tax::all();
        return view('tax', compact('taxes'));
    }
    
    public function approve($id)
{
    $tax = Tax::findOrFail($id);
    $tax->update(['status' => 'Approved']);

    return redirect()->back()->with('success', 'Transaction approved successfully.');
}

public function reject($id)
{
    $tax = Tax::findOrFail($id);
    $tax->update(['status' => 'Rejected']);

    return redirect()->back()->with('error', 'Transaction rejected.');
}
}
