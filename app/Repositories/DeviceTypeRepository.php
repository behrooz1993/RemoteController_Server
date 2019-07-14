<?php

namespace App\Repositories;

use App\Models\DeviceType;
use App\Repositories\BaseRepository;

/**
 * Class DeviceTypeRepository
 * @package App\Repositories
 * @version July 14, 2019, 5:25 pm UTC
*/

class DeviceTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return DeviceType::class;
    }
}
