<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receivable extends Model
{
    use HasFactory;

    protected $table = 'receivables';

    protected $fillable = [
        'sender_name',
        'sender_id',
        'transaction_id',
        'description',
        'amount',
        'payment_method',
        'payment_date',
        'due_date',
        'transaction_type',
        'status',
    ];
}
