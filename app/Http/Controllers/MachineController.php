<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMachineRequest;
use App\Http\Requests\UpdateMachineRequest;
use App\Models\home;
use App\Repositories\MachineRepository;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Response;

class MachineController extends AppBaseController
{
    /** @var  MachineRepository */
    private $machineRepository;

    public function __construct(MachineRepository $machineRepo)
    {
        $this->machineRepository = $machineRepo;
    }

    /**
     * Display a listing of the Machine.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        return view('machines.index');
    }

    /**
     * Show the form for creating a new Machine.
     *
     * @return Response
     */
    public function create()
    {
        return view('machines.create');
    }

    /**
     * Store a newly created Machine in storage.
     *
     * @param CreateMachineRequest $request
     *
     * @return Response
     */
    public function store(CreateMachineRequest $request)
    {
        $input = $request->all();

        $machine = $this->machineRepository->create($input);

        Flash::success('Machine saved successfully.');

        return redirect(route('machines.index'));
    }

    /**
     * Display the specified Machine.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $machine = home::findOrFail($id);

        if (empty($machine)) {
            Flash::error('Machine not found');

            return redirect(route('machines.index'));
        }

        return view('machines.show')->with('machine', $machine);
    }

    /**
     * Show the form for editing the specified Machine.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $machine = home::findOrFail($id);
        $users = User::where('role', 3)->pluck('name', 'id');

        if (empty($machine)) {
            Flash::error('Machine not found');

            return redirect(route('machines.index'));
        }

        return view('machines.edit')->with('machine', $machine)->with('users', $users);
    }

    /**
     * Update the specified Machine in storage.
     *
     * @param  int              $id
     * @param UpdateMachineRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        dd($request);
    }

    /**
     * Remove the specified Machine from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $machine = $this->machineRepository->findWithoutFail($id);

        if (empty($machine)) {
            Flash::error('Machine not found');

            return redirect(route('machines.index'));
        }

        $this->machineRepository->delete($id);

        Flash::success('Machine deleted successfully.');

        return redirect(route('machines.index'));
    }

    public function getDataForDataTable()
    {
        if(Auth::user() &&  Auth::user()->role == 3){
            $machines = DB::table('tb_devices')->where('user_id', Auth::user()->id)->get();
        } else {
            $machines = DB::table('tb_devices')->get();
        }
        $data = array();
        foreach($machines  as $machine)
        {
            $nestedData[0] = $machine->worker1 ? $machine->worker1 : "Device name";
            $nestedData[1] = $machine->ip ? $machine->ip : "0.0.0.0";
            $nestedData[2] = $machine->type ? $machine->type : "N/A";
            $nestedData[3] = $machine->pool1 ? $machine->pool1 : "N/A";
            $nestedData[4] = $machine->hash_rate_5s ? $machine->hash_rate_5s : "0";
            $nestedData[5] = $machine->temp ? $machine->temp : "0";
            $nestedData[6] = $machine->temp ? $machine->temp : "0";
            $nestedData[7] = $machine->elapsed ? $machine->elapsed : "0";
            $nestedData[8] = $machine->update_time ? $machine->update_time : "N/A";
            $nestedData[9] = $machine->status ? $machine->status : "SUCCESS";
            $data[] = $nestedData;
        }
        $json_data = array(
            "data" => $data   // total data array
        );

        return json_encode($json_data);
    }

    public function deleted($id)
    {
        $machine = home::findOrFail($id);

        if (empty($machine)) {
            Flash::error('Machine not found');

            return redirect(route('machines.index'));
        }

        home::where('id')->delete();

        Flash::success('Machine deleted successfully.');

        return redirect(route('machines.index'));
    }

    public function addMachines(Request $request)
    {
        $data = $request->all();
        if(!empty($data)){
            if($data['id'] == "") {
                DB::table('tb_customer_devices')->insert($data);
            } else {
                DB::table('tb_customer_devices')->where('id', $data['id'])->update($data);
            }
        }
        return json_encode(1);
    }

    public function removeMachines(Request $request)
    {
        $data = $request->all();
        if(!empty($data)){
            foreach ($data['data'] as $id){
                if($id){
                    DB::table('tb_customer_devices')->where('id', $id)->delete();
                }
            }
        }
        return json_encode(1);
    }
}
