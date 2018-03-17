<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Machine
 * @package App\Models
 * @version February 1, 2018, 3:37 pm UTC
 *
 * @property int id
 * @property string|\Carbon\Carbon date
 * @property varchar ip
 * @property varchar code
 */
class Machine extends Model
{
    use SoftDeletes;

    public $table = 'machines';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'date',
        'status',
        'ip',
        'sale_place',
        'code',
        'price'
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
        'sale_place' => 'required',
        'code' => 'required',
        'price' => 'required'
    ];

    public static function getMonths($date)
    {
        $d = explode('/', $date);
        if(!empty($d[0]) && !empty($d[1]) && !empty($d[2])){
            $d1 = $d[2] . '-' . $d[1] . '-' . $d[0];
            $d2 = date('Y-m-d');
            $date1 = new \DateTime($d1);
            $date2 = new \DateTime($d2);

            $diff = $date2->diff($date1);
            return($diff->format('%y') * 12) + $diff->format('%m');
        }
        return '';
    }

    public static function laySoTienNgayLe($date)
    {
        $d = explode('/', $date);
        if(!empty($d[0]) && !empty($d[1]) && !empty($d[2])){
            $d1 = $d[0];
            $d2 = 1;
            if($d2 >= $d1){
                return 0;
            } else {
                return $d1 - $d2;
            }
        }
        return 0;
    }
}
