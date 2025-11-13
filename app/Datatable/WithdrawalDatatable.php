<?php
namespace App\Datatable;
use App\Models\Withdrawal;
use Cookie;

class WithdrawalDatatable
{
    public function get($input = [])
    {
        /** @var Withdrawal $query */
        $query = Withdrawal::query()->select('withdrawals.*');
        $query->where('app_id',Cookie::get('appId'));
        if($input['date']){
            $query->whereDate('created_at',date('Y-m-d', strtotime($input['date'])));
        }

        return $query;
    }
}
