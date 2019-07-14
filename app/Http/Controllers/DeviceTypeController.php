<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDeviceTypeRequest;
use App\Http\Requests\UpdateDeviceTypeRequest;
use App\Repositories\DeviceTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class DeviceTypeController extends AppBaseController
{
    /** @var  DeviceTypeRepository */
    private $deviceTypeRepository;

    public function __construct(DeviceTypeRepository $deviceTypeRepo)
    {
        $this->deviceTypeRepository = $deviceTypeRepo;
    }

    /**
     * Display a listing of the DeviceType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $deviceTypes = $this->deviceTypeRepository->all();

        return view('device_types.index')
            ->with('deviceTypes', $deviceTypes);
    }

    /**
     * Show the form for creating a new DeviceType.
     *
     * @return Response
     */
    public function create()
    {
        return view('device_types.create');
    }

    /**
     * Store a newly created DeviceType in storage.
     *
     * @param CreateDeviceTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateDeviceTypeRequest $request)
    {
        $input = $request->all();

        $deviceType = $this->deviceTypeRepository->create($input);

        Flash::success('Device Type saved successfully.');

        return redirect(route('deviceTypes.index'));
    }

    /**
     * Display the specified DeviceType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $deviceType = $this->deviceTypeRepository->find($id);

        if (empty($deviceType)) {
            Flash::error('Device Type not found');

            return redirect(route('deviceTypes.index'));
        }

        return view('device_types.show')->with('deviceType', $deviceType);
    }

    /**
     * Show the form for editing the specified DeviceType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $deviceType = $this->deviceTypeRepository->find($id);

        if (empty($deviceType)) {
            Flash::error('Device Type not found');

            return redirect(route('deviceTypes.index'));
        }

        return view('device_types.edit')->with('deviceType', $deviceType);
    }

    /**
     * Update the specified DeviceType in storage.
     *
     * @param int $id
     * @param UpdateDeviceTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeviceTypeRequest $request)
    {
        $deviceType = $this->deviceTypeRepository->find($id);

        if (empty($deviceType)) {
            Flash::error('Device Type not found');

            return redirect(route('deviceTypes.index'));
        }

        $deviceType = $this->deviceTypeRepository->update($request->all(), $id);

        Flash::success('Device Type updated successfully.');

        return redirect(route('deviceTypes.index'));
    }

    /**
     * Remove the specified DeviceType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deviceType = $this->deviceTypeRepository->find($id);

        if (empty($deviceType)) {
            Flash::error('Device Type not found');

            return redirect(route('deviceTypes.index'));
        }

        $this->deviceTypeRepository->delete($id);

        Flash::success('Device Type deleted successfully.');

        return redirect(route('deviceTypes.index'));
    }
}
