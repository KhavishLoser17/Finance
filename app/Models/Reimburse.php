<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimburse extends Model
{
    use HasFactory;
    protected $table = 'reimburses';
    protected $fillable = [
        'employee_name',
        'transaction_id',
        'request_date',
        'description',
        'evidence',
        'amount',
        'transaction_type',
        'status',
    ];
}
