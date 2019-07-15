<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 * @version July 15, 2019, 7:06 am UTC
 *
 * @property string name
 */
class Attribute extends Model
{
    use SoftDeletes;

    public $table = 'attributes';
    

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

    public function attributeGroup()
    {
        return $this->belongsTo(\App\Models\AttributeGroup::class, 'attribute_group_id', 'id');
    }    

    public function deviceTypes() {
        return $this->morphedByMany(\App\Models\DeviceType::class, 'attributable');
    }

    public function devices() {
        return $this->morphedByMany(\App\Models\Device::class, 'attributable');
    }
}
