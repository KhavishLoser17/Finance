<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payable extends Model
{
    use HasFactory;

    protected $table = 'payables';

    // Mass assignable attributes
    protected $fillable = [
        'employee_name',
        'transaction_id',
        'description',
        'request_by',
        'request_date',
        'evidence',
        'amount',
        'payment_method',
        'transaction_type',
        'status',
    ];
}
