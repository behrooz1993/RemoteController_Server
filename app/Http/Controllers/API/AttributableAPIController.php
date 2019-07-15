<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAttributableAPIRequest;
use App\Http\Requests\API\UpdateAttributableAPIRequest;
use App\Models\Attributable;
use App\Repositories\AttributableRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AttributableController
 * @package App\Http\Controllers\API
 */

class AttributableAPIController extends AppBaseController
{
    /** @var  AttributableRepository */
    private $attributableRepository;

    public function __construct(AttributableRepository $attributableRepo)
    {
        $this->attributableRepository = $attributableRepo;
    }

    /**
     * Display a listing of the Attributable.
     * GET|HEAD /attributables
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $attributables = $this->attributableRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($attributables->toArray(), 'Attributables retrieved successfully');
    }

    /**
     * Store a newly created Attributable in storage.
     * POST /attributables
     *
     * @param CreateAttributableAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAttributableAPIRequest $request)
    {
        $input = $request->all();

        $attributable = $this->attributableRepository->create($input);

        return $this->sendResponse($attributable->toArray(), 'Attributable saved successfully');
    }

    /**
     * Display the specified Attributable.
     * GET|HEAD /attributables/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Attributable $attributable */
        $attributable = $this->attributableRepository->find($id);

        if (empty($attributable)) {
            return $this->sendError('Attributable not found');
        }

        return $this->sendResponse($attributable->toArray(), 'Attributable retrieved successfully');
    }

    /**
     * Update the specified Attributable in storage.
     * PUT/PATCH /attributables/{id}
     *
     * @param int $id
     * @param UpdateAttributableAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAttributableAPIRequest $request)
    {
        $input = $request->all();

        /** @var Attributable $attributable */
        $attributable = $this->attributableRepository->find($id);

        if (empty($attributable)) {
            return $this->sendError('Attributable not found');
        }

        $attributable = $this->attributableRepository->update($input, $id);

        return $this->sendResponse($attributable->toArray(), 'Attributable updated successfully');
    }

    /**
     * Remove the specified Attributable from storage.
     * DELETE /attributables/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Attributable $attributable */
        $attributable = $this->attributableRepository->find($id);

        if (empty($attributable)) {
            return $this->sendError('Attributable not found');
        }

        $attributable->delete();

        return $this->sendResponse($id, 'Attributable deleted successfully');
    }
}
