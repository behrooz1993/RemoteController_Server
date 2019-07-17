<?php

namespace App\Repositories;

use App\Models\DeviceType;
use App\Repositories\BaseRepository;

/**
 * Class DeviceTypeRepository
 * @package App\Repositories
 * @version July 17, 2019, 6:14 pm UTC
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
