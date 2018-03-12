<?php

namespace App\Http\Controllers;

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
            return view('dashboard.view')->with('revenueMonth', $revenueMonth)->with('listMachines', $listMachines);
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
        $_totalMoneys = DB::table('cost')->get();
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
