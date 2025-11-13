<?php

namespace App\Datatable;


use App\Models\Mining;
use App\Models\Setting;
use App\Models\User;
// use Cookie;
use Illuminate\Support\Facades\Cookie;

class PermissionDatatable
{
    public function get($input = [])
    {
        /** @var User $query */


        $query = User::orderby('id','asc')->with('user_role')->where('role','1');
        return $query;
    }

    // public function leaderboard($input = [])
    // {
    //     /** @var User $query */
    //     // $query = User::where('role','0')->whereHas('mining')->orderBy(Mining::select('mining_point')->whereColumn('minings.user_id', 'users.id'),'DESC');
    //     $query = User::where('role','0')
    //     ->where('app_id', Cookie::get('appId'))
    //     ->orderBy('mining_point','DESC');
    //     return $query;
    // }
}
