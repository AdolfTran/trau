<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
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
        return view('dashboard.index')->with('countCustomer', $countCustomer)
            ->with('totalRevenue', $totalRevenue)->with('machines', $machines);
    }
}
