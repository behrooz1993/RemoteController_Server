<?php

namespace App\Repositories;

use App\Models\Instance;
use App\Repositories\BaseRepository;

/**
 * Class InstanceRepository
 * @package App\Repositories
 * @version July 14, 2019, 5:26 pm UTC
*/

class InstanceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'device_id',
        'serial'
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
        return Instance::class;
    }
}
