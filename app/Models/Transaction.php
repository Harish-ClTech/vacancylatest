<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'userid',
        'transactioncode',
        'status',
        'usedthrough',
        'amount',
        'ipaddress',
        'vacancyid',
        'referenceid',
        'designationid',
        'purchasedatetime',
        'created_at',
        'updated_at',
    ];
}
