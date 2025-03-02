<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receivable;
use Illuminate\Support\Carbon;

class CollectedController extends Controller
{
        public function show()
    {
        $collected = Receivable::where('status', 'Completed')->get();


        foreach ($collected as $receivable) {
            $dueDate = Carbon::parse($receivable->due_date);
            $currentDate = Carbon::now();
            $interest = 0;
            if ($currentDate->greaterThanOrEqualTo($dueDate)) {

                $weeksOverdue = $dueDate->diffInWeeks($currentDate);
                $interest = $receivable->amount * (0.12 * $weeksOverdue);
            }
            $receivable->total_amount = $receivable->amount + $interest;
            $receivable->interest = $interest;
        }

        return view('collected', compact('collected'));
    }
}
