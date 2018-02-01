<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Employee
 * @package App\Models
 * @version February 1, 2018, 3:43 pm UTC
 *
 * @property int id
 * @property varchar phone_number
 * @property string|\Carbon\Carbon date
 * @property number day_work
 */
class Employee extends Model
{
    use SoftDeletes;

    public $table = 'employees';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'phone_number',
        'address',
        'date',
        'salary',
        'day_work',
        'over_time'
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
        'name' => 'required',
        'phone_number' => 'required',
        'address' => 'required',
        'date' => 'required',
        'salary' => 'required'
    ];

    
}
