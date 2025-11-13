<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public $table = 'message';

    public $fillable = [
        'user_id',
        'query_id',
        'app_id',
        'num',
        'message',
        'photo'
    ];
}
