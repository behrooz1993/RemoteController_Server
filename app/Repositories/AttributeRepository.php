<?php

namespace App\Repositories;

use App\Models\Attribute;
use App\Repositories\BaseRepository;

/**
 * Class AttributeRepository
 * @package App\Repositories
 * @version July 15, 2019, 7:06 am UTC
*/

class AttributeRepository extends BaseRepository
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
        return Attribute::class;
    }
}
