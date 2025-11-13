<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public $table = 'subscription';

    protected $with = ['plan'];

    public $fillable = [
        'start_time',
        'end_time',
        'has_rate_speed',
        'app_id',
        'plan_id',
        'user_id',
        'start_time_timestamp',
        'end_time_timestamp',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
