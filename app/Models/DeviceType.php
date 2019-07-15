<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DeviceType
 * @package App\Models
 * @version July 14, 2019, 5:25 pm UTC
 *
 * @property string name
 */
class DeviceType extends Model
{
    use SoftDeletes;

    public $table = 'device_types';
    

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

    public function devices()
    {
        return $this->hasMany(\App\Models\Device::class, 'device_type_id', 'id');
    }    

    public function attributes() {
        return $this->morphToMany(\App\Models\Attribute, 'attributable');
    }
}
