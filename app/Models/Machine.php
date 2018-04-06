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
            $d2 = date('Y-m') . '-01';
            $date1 = new \DateTime($d1);
            $date2 = new \DateTime($d2);
            if($d[2] . $d[1] >= date('Y') .date('m')){
                return -1;
            }
            $diff = $date2->diff($date1);
            return($diff->format('%y') * 12) + $diff->format('%m')+1;
        }
        return 0;
    }

    public static function laySoTienNgayLe($date)
    {
        $d = explode('/', $date);
        if(!empty($d[0]) && !empty($d[1]) && !empty($d[2])){
            $d1 = $d[0];
            $d2 = 1;
            if($d2 == $d1){
                return 0;
            } else {
                $number = cal_days_in_month(CAL_GREGORIAN, $d[1], $d[2]);
                if($number > $d1) {
                    return $number - $d1 + 1;
                } else {
                    return 0;
                }
            }
        }
        return 0;
    }

    public static function totalMoneyForMachine($machine, $user_id)
    {
        $_d = !empty($machine->date) ? $machine->date : null;
        $month = self::getMonths($_d);
        $tien = 0;
        $machinesTypes = MachineType::pluck('price', 'id');
        if(!empty($machine->machine_type_id)) {
            $machineType = MachineType::where('id', $machine->machine_type_id)->first();
            $parent_id = $machineType->parent_id;
            if(!empty($parent_id)){
                //doan nay tinh tien tung thang.
                $start = explode('/', $_d);
                $minD = $start[2] . '-' . $start[1];
                $maxD = date('Y-m');
                $i = 0;
                $listId = [];
                while ($minD <= $maxD){
                    $i++;
                    $time = strtotime($maxD . '-01');
                    // tinh tien
                    $date = date('m/Y', $time);
                    $_machineTypes = MachineType::where(function ($query) use ($date) {
                        $query->where('date', '=', $date);
                    })->where(function ($query) use ($parent_id) {
                        $query->where('parent_id', $parent_id)
                            ->orWhere('id', $parent_id);
                    })->orderBy('date')->orderBy('id', 'DESC')->first();
                    if(empty($_machineTypes)){
                        if(!isset($listId)){
                            $_machineTypes = MachineType::where(function ($query) use ($listId, $date) {
                                $query->where('date', "<=", $date)
                                ->whereNotIn('id', $listId);
                            })->where(function ($query) use ($parent_id) {
                                $query->where('parent_id', $parent_id)
                                    ->orWhere('id', $parent_id);
                            })->orderBy('date', 'DESC')->orderBy('id', 'DESC')->first();
                        }
                    }
                    if(empty($_machineTypes)){
                        $_machineTypes = MachineType::where(function ($query) use ($date) {
                            $query->where('date', null);
                        })->where(function ($query) use ($parent_id) {
                            $query->where('parent_id', $parent_id)
                                ->orWhere('id', $parent_id);
                        })->orderBy('date')->orderBy('id', 'DESC')->first();
                    }
                    if(!empty($_machineTypes)){
                        if($minD == $maxD){
                            $soNgayLe = self::laySoTienNgayLe($_d);
                            if($soNgayLe > 0) {
                                $tien += ($_machineTypes->price / 30.5) * $soNgayLe;
                            }
                        } else {
                            $tien += $_machineTypes->price;
                        }
                        $listId[$_machineTypes->id] = $_machineTypes->id;
                    }
                    $maxD = date("Y-m", strtotime("-1 month", $time));
                }
            } else {
                if($month >= 0 && !empty($machine->machine_type_id) && !empty($machinesTypes[$machine->machine_type_id])){
                    $tien += $month * $machinesTypes[$machine->machine_type_id];
                    // tinh so ngay le.
                    $soNgayLe = self::laySoTienNgayLe($_d);
                    if($soNgayLe > 0) {
                        $tien += ($machinesTypes[$machine->machine_type_id] / 30.5) * $soNgayLe;
                    }
                }
            }
        }
        // doan nay tinh tien phu thu va hoan tra may off.
        $phuThu = Receive::groupBy('user_id')
            ->where('user_id', $user_id)
            ->where('customer_devices_id', $machine->id)
            ->where('tralai', 2)
            ->selectRaw('sum(amount_money) as sum, user_id')
            ->pluck('sum','user_id');
        $tien += !empty($phuThu[$user_id]) ? $phuThu[$user_id] : 0;
        $hoanTra = Receive::groupBy('user_id')
            ->where('user_id', $user_id)
            ->where('customer_devices_id', $machine->id)
            ->where('tralai', 3)
            ->selectRaw('sum(amount_money) as sum, user_id')
            ->pluck('sum','user_id');
        $tien -= !empty($hoanTra[$user_id]) ? $hoanTra[$user_id] : 0;
        return $tien;
    }
}
