<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    protected $fieldsSearchable = [
        'first_name',
        'last_name',
        'role',
        'country',
        'UID',
        'referral_code',
        'referral_by',
        'login_with',
        'email',
        'password',
        'app_id',
        'user_key',        
        'plan_id',        
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
        return User::class;
    }
}
