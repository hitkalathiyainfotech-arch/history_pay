<?php
namespace App\Datatable;

use App\Models\Subscription;
use Cookie;
use App\Models\Purchase;

class PurchaseDatatable
{
    public function get($input = [])
    {
        $query = Purchase::where('app_id',Cookie::get('appId'));
        return $query;
    }

}
