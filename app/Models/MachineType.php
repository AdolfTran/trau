<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MachineType
 * @package App\Models
 * @version February 8, 2018, 6:50 am UTC
 *
 * @property string name
 * @property number price
 */
class MachineType extends Model
{
    use SoftDeletes;

    public $table = 'machine_types';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:255',
        'price' => 'required'
    ];

    
}
