<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Session
 * @package App\Models
 * @version July 2, 2019, 7:18 am UTC
 *
 * @property \App\Models\User user
 * @property integer user_id
 */
class Session extends Model
{
    use SoftDeletes;

    public $table = 'sessions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'session' => 'string',
        'useragent' => 'string',
        'fingerprint' => 'string'
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
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}
