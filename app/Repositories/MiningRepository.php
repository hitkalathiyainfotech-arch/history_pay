<?php


namespace App\Repositories;


use App\Models\Mining;

class MiningRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    protected $fieldsSearchable = [
        'mining_point',
        'session_start_time',
        'session_end_time',
        'mining_speed',
        'purchase_start_time',
        'purchase_expire_time',
        'has_rate_speed',
        'reward_point',
        'app_id',
        'user_id',    
        'is_mining',
        'current_end_time',
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
        return Mining::class;
    }
}
