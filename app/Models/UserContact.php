<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserContact extends Model
{
    use HasFactory;

    public $table = 'user_contacts';

    protected $fillable = [
        'app_id',
        'email',
        'mobile'
    ];
}
