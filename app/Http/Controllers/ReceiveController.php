<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReceiveRequest;
use App\Http\Requests\UpdateReceiveRequest;
use App\Repositories\ReceiveRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ReceiveController extends AppBaseController
{
    /** @var  ReceiveRepository */
    private $receiveRepository;

    public function __construct(ReceiveRepository $receiveRepo)
    {
        $this->receiveRepository = $receiveRepo;
    }

    /**
     * Display a listing of the Receive.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->receiveRepository->pushCriteria(new RequestCriteria($request));
        $receives = $this->receiveRepository->all();

        return view('receives.index')
            ->with('receives', $receives);
    }

    /**
     * Show the form for creating a new Receive.
     *
     * @return Response
     */
    public function create()
    {
        return view('receives.create');
    }

    /**
     * Store a newly created Receive in storage.
     *
     * @param CreateReceiveRequest $request
     *
     * @return Response
     */
    public function store(CreateReceiveRequest $request)
    {
        $input = $request->all();

        $receive = $this->receiveRepository->create($input);

        Flash::success('Receive saved successfully.');

        return redirect(route('receives.index'));
    }

    /**
     * Display the specified Receive.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $receive = $this->receiveRepository->findWithoutFail($id);

        if (empty($receive)) {
            Flash::error('Receive not found');

            return redirect(route('receives.index'));
        }

        return view('receives.show')->with('receive', $receive);
    }

    /**
     * Show the form for editing the specified Receive.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $receive = $this->receiveRepository->findWithoutFail($id);

        if (empty($receive)) {
            Flash::error('Receive not found');

            return redirect(route('receives.index'));
        }

        return view('receives.edit')->with('receive', $receive);
    }

    /**
     * Update the specified Receive in storage.
     *
     * @param  int              $id
     * @param UpdateReceiveRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReceiveRequest $request)
    {
        $receive = $this->receiveRepository->findWithoutFail($id);

        if (empty($receive)) {
            Flash::error('Receive not found');

            return redirect(route('receives.index'));
        }

        $receive = $this->receiveRepository->update($request->all(), $id);

        Flash::success('Receive updated successfully.');

        return redirect(route('receives.index'));
    }

    /**
     * Remove the specified Receive from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $receive = $this->receiveRepository->findWithoutFail($id);

        if (empty($receive)) {
            Flash::error('Receive not found');

            return redirect(route('receives.index'));
        }

        $this->receiveRepository->delete($id);

        Flash::success('Receive deleted successfully.');

        return redirect(route('receives.index'));
    }
}
