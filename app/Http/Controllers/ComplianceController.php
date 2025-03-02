<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payable;
use Illuminate\Support\Carbon;

class ComplianceController extends Controller
{
    public function approve($id)
{
    $payable = Payable::findOrFail($id);
    $payable->status = 'Approved';
    $payable->releasing_date = Carbon::now(); // Set current date and time
    $payable->save();

    return response()->json([
        'success' => true,
        'message' => 'Payable approved successfully.',
        'releasing_date' => $payable->releasing_date->format('m/d/Y'),
        'status' => $payable->status
    ]);
}
    public function show(){
        $compliance = Payable::where('status', 'Approved')->get(); // Only fetch approved records
        return view('compliance', compact('compliance'));
    }

}
