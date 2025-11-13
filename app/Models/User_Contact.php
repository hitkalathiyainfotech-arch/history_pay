<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Contact extends Model
{
    use HasFactory;
    protected $table = 'user_contact';
    protected $primaryKey = 'uc_id';
    protected $fillable = [
        'app_id',
        'name',
        'email',
        'subject',
        'msg',
    ];

    protected $casts = [
        'uc_id' => 'string',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
