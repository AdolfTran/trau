<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Repositories\EmployeeRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class EmployeeController extends AppBaseController
{
    /** @var  EmployeeRepository */
    private $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepo)
    {
        $this->employeeRepository = $employeeRepo;
    }

    /**
     * Display a listing of the Employee.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
//        $this->employeeRepository->pushCriteria(new RequestCriteria($request));
//        $employees = $this->employeeRepository->all();
        $employees = User::where('role' , 2)->get();

        return view('employees.index')
            ->with('employees', $employees);
    }

    /**
     * Show the form for creating a new Employee.
     *
     * @return Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created Employee in storage.
     *
     * @param CreateEmployeeRequest $request
     *
     * @return Response
     */
    public function store(CreateEmployeeRequest $request)
    {
        $input = $request->all();
        $_password = rand(111111, 999999);
        $password = bcrypt($_password);
        $input['password'] = $password;
        $input['role'] = 2;

        User::create($input);

        Flash::success('Employee saved successfully.');

        $employee = $input;
        return view('employees.show')
            ->with('employee', $employee)
            ->with('_password', $_password);
    }

    /**
     * Display the specified Employee.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $employee = User::findOrFail($id);;

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('employees.index'));
        }

        return view('employees.show')->with('employee', $employee);
    }

    /**
     * Show the form for editing the specified Employee.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $employee = User::findOrFail($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('employees.index'));
        }

        return view('employees.edit')->with('employee', $employee);
    }

    /**
     * Update the specified Employee in storage.
     *
     * @param  int              $id
     * @param UpdateEmployeeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmployeeRequest $request)
    {
        $employee = User::findOrFail($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('employees.index'));
        }
        $input['name'] = $request->all()['name'];
        $input['email'] = $request->all()['email'];
        $input['phonenumber'] = $request->all()['phonenumber'];
        $input['address'] = $request->all()['address'];
        $input['date'] = $request->all()['date'];
        $input['salary'] = $request->all()['salary'];
        $input['day_work'] = $request->all()['day_work'];
        $input['over_time'] = $request->all()['over_time'];
        $employee = User::where('id', $id)->update($input);

        Flash::success('Employee updated successfully.');

        return redirect(route('employees.index'));
    }

    /**
     * Remove the specified Employee from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $employee = User::findOrFail($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('employees.index'));
        }

        User::where('id', $id)->delete();

        Flash::success('Employee deleted successfully.');

        return redirect(route('employees.index'));
    }
}
