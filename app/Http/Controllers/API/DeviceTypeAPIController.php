<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDeviceTypeAPIRequest;
use App\Http\Requests\API\UpdateDeviceTypeAPIRequest;
use App\Models\DeviceType;
use App\Repositories\DeviceTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DeviceTypeController
 * @package App\Http\Controllers\API
 */

class DeviceTypeAPIController extends AppBaseController
{
    /** @var  DeviceTypeRepository */
    private $deviceTypeRepository;

    public function __construct(DeviceTypeRepository $deviceTypeRepo)
    {
        $this->deviceTypeRepository = $deviceTypeRepo;
    }

    /**
     * Display a listing of the DeviceType.
     * GET|HEAD /deviceTypes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $deviceTypes = $this->deviceTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($deviceTypes->toArray(), 'Device Types retrieved successfully');
    }

    /**
     * Store a newly created DeviceType in storage.
     * POST /deviceTypes
     *
     * @param CreateDeviceTypeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDeviceTypeAPIRequest $request)
    {
        $input = $request->all();

        $deviceType = $this->deviceTypeRepository->create($input);

        return $this->sendResponse($deviceType->toArray(), 'Device Type saved successfully');
    }

    /**
     * Display the specified DeviceType.
     * GET|HEAD /deviceTypes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var DeviceType $deviceType */
        $deviceType = $this->deviceTypeRepository->find($id);

        if (empty($deviceType)) {
            return $this->sendError('Device Type not found');
        }

        return $this->sendResponse($deviceType->toArray(), 'Device Type retrieved successfully');
    }

    /**
     * Update the specified DeviceType in storage.
     * PUT/PATCH /deviceTypes/{id}
     *
     * @param int $id
     * @param UpdateDeviceTypeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeviceTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var DeviceType $deviceType */
        $deviceType = $this->deviceTypeRepository->find($id);

        if (empty($deviceType)) {
            return $this->sendError('Device Type not found');
        }

        $deviceType = $this->deviceTypeRepository->update($input, $id);

        return $this->sendResponse($deviceType->toArray(), 'DeviceType updated successfully');
    }

    /**
     * Remove the specified DeviceType from storage.
     * DELETE /deviceTypes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var DeviceType $deviceType */
        $deviceType = $this->deviceTypeRepository->find($id);

        if (empty($deviceType)) {
            return $this->sendError('Device Type not found');
        }

        $deviceType->delete();

        return $this->sendResponse($id, 'Device Type deleted successfully');
    }
}
