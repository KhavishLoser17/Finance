<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reimburse;
use Illuminate\Support\Carbon;

class ReimburseController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_name' => 'required|string|max:255',
            'request_date' => 'required|date',
            'transaction_id' => 'required|string|max:255|unique:reimburses,transaction_id',
            'description' => 'required|string',
            'evidence' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amount' => 'required|numeric|min:0',
            'transaction_type' => 'required|string|in:Debit,Credit',
            'status' => 'required|string|in:Pending,Approved,Rejected'
        ]);

        if ($request->hasFile('evidence')) {
            $image = $request->file('evidence');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/reimbursements'), $imageName);
            $validatedData['evidence'] = 'uploads/reimbursements/' . $imageName;
        }

        Reimburse::create($validatedData);

        return redirect()->back()->with('success', 'Reimbursement request submitted successfully.');
    }
    public function show(){
        $reimburseList = Reimburse::all();
        return view('reimburse', compact('reimburseList'));
    }

    public function approve($id)
    {
        $transaction = Reimburse::findOrFail($id);
        $transaction->status = 'approved';
        $transaction->save();

        return back()->with('success', 'Reimbursement approved successfully!');
    }

    public function reject($id)
    {
        $transaction = Reimburse::findOrFail($id);
        $transaction->status = 'rejected';
        $transaction->save();

        return back()->with('success', 'Reimbursement rejected successfully!');
    }
}
