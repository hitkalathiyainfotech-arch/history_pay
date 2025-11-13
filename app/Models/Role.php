<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug'];

    // public function syncPermissions(array $permissionIds)
    // {
    //     $this->permissions()->sync($permissionIds);
    // }
    
    public function permission(){
        return $this->belongsTomany(Permission::class,'roles_permissions');
    }

    public function users(){
        return $this->belongsTomany(User::class,'users_roles');
    }

    public function savepermissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
