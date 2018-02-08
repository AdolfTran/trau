<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMachineTypeRequest;
use App\Http\Requests\UpdateMachineTypeRequest;
use App\Repositories\MachineTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
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
        $machineTypes = $this->machineTypeRepository->all();

        return view('machine_types.index')
            ->with('machineTypes', $machineTypes);
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

        return view('machine_types.edit')->with('machineType', $machineType);
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

        $machineType = $this->machineTypeRepository->update($request->all(), $id);

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
