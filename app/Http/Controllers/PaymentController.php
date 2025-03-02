<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payable;

class PaymentController extends Controller
{
    public function show(){
        $payments = Payable::where('status', 'Approved')->get();
        return view('payment', compact('payments'));
    }
}
