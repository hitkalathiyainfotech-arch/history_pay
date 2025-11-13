<?php


namespace App\Repositories;


use App\Models\Plan;

class PlanRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    protected $fieldsSearchable = [
        'plan_name',
        'price',
        'speed',
        'contract',
        'minimum_withdraw',
        'availability',
        'app_id',
        'category',
        'image',
        'image_path',
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
        return Plan::class;
    }
}
