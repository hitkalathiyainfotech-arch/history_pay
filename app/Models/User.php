<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Traits\HasPermissionsTrait;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable,HasFactory ,HasPermissionsTrait;

    public $table = 'users';

    // protected $with = ['mining','subscription'];


    protected $fillable = [
        'first_name',
        'last_name',
        'role',
        'country',
        'UID',
        'referral_code',
        'mining_point',
        'referral_by',
        'login_with',
        'email',
        'password',
        'app_id',
        'user_key',
        'plan_id',
        'google2fa_secret',
        'email_verification'
    ];

     protected $hidden = [
        'password',
        'remember_token',
        'google2fa_secret'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function mining()
    {
        return $this->hasOne(Mining::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function referredUsers()
    {
        return $this->belongsToMany(User::class,'referrals','user_id','ref_user_id');
    }

    public function refUsers()
    {
        return $this->belongsToMany(User::class,'referrals','ref_user_id','user_id');
    }

    public function user_role()
    {
        return $this->belongsTomany(Role::class,'users_roles');
    }


    // public function devices()
    // {
    //     return $this->hasMany(Device::class);
    // }


//     public function sessions()
// {
//     return $this->hasMany(Session::class);
// }
}
