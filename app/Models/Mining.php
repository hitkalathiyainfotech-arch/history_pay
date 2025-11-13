<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mining extends Model
{
    use HasFactory;

    public $table = 'minings';

    public $fillable = [
        'mining_point',
        'session_start_time',
        'session_end_time',
        'mining_speed',
        'purchase_start_time',
        'purchase_expire_time',
        'has_rate_speed',
        'current_end_time',
        'reward_point',
        'app_id',
        'user_id',
        'is_mining',
    ];
}
