<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 * @version July 17, 2019, 6:19 pm UTC
 *
 * @property \App\Models\AttributeGroup attributeGroup
 * @property integer attribute_group_id
 * @property string name
 * @property integer permisson
 */
class Attribute extends Model
{
    use SoftDeletes;

    public $table = 'attributes';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'attribute_group_id',
        'name',
        'permisson'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'attribute_group_id' => 'integer',
        'name' => 'string',
        'permisson' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'permisson' => 'default,1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function attributeGroup()
    {
        return $this->belongsTo(\App\Models\AttributeGroup::class, 'attribute_group_id', 'id');
    }
}
