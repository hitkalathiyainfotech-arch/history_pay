<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryResponse extends Model
{
    use HasFactory;

    public $table = 'query_responce';

    public $fillable = [
        'query_id',
        'message',
        'photo'
    ];
}
