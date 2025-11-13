<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    use HasFactory;

    public $table = 'payment_statuses';

    protected $with = ['plan'];

    public $fillable = [
        'plan_id',
        'payment_gateway',
        'gateway_saltkey',
        'gateway_merchantkey',
        'status',
        'user_id',
        'purchase_time',
        'purchase_expire_time',
        'app_id',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
