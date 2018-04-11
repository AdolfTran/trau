<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

/**
 * Class Customer
 * @package App\Models
 * @version February 1, 2018, 3:33 pm UTC
 *
 * @property int id
 * @property varchar address
 * @property varchar phonenumber
 */
class Customer extends Model
{
    use SoftDeletes;

    public $table = 'customers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'address',
        'phonenumber',
        'email',
        'date',
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
        'email' => 'required|email',
        'phonenumber' => 'required',
        'date' => 'required'
    ];

    public static function sendEmail($customerId, $title =""){
        if($customerId) {
            $email = 'ductranminhitqb@gmail.com';
            $data = array('name' => "Damintech support");
            Mail::send('mail', $data, function ($message) use ($email) {
                $message->to($email, 'Event')->subject('Đăng ký thành công');
            });
            return true;
        }
        return false;
    }
    
}
