<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Repositories\CustomerRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
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
//        $this->customerRepository->pushCriteria(new RequestCriteria($request));
//        $customers = $this->customerRepository->all();
        $customers = User::where('role' , 3)->get();

        return view('customers.index')
            ->with('customers', $customers);
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

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }

        return view('machines.show')->with('customer', $customer);
    }
}
