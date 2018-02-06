<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerDevice extends Model
{
    use SoftDeletes;

    public $table = 'tb_customer_devices';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id', 'name', 'date', 'status', 'ip', 'sale_place', 'code', 'price'
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
        'date' => 'required',
        'status' => 'required',
        'code' => 'required',
        'price' => 'required'
    ];
}
