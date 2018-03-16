<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\MachineType;
use App\Models\Receive;
use App\Repositories\CustomerRepository;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Response;

class CustomerController extends AppBaseController
{
    /** @var  CustomerRepository */
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepository = $customerRepo;
    }

    /**
     * Display a listing of the Customer.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search = $request->only('search');
        if(!empty($search)){
            $search = !empty($search['search']) ? $search['search'] : '';
            $customers = User::where('role', 3)
                ->where(function($query){
                    $query->where('name', 'like', '%' . Input::get('search') . '%')
                        ->orWhere('email', 'like', '%' . Input::get('search') . '%')
                        ->orWhere('address', 'like', '%' . Input::get('search') . '%')
                        ->orWhere('phonenumber', 'like', '%' . Input::get('search') . '%')
                        ->orWhere('code', 'like', '%' . Input::get('search') . '%');
                })->get();
        } else {
            $customers = User::where('role', 3)->get();
        }

        return view('customers.index')
            ->with('customers', $customers)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new Customer.
     *
     * @return Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created Customer in storage.
     *
     * @param CreateCustomerRequest $request
     *
     * @return Response
     */
    public function store(CreateCustomerRequest $request)
    {
        $input = $request->all();
        $_password = rand(111111, 999999);
        $password = bcrypt($_password);
        $input['password'] = $password;
        $input['role'] = 3;
        $input['code'] = rand(0001, 9999);

        User::create($input);

        Flash::success('Customers saved successfully.');

        $customer = $input;
        return view('customers.show')
            ->with('customer', $customer)
            ->with('_password', $_password);
    }

    /**
     * Display the specified Customer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $customer = User::findOrFail($id);

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }

        return view('customers.show')->with('customer', $customer);
    }

    /**
     * Show the form for editing the specified Customer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $customer  = User::findOrFail($id);;

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }

        return view('customers.edit')->with('customer', $customer);
    }

    /**
     * Update the specified Customer in storage.
     *
     * @param  int              $id
     * @param UpdateCustomerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCustomerRequest $request)
    {
        $customer = User::findOrFail($id);

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }
        $input['name'] = $request->all()['name'];
        $input['email'] = $request->all()['email'];
        $input['phonenumber'] = $request->all()['phonenumber'];
        $input['address'] = $request->all()['address'];
        $input['date'] = $request->all()['date'];

        $customer = User::where('id', $id)->update($input);

        Flash::success('Customer updated successfully.');

        return redirect(route('customers.index'));
    }

    /**
     * Remove the specified Customer from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $customer = User::findOrFail($id);

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }

        User::where('id', $id)->delete();

        Flash::success('Customer deleted successfully.');

        return redirect(route('customers.index'));
    }

    public function add($id)
    {
        $customer = User::findOrFail($id);

        $_machineTypes = MachineType::all();
        $machineTypes = array();

        foreach($_machineTypes as $_machineType)
        {
            $machineTypes[$_machineType['id']] = $_machineType['name'] . ' - ' . $_machineType['price'];
        }

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }
        $machines = DB::table('tb_customer_devices')->where('user_id', $id)->get();

        $_revenueMonths = DB::table('machine_types')
            ->join('tb_customer_devices', 'machine_types.id', '=', 'tb_customer_devices.machine_type_id')
            ->select('machine_types.*', 'tb_customer_devices.user_id')
            ->where('tb_customer_devices.deleted_at', NULL)
            ->where('tb_customer_devices.user_id', $id)->get();
        $totalMoney = 0;
        foreach ($_revenueMonths as $_revenueMonth)
        {
            if(!empty($_revenueMonth->price))
            {
                $totalMoney += $_revenueMonth->price;
            }
        }
        $napTien = Receive::groupBy('user_id')
            ->where('user_id', $id)
            ->selectRaw('sum(amount_money) as sum, user_id')
            ->pluck('sum','user_id');
        $napTien = !empty($napTien) && !empty($napTien[$id]) ? $napTien[$id] : 0;
        $totalMoney -= $napTien;

        return view('machines.show')->with('customer', $customer)->with('machines', $machines)
            ->with('machineTypes', $machineTypes)->with('totalMoney', $totalMoney)
            ->with('id', $id);
    }

    public function reset(Request $request)
    {
        $data = $request->all();
        if(!empty($data['id'])){
            $_password = rand(111111, 999999);
            $password = bcrypt($_password);
            $input['password'] = $password;
            User::where('id', $data['id'])->update($input);
            return json_encode($_password);
        } else {
            return json_encode(0);
        }
    }
}
