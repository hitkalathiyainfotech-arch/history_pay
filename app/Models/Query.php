<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    use HasFactory;

    public $table = 'query';

    public $fillable = [
        'user_id',
        'app_id',
        'title',
        'description'
    ];
}
