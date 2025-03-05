<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payable;
use App\Models\Receivable;
use App\Models\Tax;
use App\Models\Reimburse;
use App\Models\CompanyEquity;
use App\Models\Allocation;
use Illuminate\Support\Collection;


class LedgerController extends Controller
{
    public function show(Request $request)
{

    $month = $request->query('month', '2025-01');


    $sheetNo = 'GL-' . str_replace('-', '', $month) . '-001';
    

    $payables = Payable::where('status', 'Approved')
        ->whereYear('created_at', substr($month, 0, 4))
        ->whereMonth('created_at', substr($month, 5, 2))
        ->select('transaction_id', 'description', 'created_at as date', 'transaction_type', 'amount')
        ->get();

    $receivables = Receivable::where('status', 'Completed')
        ->whereYear('created_at', substr($month, 0, 4))
        ->whereMonth('created_at', substr($month, 5, 2))
        ->select('transaction_id', 'description', 'created_at as date', 'transaction_type', 'amount')
        ->get();

        $taxes = Tax::whereYear('created_at', substr($month, 0, 4))
        ->whereMonth('created_at', substr($month, 5, 2))
        ->where('status', 'Approved')
        ->select('transaction_id', 'description', 'created_at as date', 'transaction_type', 'amount')
        ->get();


    $equities = CompanyEquity::where('status', 'Approved')
        ->whereYear('date', substr($month, 0, 4))
        ->whereMonth('date', substr($month, 5, 2))
        ->select('transaction_id', 'description', 'date', 'transaction_type', 'amount')
        ->get();

    $reimburse = Reimburse::where('status', 'Approved')
        ->whereYear('created_at', substr($month, 0, 4))
        ->whereMonth('created_at', substr($month, 5, 2))
        ->select('transaction_id', 'description', 'created_at as date', 'transaction_type', 'amount')
        ->get();

        $allocations = Allocation::whereYear('date', substr($month, 0, 4))
        ->whereMonth('date', substr($month, 5, 2))
        ->select('date', 'transaction_id', 'amount', 'description','transaction_type')
        ->get();


    $ledgerEntries = (new Collection())
        ->merge($payables)
        ->merge($receivables)
        ->merge($taxes)
        ->merge($equities)
        ->merge($reimburse)
        ->merge($allocations);


    $ledgerEntries = $ledgerEntries->sortBy('date');

    return view('ledger', compact('ledgerEntries', 'sheetNo', 'month'));
}

    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|unique:company_equities',
            'description' => 'required',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|in:Bank Transfer,Cash,Check,E-Wallet',
            'transaction_type' => 'required|in:Debit,Credit',
            'date' => 'required|date',
        ]);

        CompanyEquity::create($request->all());

        return redirect()->back()->with('success', 'Company Equity added successfully!');
    }
}
