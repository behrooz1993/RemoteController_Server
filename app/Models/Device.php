<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Device
 * @package App\Models
 * @version July 17, 2019, 6:14 pm UTC
 *
 * @property \App\Models\DeviceType deviceType
 * @property integer device_type_id
 * @property string name
 */
class Device extends Model
{
    use SoftDeletes;

    public $table = 'devices';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'device_type_id',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'device_type_id' => 'integer',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function deviceType()
    {
        return $this->belongsTo(\App\Models\DeviceType::class, 'device_type_id', 'id');
    }
}
