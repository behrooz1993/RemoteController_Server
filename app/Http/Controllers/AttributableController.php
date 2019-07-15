<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttributableRequest;
use App\Http\Requests\UpdateAttributableRequest;
use App\Repositories\AttributableRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AttributableController extends AppBaseController
{
    /** @var  AttributableRepository */
    private $attributableRepository;

    public function __construct(AttributableRepository $attributableRepo)
    {
        $this->attributableRepository = $attributableRepo;
    }

    /**
     * Display a listing of the Attributable.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $attributables = $this->attributableRepository->all();

        return view('attributables.index')
            ->with('attributables', $attributables);
    }

    /**
     * Show the form for creating a new Attributable.
     *
     * @return Response
     */
    public function create()
    {
        return view('attributables.create');
    }

    /**
     * Store a newly created Attributable in storage.
     *
     * @param CreateAttributableRequest $request
     *
     * @return Response
     */
    public function store(CreateAttributableRequest $request)
    {
        $input = $request->all();

        $attributable = $this->attributableRepository->create($input);

        Flash::success('Attributable saved successfully.');

        return redirect(route('attributables.index'));
    }

    /**
     * Display the specified Attributable.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $attributable = $this->attributableRepository->find($id);

        if (empty($attributable)) {
            Flash::error('Attributable not found');

            return redirect(route('attributables.index'));
        }

        return view('attributables.show')->with('attributable', $attributable);
    }

    /**
     * Show the form for editing the specified Attributable.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $attributable = $this->attributableRepository->find($id);

        if (empty($attributable)) {
            Flash::error('Attributable not found');

            return redirect(route('attributables.index'));
        }

        return view('attributables.edit')->with('attributable', $attributable);
    }

    /**
     * Update the specified Attributable in storage.
     *
     * @param int $id
     * @param UpdateAttributableRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAttributableRequest $request)
    {
        $attributable = $this->attributableRepository->find($id);

        if (empty($attributable)) {
            Flash::error('Attributable not found');

            return redirect(route('attributables.index'));
        }

        $attributable = $this->attributableRepository->update($request->all(), $id);

        Flash::success('Attributable updated successfully.');

        return redirect(route('attributables.index'));
    }

    /**
     * Remove the specified Attributable from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $attributable = $this->attributableRepository->find($id);

        if (empty($attributable)) {
            Flash::error('Attributable not found');

            return redirect(route('attributables.index'));
        }

        $this->attributableRepository->delete($id);

        Flash::success('Attributable deleted successfully.');

        return redirect(route('attributables.index'));
    }
}
