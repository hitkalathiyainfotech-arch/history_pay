<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginSession extends Model
{
    use HasFactory;

    public $table = 'login_sessions';
    protected $fillable = ['user_id','session_id','email','is_verified','user_agent','ip_address','last_activity'];
}
