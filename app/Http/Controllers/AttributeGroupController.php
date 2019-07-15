<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttributeGroupRequest;
use App\Http\Requests\UpdateAttributeGroupRequest;
use App\Repositories\AttributeGroupRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AttributeGroupController extends AppBaseController
{
    /** @var  AttributeGroupRepository */
    private $attributeGroupRepository;

    public function __construct(AttributeGroupRepository $attributeGroupRepo)
    {
        $this->attributeGroupRepository = $attributeGroupRepo;
    }

    /**
     * Display a listing of the AttributeGroup.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $attributeGroups = $this->attributeGroupRepository->all();

        return view('attribute_groups.index')
            ->with('attributeGroups', $attributeGroups);
    }

    /**
     * Show the form for creating a new AttributeGroup.
     *
     * @return Response
     */
    public function create()
    {
        return view('attribute_groups.create');
    }

    /**
     * Store a newly created AttributeGroup in storage.
     *
     * @param CreateAttributeGroupRequest $request
     *
     * @return Response
     */
    public function store(CreateAttributeGroupRequest $request)
    {
        $input = $request->all();

        $attributeGroup = $this->attributeGroupRepository->create($input);

        Flash::success('Attribute Group saved successfully.');

        return redirect(route('attributeGroups.index'));
    }

    /**
     * Display the specified AttributeGroup.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $attributeGroup = $this->attributeGroupRepository->find($id);

        if (empty($attributeGroup)) {
            Flash::error('Attribute Group not found');

            return redirect(route('attributeGroups.index'));
        }

        return view('attribute_groups.show')->with('attributeGroup', $attributeGroup);
    }

    /**
     * Show the form for editing the specified AttributeGroup.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $attributeGroup = $this->attributeGroupRepository->find($id);

        if (empty($attributeGroup)) {
            Flash::error('Attribute Group not found');

            return redirect(route('attributeGroups.index'));
        }

        return view('attribute_groups.edit')->with('attributeGroup', $attributeGroup);
    }

    /**
     * Update the specified AttributeGroup in storage.
     *
     * @param int $id
     * @param UpdateAttributeGroupRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAttributeGroupRequest $request)
    {
        $attributeGroup = $this->attributeGroupRepository->find($id);

        if (empty($attributeGroup)) {
            Flash::error('Attribute Group not found');

            return redirect(route('attributeGroups.index'));
        }

        $attributeGroup = $this->attributeGroupRepository->update($request->all(), $id);

        Flash::success('Attribute Group updated successfully.');

        return redirect(route('attributeGroups.index'));
    }

    /**
     * Remove the specified AttributeGroup from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $attributeGroup = $this->attributeGroupRepository->find($id);

        if (empty($attributeGroup)) {
            Flash::error('Attribute Group not found');

            return redirect(route('attributeGroups.index'));
        }

        $this->attributeGroupRepository->delete($id);

        Flash::success('Attribute Group deleted successfully.');

        return redirect(route('attributeGroups.index'));
    }
}
