<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMachineTypeRequest;
use App\Http\Requests\UpdateMachineTypeRequest;
use App\Models\Machine;
use App\Models\MachineType;
use App\Repositories\MachineTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MachineTypeController extends AppBaseController
{
    /** @var  MachineTypeRepository */
    private $machineTypeRepository;

    public function __construct(MachineTypeRepository $machineTypeRepo)
    {
        $this->machineTypeRepository = $machineTypeRepo;
    }

    /**
     * Display a listing of the MachineType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->machineTypeRepository->pushCriteria(new RequestCriteria($request));
        $machineTypes = DB::table('machine_types')->orderBy('id', 'DESC')->where('deleted_at', null)->get();
        $listMachineTypes = [];
        $listParent = [];
        foreach ($machineTypes as $machineType){
            if($machineType->parent_id == null){
                if(!in_array($machineType->id, $listParent)){

                    $listMachineTypes[$machineType->id] = $machineType;
                }
            } else {
                // tinh toan lai lay ngay thuc.
                $date = date('m/Y');
                $parent_id = $machineType->parent_id;
                $_machineTypes = MachineType::where(function ($query) use ($date) {
                    $query->where('date', '=', $date);
                })->where(function ($query) use ($parent_id) {
                    $query->where('parent_id', $parent_id)
                        ->orWhere('id', $parent_id);
                })->orderBy('date')->orderBy('id', 'DESC')->first();
                if(empty($_machineTypes)){
                    if(!isset($listId)){
                        $_machineTypes = MachineType::where(function ($query) use ( $date) {
                            $query->where('date', ">=", $date);
                        })->where(function ($query) use ($parent_id) {
                            $query->where('parent_id', $parent_id)
                                ->orWhere('id', $parent_id);
                        })->orderBy('date')->orderBy('id', 'DESC')->first();
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

                $listParent[$machineType->parent_id] = $machineType->parent_id;
                if(!empty($listMachineTypes[$machineType->parent_id])){

                } else {
                    if(!empty($_machineTypes)){
                        $listMachineTypes[$machineType->parent_id] = $_machineTypes;
                    } else {
                        $listMachineTypes[$machineType->parent_id] = $machineType;
                    }
                }
            }
        }
        ksort($listMachineTypes);
        return view('machine_types.index')
            ->with('machineTypes', $listMachineTypes);
    }

    /**
     * Show the form for creating a new MachineType.
     *
     * @return Response
     */
    public function create()
    {
        return view('machine_types.create');
    }

    /**
     * Store a newly created MachineType in storage.
     *
     * @param CreateMachineTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateMachineTypeRequest $request)
    {
        $input = $request->all();

        $machineType = $this->machineTypeRepository->create($input);

        Flash::success('Machine Type saved successfully.');

        return redirect(route('machineTypes.index'));
    }

    /**
     * Display the specified MachineType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $machineType = $this->machineTypeRepository->findWithoutFail($id);

        if (empty($machineType)) {
            Flash::error('Machine Type not found');

            return redirect(route('machineTypes.index'));
        }

        return view('machine_types.show')->with('machineType', $machineType);
    }

    /**
     * Show the form for editing the specified MachineType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $machineType = $this->machineTypeRepository->findWithoutFail($id);

        if (empty($machineType)) {
            Flash::error('Machine Type not found');

            return redirect(route('machineTypes.index'));
        }
        $parent_id = $machineType->parent_id;
        if(!empty($parent_id)){
            $lists = MachineType::whereIn('id', [$id, $parent_id])
                ->orWhere('parent_id', $parent_id)->get();
        } else {
            $lists = MachineType::where('id', $id)->get();
        }

        return view('machine_types.edit')->with('machineType', $machineType)->with('lists', $lists);
    }

    /**
     * Update the specified MachineType in storage.
     *
     * @param  int              $id
     * @param UpdateMachineTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMachineTypeRequest $request)
    {
        $machineType = $this->machineTypeRepository->findWithoutFail($id);

        if (empty($machineType)) {
            Flash::error('Machine Type not found');

            return redirect(route('machineTypes.index'));
        }
        $inputs = $request->only('price', 'date');
        $data = $request->only('price', 'date', 'name');
        if(!empty($machineType->parent_id)){
            $date = $inputs['date'];
            $parent_id = $machineType->parent_id;
            $check = MachineType::where(function ($query) use ($date) {
                $query->where('date', '=', $date);
            })->where(function ($query) use ($parent_id) {
                $query->where('parent_id', $parent_id)
                    ->orWhere('id', $parent_id);
            })->orderBy('date')->orderBy('id', 'DESC')->first();
            if(!empty($check)){
                $this->machineTypeRepository->update($inputs, $id);
                Flash::success('Machine Type updated successfully.');
                return redirect(route('machineTypes.index'));
            }
            $data['parent_id'] = $machineType->parent_id;
        } else {
            $data['parent_id'] = $id;
        }
        DB::beginTransaction();
        try {
            $newId = MachineType::insertGetId($data);
            $list = DB::table('tb_customer_devices')->where('machine_type_id', $id)->get();
            foreach ($list as $_list){
                DB::table('tb_customer_devices')->where('id', $_list->id)->update(['machine_type_id' => $newId]);
            }
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }

        Flash::success('Machine Type updated successfully.');
        return redirect(route('machineTypes.index'));
    }

    /**
     * Remove the specified MachineType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $machineType = $this->machineTypeRepository->findWithoutFail($id);

        if (empty($machineType)) {
            Flash::error('Machine Type not found');

            return redirect(route('machineTypes.index'));
        }

        $this->machineTypeRepository->delete($id);

        Flash::success('Machine Type deleted successfully.');

        return redirect(route('machineTypes.index'));
    }
}
