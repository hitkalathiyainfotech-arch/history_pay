<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public $table = 'purchase';

    public $fillable = [
        'app_id',
        'email',
        'mobile',
        'plan_name',
        'price',
        'status',
        'app_name',
        'transaction_key',
        'response',
        'payment_getway',
        'date'
    ];
}
