<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Receive
 * @package App\Models
 * @version March 13, 2018, 2:36 pm UTC
 *
 * @property number amount_money
 * @property string months
 * @property string date
 * @property string sender
 * @property string receiver
 * @property string description
 */
class Receive extends Model
{
    use SoftDeletes;

    public $table = 'receives';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'amount_money',
        'months',
        'date',
        'sender',
        'receiver',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'months' => 'string',
        'date' => 'string',
        'sender' => 'string',
        'receiver' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'amount_money' => 'required',
        'months' => 'required'
    ];

    
}
