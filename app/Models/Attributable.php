<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attributable
 * @package App\Models
 * @version July 15, 2019, 7:24 am UTC
 *
 * @property \App\Models\Attribute attribute
 * @property 
 * @property 
 */
class Attributable extends Model
{
    use SoftDeletes;

    public $table = 'attributables';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'attribute_id' => 'integer',
        'attributable_id' => 'integer',
        'attributable_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function attribute()
    {
        return $this->belongsTo(\App\Models\Attribute::class, 'attribute_id', 'id');
    }
}
