<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payable;
use App\Models\Receivable;
use App\Models\Reimburse;
use App\Models\CompanyEquity;
use App\Models\Tax;

class TransactionController extends Controller
{
    public function index()
    {
        $payables = Payable::where('status', 'Rejected')->orWhere('status', 'Pending')->get();
        $receivables = Receivable::where('status', 'Rejected')->orWhere('status', 'Pending')->get();
        $reimbursements = Reimburse::where('status', 'Rejected')->orWhere('status', 'Pending')->get();
        $equity = CompanyEquity::where('status', 'Rejected')->orWhere('status', 'Approved')->get();
        $taxes = Tax::where('status', 'Rejected')->orWhere('status', 'Pending')->get();

        $transactions = collect();

        $transactions = $transactions->merge($payables->map(function ($item) {
            return $this->formatTransaction($item, 'Payable');
        }));

        $transactions = $transactions->merge($receivables->map(function ($item) {
            return $this->formatTransaction($item, 'Receivable');
        }));

        $transactions = $transactions->merge($reimbursements->map(function ($item) {
            return $this->formatTransaction($item, 'Reimbursement');
        }));

        $transactions = $transactions->merge($taxes->map(function ($item) {
            return $this->formatTransaction($item, 'Tax');
        }));
        $transactions = $transactions->merge($equity->map(function ($item) {
            return $this->formatTransaction($item, 'equity');
        }));

        return view('transaction', compact('transactions'));
    }

    private function formatTransaction($transaction, $type)
    {
        return [
            'type' => $type,
            'employee_name' => $transaction->employee_name ?? 'N/A',
            'transaction_id' => $transaction->transaction_id ?? 'N/A',
            'description' => $transaction->description ?? 'N/A',
            'requested_by' => $transaction->requested_by ?? 'N/A',
            'request_date' => $transaction->created_at->format('m/d/Y'),
            'evidence' => $transaction->evidence ?? 'N/A',
            'amount' => $transaction->amount ?? 0,
            'status' => $transaction->status,
        ];
    }
}
