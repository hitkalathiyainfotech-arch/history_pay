<?php

namespace App\Datatable;


use App\Models\Mining;
use App\Models\Setting;
use App\Models\Query;
// use Cookie;
use Illuminate\Support\Facades\Cookie;

class QueryDatatable
{
    public function get($input = [])
    {
        $query = Query::orderby('id','desc')->where('app_id',Cookie::get('appId'))->get();
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
