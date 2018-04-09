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
            $totalMoney = 0;
            foreach ($machines as $machine)
            {
                $tien = Machine::totalMoneyForMachine($machine, Auth::user()->id);
                $totalMoney += $tien;
            }

            $_m = date("m/Y");
            $napTien = Receive::groupBy('user_id')
                ->where('user_id', Auth::user()->id)
                ->where('tralai', 1)
                ->selectRaw('sum(amount_money) as sum, user_id')
                ->pluck('sum','user_id');
            $napTien = !empty($napTien) && !empty($napTien[Auth::user()->id]) ? $napTien[Auth::user()->id] : 0;
            $totalMoney -= $napTien;
            $receives = Receive::where('user_id', Auth::user()->id)
                ->where('months', $_m)
                ->where('tralai', '!=', 1)
                ->orderBy('tralai')->get();
            $listReceives = array();
            foreach ($receives as $receive){
                $listReceives[$receive['customer_devices_id']][] = $receive;
            }
            // show list nap tien.
            $listNapTien = Receive::where('user_id', Auth::user()->id)
                ->where('months', $_m)
                ->where('tralai', 1)
                ->orderBy('tralai')->get();
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

            return view('dashboard.view')->with('revenueMonth', $revenueMonth)->with('listMachines', $listMachines)
                ->with('totalMoney', $totalMoney)->with('machines', $machines)->with('listReceives', $listReceives)
                ->with('listNapTien', $listNapTien)->with('listPrice', $listPrice)->with('types', $types);
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
