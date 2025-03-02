<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receivable;
use App\Models\Payable;


class ReceivableController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sender_name' => 'required|string|max:255',
            'sender_id' => 'required|string|max:255',
            'transaction_id' => 'required|string|max:255|unique:receivables,transaction_id',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|in:Bank Transfer,Cash,Check',
            'payment_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:payment_date',
            'transaction_type' => 'required|string|in:Debit,Credit',
            'status' => 'required|string|in:Pending,Completed,Overdue',
        ]);

        Receivable::create($validatedData);

        return redirect()->back()->with('success', 'Account Receivable added successfully.');
    }
    public function show()
{
    $payableList = Payable::where('status', 'Pending')->get();
    $receivableList = Receivable::where('status', 'Pending')->get();

    return view('audit', compact('payableList', 'receivableList'));
}

        
}
