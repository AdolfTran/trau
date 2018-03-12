<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCostRequest;
use App\Models\Cost;
use Laracasts\Flash\Flash;

class CostController extends AppBaseController
{
    public function index()
    {
        $costs = Cost::all();
        return view('cost.index')
            ->with('costs', $costs);
    }

    public function create()
    {
        return view('cost.create');
    }

    public function store(CreateCostRequest $request)
    {
        $input = $request->all();
        Cost::create($input);

        return redirect('cost/');
    }

    public function edit($id)
    {
        $cost  = Cost::findOrFail($id);;

        if (empty($cost)) {
            Flash::error('Chi phí không tìm thấy!');

            return redirect(route('cost.index'));
        }

        return view('cost.edit')->with('cost', $cost);
    }

    public function update($id, CreateCostRequest $request)
    {
        $cost = Cost::findOrFail($id);

        if (empty($cost)) {
            Flash::error('Chi phí không tìm thấy!');

            return redirect(route('cost.index'));
        }
        $input['amount_money'] = $request->all()['amount_money'];
        $input['description'] = $request->all()['description'];
        $input['date'] = $request->all()['date'];
        $input['people'] = $request->all()['people'];

        $cost = Cost::where('id', $id)->update($input);

        Flash::success('Updated successfully.');

        return redirect(route('cost.index'));
    }

    public function destroy($id)
    {
        $cost = Cost::findOrFail($id);

        if (empty($cost)) {
            Flash::error('Chi phí không tìm thấy!');

            return redirect(route('cost.index'));
        }

        Cost::where('id', $id)->delete();

        Flash::success('Deleted successfully.');

        return redirect(route('cost.index'));
    }
}
