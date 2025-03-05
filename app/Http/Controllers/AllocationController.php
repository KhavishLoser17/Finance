<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Allocation;
use App\Models\CompanyEquity;
use App\Models\Payable;

class AllocationController extends Controller
{
    public function show(){
        return view('allocation');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'transaction_id'   => 'required|unique:allocations,transaction_id',
            'department' => 'required|string',
            'description'      => 'required',
            'amount'           => 'required|numeric|min:0',
            'payment_method' => 'required|string|in:Bank Transfer,Cash,Check,E-Wallet',
            'date'             => 'required|date',
            'transaction_type' => 'required|string|in:Debit,Credit',
        ]);

        Allocation::create($validatedData);

        return redirect()->back()->with('success', 'Transaction added successfully!');
    }
    public function index(Request $request)
{
    $year = $request->input('year', date('Y'));

    $totalEquity = CompanyEquity::whereYear('date', $year)->sum('amount');

    // Sum allocations based on transaction type
    $hrBalance = Allocation::where('department', 'HR')
        ->whereYear('date', $year)
        ->sum(\DB::raw("CASE WHEN transaction_type = 'Credit' THEN amount ELSE -amount END"));

    $coreBalance = Allocation::where('department', 'CORE')
        ->whereYear('date', $year)
        ->sum(\DB::raw("CASE WHEN transaction_type = 'Credit' THEN amount ELSE -amount END"));

    $logisticBalance = Allocation::where('department', 'Logistics')
        ->whereYear('date', $year)
        ->sum(\DB::raw("CASE WHEN transaction_type = 'Credit' THEN amount ELSE -amount END"));

    // Deductions from approved payables
    $hrDeductions = Payable::whereYear('request_date', $year)
        ->where('status', 'approved')
        ->where('transaction_id', 'LIKE', 'TXN-HR-%')
        ->sum('amount');

    $coreDeductions = Payable::whereYear('request_date', $year)
        ->where('status', 'approved')
        ->where('transaction_id', 'LIKE', 'TXN-CORE-%')
        ->sum('amount');

    $logisticDeductions = Payable::whereYear('request_date', $year)
        ->where('status', 'approved')
        ->where('transaction_id', 'LIKE', 'TXN-LG-%')
        ->sum('amount');

    // Final department balance after deductions
    $hrBalance -= $hrDeductions;
    $coreBalance -= $coreDeductions;
    $logisticBalance -= $logisticDeductions;

    return view('allocation', compact('year', 'totalEquity', 'hrBalance', 'coreBalance', 'logisticBalance'));
}

}
