<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AttributeValue
 * @package App\Models
 * @version July 17, 2019, 6:19 pm UTC
 *
 * @property \App\Models\Attribute attrubute
 * @property string value
 */
class AttributeValue extends Model
{
    use SoftDeletes;

    public $table = 'attribute_values';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'attribute_id' => 'integer',
        'value' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'value' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function attrubute()
    {
        return $this->belongsTo(\App\Models\Attribute::class, 'attrubute_id', 'id');
    }
}
