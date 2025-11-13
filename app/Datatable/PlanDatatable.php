<?php


namespace App\Datatable;


use App\Models\Plan;
use Cookie;

class PlanDatatable
{
    public function get($input = [])
    {
        /** @var Plan $query */

        $query = Plan::query()->select('plans.*');
        $query->where('app_id',Cookie::get('appId'));
        $query->where('category',$input['category']);

        // dd($query);
        return $query;
    }
}
