<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_name',
        'transaction_id',
        'description',
        'amount',
        'payment_method',
        'schedule_release_date',
        'transaction_type',
        'status',
    ];
}
