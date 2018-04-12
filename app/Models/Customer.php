<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
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

    public static function sendEmail($data, $email, $title = ""){
        if($email) {
            Mail::send('mail', $data, function ($message) use ($email, $title) {
                $message->to($email, !empty($data['customer']) ? $data['customer'] : "")->subject($title);
            });
            return true;
        }
        return false;
    }

    public static function tinhtien($customerId)
    {
        $_revenueMonths = DB::table('machine_types')
            ->join('tb_customer_devices', 'machine_types.id', '=', 'tb_customer_devices.machine_type_id')
            ->select('machine_types.*', 'tb_customer_devices.user_id')
            ->where('tb_customer_devices.deleted_at', NULL)
            ->where('tb_customer_devices.user_id', $customerId)->get();
        $revenueMonth = 0;
        $listMachines = array();
        foreach ($_revenueMonths as $_revenueMonth)
        {
            if(!empty($_revenueMonth->price))
            {
                $revenueMonth += $_revenueMonth->price;
            }
            if(!empty($listMachines[$_revenueMonth->name])){
                $listMachines[$_revenueMonth->name]++;
            } else {
                $listMachines[$_revenueMonth->name] = 1;
            }
        }
        // tinh tong so tien phai tra
        $machines = DB::table('tb_customer_devices')->where('user_id', $customerId)->get();
        $totalMoney = 0;
        foreach ($machines as $machine)
        {
            $tien = Machine::totalMoneyForMachine($machine, $customerId);
            $totalMoney += $tien;
        }

        $_m = date("m/Y");
        $napTien = Receive::groupBy('user_id')
            ->where('user_id', $customerId)
            ->where('tralai', 1)
            ->selectRaw('sum(amount_money) as sum, user_id')
            ->pluck('sum','user_id');
        $napTien = !empty($napTien) && !empty($napTien[$customerId]) ? $napTien[$customerId] : 0;
        $totalMoney -= $napTien;
        $receives = Receive::where('user_id', $customerId)
            ->where('months', $_m)
            ->where('tralai', '!=', 1)
            ->orderBy('tralai')->get();
        $listReceives = array();
        foreach ($receives as $receive){
            $listReceives[$receive['customer_devices_id']][] = $receive;
        }
        // tinh price
        $_machineTypes = MachineType::all();
        $types = array();
        $listPrice = [];
        foreach($_machineTypes as $_machineType)
        {
            if($_machineType->parent_id == null){
                $types[$_machineType['id']] = $_machineType['name'] . ' - ' . $_machineType['price'];
                $listPrice[$_machineType['id']] = $_machineType['price'];
            } else {
                // tinh toan lai lay ngay thuc.
                $date = date('Y-m');
                $parent_id = $_machineType->parent_id;
                $_machineTypes = MachineType::where(function ($query) use ($date) {
                    $query->where('date', '=', $date);
                })->where(function ($query) use ($parent_id) {
                    $query->where('parent_id', $parent_id)
                        ->orWhere('id', $parent_id);
                })->orderBy('id', 'DESC')->first();
                if(empty($_machineTypes)){
                    $_machineTypes = MachineType::where(function ($query) use ( $date) {
                        $query->where('date', "<", $date);
                    })->where(function ($query) use ($parent_id) {
                        $query->where('parent_id', $parent_id)
                            ->orWhere('id', $parent_id);
                    })->orderBy('date', 'DESC')->orderBy('id', 'DESC')->first();
                }
                if(empty($_machineTypes)){
                    $_machineTypes = MachineType::where(function ($query) use ($date) {
                        $query->where('date', null);
                    })->where(function ($query) use ($parent_id) {
                        $query->where('parent_id', $parent_id)
                            ->orWhere('id', $parent_id);
                    })->orderBy('id', 'DESC')->first();
                }
                if($parent_id){
                    $mCt = MachineType::where('parent_id', $parent_id)->orderBy('id', 'DESC')->first();
                    if(!empty($mCt)){
                        $machineTypes[$mCt->id] = $_machineType['name'] . ' - ' . $_machineType['price'];
                    }
                    if(!empty($_machineTypes)){
                        $types[$_machineType['id']] = $_machineTypes['name'] . ' - ' . $_machineTypes['price'];
                        $listPrice[$_machineType['id']] = $_machineTypes['price'];
                    }
                }
            }
        }

        $data = [
            'revenueMonth' => $revenueMonth,
            'totalMoney' => $totalMoney,
            'machines' => $machines,
            'listPrice' => $listPrice,
            'listReceives' => $listReceives
        ];
        return $data;
    }
}
