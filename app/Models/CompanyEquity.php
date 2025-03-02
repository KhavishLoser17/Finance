<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyEquity extends Model
{
    use HasFactory;
    protected $table = 'company_equities';
    protected $fillable = [
        'transaction_id',
        'description',
        'amount',
        'transaction_type',
        'date',
        'status'
    ];
}
