<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class home
 * @package App\Models
 * @version January 30, 2018, 5:13 pm UTC
 *
 * @property int id
 * @property varchar name
 * @property varchar pc
 * @property varchar nhietdo
 */
class home extends Model
{
    use SoftDeletes;

    public $table = 'homes';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'name',
        'pc',
        'nhietdo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id' => 'required|int',
        'name' => 'required|max:255',
        'pc' => 'required|max:255',
        'nhietdo' => 'required|max:255'
    ];

    
}
