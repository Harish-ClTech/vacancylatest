<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyDetail extends Model
{
    use HasFactory;
    protected $table = 'applydetails';
    public $timestamps = false;
    protected $fillable = [
        'applymasterid',
        'jobpostid',
        'vacancnumber',
        'vacancyrate',
        'status',
        'postedby',
        'posteddatetime',
        'lastmodifiedby',
        'lastmodifieddatetime',
        'ipaddress',
        'devices',
        'symbolnumber',
    ];

}
