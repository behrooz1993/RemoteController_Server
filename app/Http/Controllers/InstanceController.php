<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInstanceRequest;
use App\Http\Requests\UpdateInstanceRequest;
use App\Repositories\InstanceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class InstanceController extends AppBaseController
{
    /** @var  InstanceRepository */
    private $instanceRepository;

    public function __construct(InstanceRepository $instanceRepo)
    {
        $this->instanceRepository = $instanceRepo;
    }

    /**
     * Display a listing of the Instance.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $instances = $this->instanceRepository->all();

        return view('instances.index')
            ->with('instances', $instances);
    }

    /**
     * Show the form for creating a new Instance.
     *
     * @return Response
     */
    public function create()
    {
        return view('instances.create');
    }

    /**
     * Store a newly created Instance in storage.
     *
     * @param CreateInstanceRequest $request
     *
     * @return Response
     */
    public function store(CreateInstanceRequest $request)
    {
        $input = $request->all();

        $instance = $this->instanceRepository->create($input);

        Flash::success('Instance saved successfully.');

        return redirect(route('instances.index'));
    }

    /**
     * Display the specified Instance.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $instance = $this->instanceRepository->find($id);

        if (empty($instance)) {
            Flash::error('Instance not found');

            return redirect(route('instances.index'));
        }

        return view('instances.show')->with('instance', $instance);
    }

    /**
     * Show the form for editing the specified Instance.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $instance = $this->instanceRepository->find($id);

        if (empty($instance)) {
            Flash::error('Instance not found');

            return redirect(route('instances.index'));
        }

        return view('instances.edit')->with('instance', $instance);
    }

    /**
     * Update the specified Instance in storage.
     *
     * @param int $id
     * @param UpdateInstanceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInstanceRequest $request)
    {
        $instance = $this->instanceRepository->find($id);

        if (empty($instance)) {
            Flash::error('Instance not found');

            return redirect(route('instances.index'));
        }

        $instance = $this->instanceRepository->update($request->all(), $id);

        Flash::success('Instance updated successfully.');

        return redirect(route('instances.index'));
    }

    /**
     * Remove the specified Instance from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $instance = $this->instanceRepository->find($id);

        if (empty($instance)) {
            Flash::error('Instance not found');

            return redirect(route('instances.index'));
        }

        $this->instanceRepository->delete($id);

        Flash::success('Instance deleted successfully.');

        return redirect(route('instances.index'));
    }
}
