<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Device
 * @package App\Models
 * @version July 14, 2019, 5:25 pm UTC
 *
 * @property \App\Models\DeviceType deviceType
 * @property string name
 */
class Device extends Model
{
    use SoftDeletes;

    public $table = 'devices';
    

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
