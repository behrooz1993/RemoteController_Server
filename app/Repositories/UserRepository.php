<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\User;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version July 2, 2019, 7:18 am UTC
*/

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'mobile',
        'password',
        'email'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function checkMobile(string $mobile)
    {
        return $this->model->where('mobile', $mobile)->first();
    }

    public function saveUser(string $mobile)
    {
        $user = User::create(['mobile' => $mobile]);
        return $user;
    }

    public function saveActivationCode(User $user)
    {
        $user->activation_code = mt_rand(100000, 999999);
        $user->save();
        return $user;
    }

    public function checkActivationCode(User $user, string $code)
    {
        $activation = $user->where([
            ['code', $code]
        ])->latest('ttl')->first();
        return $activation;
    }

    public function completeProfile(User $user, array $params)
    {
        
        $user->update($params);
        return $user;
    }
}
