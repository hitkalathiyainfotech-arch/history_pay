<?php

namespace App\Repositories;

use App\Models\Withdrawal;

class WithdrawalRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    protected $fieldsSearchable = [
        'user_id',
        'amount',
        'address',
        'time',
        'status',
        'coin_name',
        'app_id', 
    ];

    /**
     * @return array|string[]
     */
    public function getFieldsSearchable()
    {
       return $this->fieldsSearchable;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Withdrawal::class;
    }    
}
