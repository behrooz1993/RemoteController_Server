<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AttributeGroup
 * @package App\Models
 * @version July 15, 2019, 6:36 am UTC
 *
 * @property string name
 */
class AttributeGroup extends Model
{
    use SoftDeletes;

    public $table = 'attribute_groups';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    public function attributes()
    {
        return $this->hasMany(\App\Models\Attribute::class, 'attribute_group_id', 'id');
    }
}
