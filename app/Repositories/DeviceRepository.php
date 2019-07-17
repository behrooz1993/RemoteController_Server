<?php

namespace App\Repositories;

use App\Models\Device;
use App\Repositories\BaseRepository;

/**
 * Class DeviceRepository
 * @package App\Repositories
 * @version July 17, 2019, 6:14 pm UTC
*/

class DeviceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'device_type_id',
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
        return Device::class;
    }
}
