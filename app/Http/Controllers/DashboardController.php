<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payable;
use App\Models\Receivable;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalRevenue = Receivable::where('status', 'COMPLETED')->sum('amount');
        $totalExpenses = Payable::where('transaction_id', 'like', 'TXN-EXP-%')->where('status', 'Approved')->sum('amount');
        return view('dashboard', compact('totalRevenue', 'totalExpenses'));
    }
    public function graph()
{
    $totalRevenue = Receivable::where('status', 'COMPLETED')->sum('amount');
    $totalExpenses = Payable::where('transaction_id', 'like', 'TXN-EXP-%')
                            ->where('status', 'Approved')
                            ->sum('amount');


    $monthlyRevenue = Receivable::selectRaw('MONTH(payment_date) as month, SUM(amount) as total')
                                ->where('status', 'COMPLETED')
                                ->groupBy('month')
                                ->orderBy('month')
                                ->pluck('total', 'month');


    $monthlyExpenses = Payable::selectRaw('MONTH(request_date) as month, SUM(amount) as total')
                              ->where('transaction_id', 'like', 'TXN-EXP-%')
                              ->where('status', 'Approved')
                              ->groupBy('month')
                              ->orderBy('month')
                              ->pluck('total', 'month');

    return view('dashboard', compact('totalRevenue', 'totalExpenses', 'monthlyRevenue', 'monthlyExpenses'));
}
}
