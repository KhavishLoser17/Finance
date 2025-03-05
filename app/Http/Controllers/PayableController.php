<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payable;
use App\Models\Receivable;
use App\Models\Reimburse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class PayableController extends Controller
{
    public function index() {
        return view('audit');
    }
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'employee_name' => 'required|string|max:255',
        'transaction_id' => 'required|string|max:255|unique:payables,transaction_id',
        'description' => 'required|string',
        'request_by' => 'required|string',
        'notes_amount' => 'nullable|numeric|min:0',
        'request_date' => 'required|date',
        'evidence' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'amount' => 'required|numeric|min:0',
        'transaction_type' => 'required|string|in:Debit,Credit',
        'payment_method' => 'required|string|in:Bank Transfer,Cash,Check,E-Wallet',
        'status' => 'required|string',
    ]);

    // Handle file upload
    if ($request->hasFile('evidence')) {
        $image = $request->file('evidence');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('pictures'), $imageName);
        $validatedData['evidence'] = 'pictures/' . $imageName;
    }

    // Save data to the database
    Payable::create($validatedData);


    return redirect()->back()->with('success', 'Account Payable added successfully.');
}

public function show()
{
    $payableList = Payable::where('status', 'Pending')->get();
    $receivableList = Receivable::all();
    $reimburseList = Reimburse::all();

    return view('audit', compact('payableList', 'receivableList', 'reimburseList'));
}
        public function approve($id)
            {
                $payable = Payable::findOrFail($id);
                $payable->status = 'Approved';
                $now = Carbon::now();
                if ($now->day < 15) {
                    $requestDate = $now->copy()->day(15);
                } elseif ($now->day < 30) {
                    $requestDate = $now->copy()->day(30);
                } else {
                    $requestDate = $now->addMonth()->day(15);
                }

                $payable->request_date = $requestDate;
                $payable->save();

                return redirect()->back()->with('success', 'Payable approved successfully.');
            }
        public function reject($id)
        {
            $payable = Payable::findOrFail($id);


            if ($payable->status !== 'Pending') {
                return redirect()->back()->with('error', 'This payable cannot be rejected.');
            }
            $payable->update(['status' => 'Rejected']);

            return redirect()->back()->with('success', 'Payable has been rejected.');
        }

}
