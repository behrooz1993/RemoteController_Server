<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAttributeGroupAPIRequest;
use App\Http\Requests\API\UpdateAttributeGroupAPIRequest;
use App\Models\AttributeGroup;
use App\Repositories\AttributeGroupRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AttributeGroupController
 * @package App\Http\Controllers\API
 */

class AttributeGroupAPIController extends AppBaseController
{
    /** @var  AttributeGroupRepository */
    private $attributeGroupRepository;

    public function __construct(AttributeGroupRepository $attributeGroupRepo)
    {
        $this->attributeGroupRepository = $attributeGroupRepo;
    }

    /**
     * Display a listing of the AttributeGroup.
     * GET|HEAD /attributeGroups
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $attributeGroups = $this->attributeGroupRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($attributeGroups->toArray(), 'Attribute Groups retrieved successfully');
    }

    /**
     * Store a newly created AttributeGroup in storage.
     * POST /attributeGroups
     *
     * @param CreateAttributeGroupAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAttributeGroupAPIRequest $request)
    {
        $input = $request->all();

        $attributeGroup = $this->attributeGroupRepository->create($input);

        return $this->sendResponse($attributeGroup->toArray(), 'Attribute Group saved successfully');
    }

    /**
     * Display the specified AttributeGroup.
     * GET|HEAD /attributeGroups/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var AttributeGroup $attributeGroup */
        $attributeGroup = $this->attributeGroupRepository->find($id);

        if (empty($attributeGroup)) {
            return $this->sendError('Attribute Group not found');
        }

        return $this->sendResponse($attributeGroup->toArray(), 'Attribute Group retrieved successfully');
    }

    /**
     * Update the specified AttributeGroup in storage.
     * PUT/PATCH /attributeGroups/{id}
     *
     * @param int $id
     * @param UpdateAttributeGroupAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAttributeGroupAPIRequest $request)
    {
        $input = $request->all();

        /** @var AttributeGroup $attributeGroup */
        $attributeGroup = $this->attributeGroupRepository->find($id);

        if (empty($attributeGroup)) {
            return $this->sendError('Attribute Group not found');
        }

        $attributeGroup = $this->attributeGroupRepository->update($input, $id);

        return $this->sendResponse($attributeGroup->toArray(), 'AttributeGroup updated successfully');
    }

    /**
     * Remove the specified AttributeGroup from storage.
     * DELETE /attributeGroups/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var AttributeGroup $attributeGroup */
        $attributeGroup = $this->attributeGroupRepository->find($id);

        if (empty($attributeGroup)) {
            return $this->sendError('Attribute Group not found');
        }

        $attributeGroup->delete();

        return $this->sendResponse($id, 'Attribute Group deleted successfully');
    }
}
