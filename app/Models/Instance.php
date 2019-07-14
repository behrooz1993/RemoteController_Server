<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Instance
 * @package App\Models
 * @version July 14, 2019, 5:26 pm UTC
 *
 * @property \App\Models\Device device
 * @property string mobile
 * @property string serial
 */
class Instance extends Model
{
    use SoftDeletes;

    public $table = 'instances';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'mobile',
        'serial'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'device_id' => 'integer',
        'mobile' => 'string',
        'serial' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'mobile' => 'required',
        'serial' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function device()
    {
        return $this->belongsTo(\App\Models\Device::class, 'device', 'id');
    }
}
