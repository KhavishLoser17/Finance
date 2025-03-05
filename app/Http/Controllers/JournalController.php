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

class JournalController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->query('month', '2025-01');

        $sheetNo = 'JNL-' . str_replace('-', '', $month) . '-001';

        // Fetch transactions using request_date and payment_date
                $payables = Payable::where('status', 'Approved')
            ->whereYear('request_date', substr($month, 0, 4))
            ->whereMonth('request_date', substr($month, 5, 2))
            ->select(
                'transaction_id',
                'request_by',
                'description',
                'amount',
                'request_date as date',
                'notes_amount',
                'transaction_type',
                'payment_method',
                'status'
            )
            ->get();


            $receivables = Receivable::where('status', 'Completed')
            ->whereYear('payment_date', substr($month, 0, 4))
            ->whereMonth('payment_date', substr($month, 5, 2))
            ->select(
                'transaction_id',
                'description',
                'amount',
                'notes_amount',
                'payment_date as date',
                'request_by',
                'transaction_type',
                'payment_method',
                'status'
            )
            ->get();

            $taxes = Tax::where('status', 'Approved')
            ->whereYear('schedule_release_date', substr($month, 0, 4))
            ->whereMonth('schedule_release_date', substr($month, 5, 2))
            ->select(
                'transaction_id',
                'description',
                'amount',
                'payment_method',
                'schedule_release_date as date',
                'transaction_type',
                'status'
            )
            ->get();


            $equities = CompanyEquity::where('status', 'Approved')
            ->whereYear('date', substr($month, 0, 4))
            ->whereMonth('date', substr($month, 5, 2))
            ->select(
                'transaction_id',
                'description',
                'amount',
                'payment_method',
                'transaction_type',
                'date as date',
                'status'
            )
            ->get();


            $reimburse = Reimburse::where('status', 'Approved')
            ->whereYear('request_date', substr($month, 0, 4))
            ->whereMonth('request_date', substr($month, 5, 2))
            ->select(
                'transaction_id',
                'description',
                'amount',
                'transaction_type',
                'request_date as date',
                'status'
            )
            ->get();

            $allocations = Allocation::whereYear('date', substr($month, 0, 4))
            ->whereMonth('date', substr($month, 5, 2))
            ->select(
                'transaction_id',
                'description',
                'amount',
                'date',
                'payment_method',
                'transaction_type',
            )
            ->get();




        $journalEntries = (new Collection())
            ->merge($payables)
            ->merge($receivables)
            ->merge($taxes)
            ->merge($equities)
            ->merge($reimburse)
            ->merge($allocations);

        $journalEntries = $journalEntries->sortBy('date');

        return view('journal', compact('journalEntries', 'sheetNo', 'month'));
    }
}
