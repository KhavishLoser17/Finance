<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receivable;
use Illuminate\Support\Carbon;

class FinanceController extends Controller
{
    public function show()
{
    $receivables = Receivable::where('status', 'Pending')->get();
    return view('receivables', compact('receivables'));
}
        public function approve($id)
        {
            $receivable = Receivable::findOrFail($id);
            $receivable->status = 'Completed';
            $receivable->payment_date = Carbon::now();
            $receivable->save();

            return redirect()->back()->with('success', 'Receivable approved successfully.');
        }
}
