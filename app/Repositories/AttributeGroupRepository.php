<?php

namespace App\Repositories;

use App\Models\AttributeGroup;
use App\Repositories\BaseRepository;

/**
 * Class AttributeGroupRepository
 * @package App\Repositories
 * @version July 15, 2019, 6:36 am UTC
*/

class AttributeGroupRepository extends BaseRepository
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
        return AttributeGroup::class;
    }
}
