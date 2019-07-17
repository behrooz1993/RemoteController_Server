<?php

namespace App\Repositories;

use App\Models\Attributable;
use App\Repositories\BaseRepository;

/**
 * Class AttributableRepository
 * @package App\Repositories
 * @version July 17, 2019, 6:19 pm UTC
*/

class AttributableRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'attribute_id',
        'attributable_id'
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
        return Attributable::class;
    }
}
