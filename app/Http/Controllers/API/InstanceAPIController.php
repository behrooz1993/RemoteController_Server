<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInstanceAPIRequest;
use App\Http\Requests\API\UpdateInstanceAPIRequest;
use App\Models\Instance;
use App\Repositories\InstanceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class InstanceController
 * @package App\Http\Controllers\API
 */

class InstanceAPIController extends AppBaseController
{
    /** @var  InstanceRepository */
    private $instanceRepository;

    public function __construct(InstanceRepository $instanceRepo)
    {
        $this->instanceRepository = $instanceRepo;
    }

    /**
     * Display a listing of the Instance.
     * GET|HEAD /instances
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $instances = $this->instanceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($instances->toArray(), 'Instances retrieved successfully');
    }

    /**
     * Store a newly created Instance in storage.
     * POST /instances
     *
     * @param CreateInstanceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateInstanceAPIRequest $request)
    {
        $input = $request->all();

        $instance = $this->instanceRepository->create($input);

        return $this->sendResponse($instance->toArray(), 'Instance saved successfully');
    }

    /**
     * Display the specified Instance.
     * GET|HEAD /instances/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Instance $instance */
        $instance = $this->instanceRepository->find($id);

        if (empty($instance)) {
            return $this->sendError('Instance not found');
        }

        return $this->sendResponse($instance->toArray(), 'Instance retrieved successfully');
    }

    /**
     * Update the specified Instance in storage.
     * PUT/PATCH /instances/{id}
     *
     * @param int $id
     * @param UpdateInstanceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInstanceAPIRequest $request)
    {
        $input = $request->all();

        /** @var Instance $instance */
        $instance = $this->instanceRepository->find($id);

        if (empty($instance)) {
            return $this->sendError('Instance not found');
        }

        $instance = $this->instanceRepository->update($input, $id);

        return $this->sendResponse($instance->toArray(), 'Instance updated successfully');
    }

    /**
     * Remove the specified Instance from storage.
     * DELETE /instances/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Instance $instance */
        $instance = $this->instanceRepository->find($id);

        if (empty($instance)) {
            return $this->sendError('Instance not found');
        }

        $instance->delete();

        return $this->sendResponse($id, 'Instance deleted successfully');
    }
}
