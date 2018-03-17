<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\MachineType;
use App\Models\Receive;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == 3){
            $_revenueMonths = DB::table('machine_types')
                ->join('tb_customer_devices', 'machine_types.id', '=', 'tb_customer_devices.machine_type_id')
                ->select('machine_types.*', 'tb_customer_devices.user_id')
                ->where('tb_customer_devices.deleted_at', NULL)
                ->where('tb_customer_devices.user_id', Auth::user()->id)->get();
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
            $machines = DB::table('tb_customer_devices')->where('user_id', Auth::user()->id)->get();
            $machinesTypes = MachineType::pluck('price', 'id');
            $totalMoney = 0;
            foreach ($machines as $machine)
            {
                $_d = !empty($machine->date) ? $machine->date : null;
                $month = Machine::getMonths($_d);
                if($month != '' && !empty($machine->machine_type_id) && !empty($machinesTypes[$machine->machine_type_id])){
                    $totalMoney += $month * $machinesTypes[$machine->machine_type_id];
                    // tinh so ngay le.
                    $soNgayLe = Machine::laySoTienNgayLe($_d);
                    $totalMoney -= ($machinesTypes[$machine->machine_type_id]/30.5) * $soNgayLe;
                }
            }
            $napTien = Receive::groupBy('user_id')
                ->where('user_id', Auth::user()->id)
                ->where('tralai', 0)
                ->selectRaw('sum(amount_money) as sum, user_id')
                ->pluck('sum','user_id');
            $napTien = !empty($napTien) && !empty($napTien[Auth::user()->id]) ? $napTien[Auth::user()->id] : 0;
            $totalMoney -= $napTien;

            return view('dashboard.view')->with('revenueMonth', $revenueMonth)->with('listMachines', $listMachines)
                ->with('totalMoney', $totalMoney);
        }
        $countCustomer = DB::table('users')->where('role', 3)->count();
        $listMachines = DB::table('tb_customer_devices')->where('deleted_at', NULL)->pluck('machine_type_id', 'id');
        $listMachinesPrices = DB::table('machine_types')->where('deleted_at', NULL)->pluck('price', 'id');
        $totalRevenue = 0;
        foreach ($listMachines as $machineId => $machineTypeId)
        {
            if(!empty($listMachinesPrices) && !empty($listMachinesPrices[$machineTypeId]))
            {
                $totalRevenue += $listMachinesPrices[$machineTypeId];
            }
        }
        $_machines = DB::table('machine_types')
            ->join('tb_customer_devices', 'machine_types.id', '=', 'tb_customer_devices.machine_type_id')
            ->select('machine_types.*')
            ->where('tb_customer_devices.deleted_at', NULL)->get();
            $machines = array();
        foreach ($_machines as $machine)
        {
            if(!empty($machines[$machine->name])){
                $machines[$machine->name]++;
            } else {
                $machines[$machine->name] = 1;
            }
        }
        $_totalMoneys = DB::table('cost')->where('deleted_at', NULL)->get();
        $month = date('m/Y', strtotime(now()));
        $totalMoneys = 0;
        foreach ($_totalMoneys as $_totalMoney)
        {
            if(!empty($_totalMoney->date)){
                $l = explode("/", $_totalMoney->date);
                $_month = $l[1] . '/' . $l[2];
                if($_month == $month){
                    $totalMoneys += $_totalMoney->amount_money;
                }
            }
        }
        return view('dashboard.index')->with('countCustomer', $countCustomer)
            ->with('totalRevenue', $totalRevenue)->with('machines', $machines)
            ->with('totalMoneys', $totalMoneys);
    }
}
