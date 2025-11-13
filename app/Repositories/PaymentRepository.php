<?php

namespace App\Repositories;

use App\Models\PaymentStatus;

class PaymentRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    protected $fieldsSearchable = [
        'plan_id',
        'payment_gateway',
        'gateway_saltkey',
        'gateway_merchantkey',
        'status',
        'user_id',
        'purchase_time',
        'purchase_expire_time',
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
        return PaymentStatus::class;
    }    
}
