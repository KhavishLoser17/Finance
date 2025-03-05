<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Allocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'department',
        'description',
        'amount',
        'payment_method',
        'date',
        'transaction_type',
    ];
}
