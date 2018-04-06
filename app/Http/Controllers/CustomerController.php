<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Machine;
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

    public function add($id, Request $request)
    {
        $requestDate = $request->only('date');
        $customer = User::findOrFail($id);

        $_machineTypes = MachineType::all();
        $machineTypes = array();
        $listPrice = [];
        $listParent = [];
        foreach($_machineTypes as $_machineType)
        {
            if($_machineType->parent_id == null){
                $listPrice[$_machineType['id']] = $_machineType['price'];
                $machineTypes[$_machineType['id']] = $_machineType['name'] . ' - ' . $_machineType['price'];
                $listParent[$_machineType->id] = $_machineType->id;
            } else {
                // tinh toan lai lay ngay thuc.
                $date = date('m/Y');

                if(!empty($requestDate)){
                    $date = $requestDate['date'];
                }
                $parent_id = $_machineType->parent_id;
                unset($machineTypes[$parent_id]);
                $_machineTypes = MachineType::where(function ($query) use ($date) {
                    $query->where('date', '=', $date);
                })->where(function ($query) use ($parent_id) {
                    $query->where('parent_id', $parent_id)
                        ->orWhere('id', $parent_id);
                })->orderBy('id', 'DESC')->first();
                if(empty($_machineTypes)){
                    $_machineTypes = MachineType::where(function ($query) use ( $date) {
                        $query->where('date', "<=", $date);
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
                if(in_array($_machineType->parent_id, $listParent)){
                    if(!empty($machineTypes[$_machineType->parent_id])){
                    } else {
                        $listPrice[$_machineTypes['parent_id']] = $_machineTypes['price'];
                        $machineTypes[$_machineTypes['parent_id']] = $_machineTypes['name'] . ' - ' . $_machineTypes['price'];
                    }
                }
            }
        }
        $subMT = [];
        $subLp = [];
        foreach ($listParent as $parent){
            $v = MachineType::where('parent_id', $parent)->orderBy('id', 'DESC')->first();
            if(!empty($machineTypes[$parent])){

                $subMT[$v->id] = $machineTypes[$parent];
            }
            if(!empty($listPrice[$parent])){

                $subLp[$v->id] = $listPrice[$parent];
            }
        }

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }
        $machines = DB::table('tb_customer_devices')->where('user_id', $id)->get();
        $totalMoney = 0;
        $min = 99999999;
        $minD = date("Y-m-d");
        $maxD = date("Y-m-d");
        foreach ($machines as $machine)
        {
            $_d = !empty($machine->date) ? $machine->date : null;
            // tinh min va max of ngay.
            $_da = explode("/", $_d);
            $check = $_da[2] . $_da[1]. $_da[0];
            if($check < $min){
                $min = $check;
                $minD = $_da[2] . '-' . $_da[1] . '-' . $_da[0];
            }
            // tinh tien cho tung thang va tung may.
            $tien = Machine::totalMoneyForMachine($machine, $id);
            $totalMoney += $tien;
        }
        $listDate = [];
        while ($minD <= $maxD){
            $_minD = explode('-', $minD);
            $listDate[$_minD[1] . '/' . $_minD[0]] = $_minD[1] . '/' . $_minD[0];
            $time = strtotime($minD);
            $minD = date("Y-m-d", strtotime("+1 month", $time));
        }
        $_maxD = explode('-', $maxD);
        $listDate[$_maxD[1] . '/' . $_maxD[0]] = $_maxD[1] . '/' . $_maxD[0];
        $_m = date("m/Y");
        $napTien = Receive::groupBy('user_id')
            ->where('user_id', $id)
            ->where('tralai', 1)
            ->selectRaw('sum(amount_money) as sum, user_id')
            ->pluck('sum','user_id');
        $napTien = !empty($napTien) && !empty($napTien[$id]) ? $napTien[$id] : 0;
        $totalMoney -= $napTien;
        // get receives
        $listReceives = [];
        if(!empty($requestDate)){
            $_m = $requestDate['date'];
        }
        $receives = Receive::where('user_id', $id)
            ->where('months', $_m)
            ->where('tralai', '!=', 1)
            ->orderBy('tralai')->get();
        foreach ($receives as $receive){
            $listReceives[$receive['customer_devices_id']][] = $receive;
        }

        return view('machines.show')->with('customer', $customer)->with('machines', $machines)
            ->with('machineTypes', $subMT)->with('totalMoney', $totalMoney)
            ->with('id', $id)->with('listReceives', $listReceives)->with('listPrice', $subLp)
            ->with('listDate', $listDate)->with('_m', $_m);
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
