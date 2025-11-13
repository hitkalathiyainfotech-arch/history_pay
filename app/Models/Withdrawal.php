<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    public $table = 'withdrawals';

    protected $with = ['user'];
    public $fillable = [
        'user_id',
        'amount',
        'address',
        'time',
        'status',
        'coin_name',
        'app_id',        
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
