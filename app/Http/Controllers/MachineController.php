<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMachineRequest;
use App\Http\Requests\UpdateMachineRequest;
use App\Repositories\MachineRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
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
        $this->machineRepository->pushCriteria(new RequestCriteria($request));
        $machines = $this->machineRepository->all();

        return view('machines.index')
            ->with('machines', $machines);
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
        $machine = $this->machineRepository->findWithoutFail($id);

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
        $machine = $this->machineRepository->findWithoutFail($id);

        if (empty($machine)) {
            Flash::error('Machine not found');

            return redirect(route('machines.index'));
        }

        return view('machines.edit')->with('machine', $machine);
    }

    /**
     * Update the specified Machine in storage.
     *
     * @param  int              $id
     * @param UpdateMachineRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMachineRequest $request)
    {
        $machine = $this->machineRepository->findWithoutFail($id);

        if (empty($machine)) {
            Flash::error('Machine not found');

            return redirect(route('machines.index'));
        }

        $machine = $this->machineRepository->update($request->all(), $id);

        Flash::success('Machine updated successfully.');

        return redirect(route('machines.index'));
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
}
