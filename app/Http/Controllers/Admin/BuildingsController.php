<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\Building\IndexBuilding;
use App\Http\Requests\Admin\Building\StoreBuilding;
use App\Http\Requests\Admin\Building\UpdateBuilding;
use App\Http\Requests\Admin\Building\DestroyBuilding;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Building;

class BuildingsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexBuilding $request
     * @return Response|array
     */
    public function index(IndexBuilding $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Building::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'address'],

            // set columns to searchIn
            ['id', 'name', 'description', 'address']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.building.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.building.create');

        return view('admin.building.create')->with([
            'mode' => 'create'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBuilding $request
     * @return Response|array
     */
    public function store(StoreBuilding $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Building
        $building = Building::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/buildings'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/buildings');
    }

    /**
     * Display the specified resource.
     *
     * @param  Building $building
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Building $building)
    {
        $this->authorize('admin.building.show', $building);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Building $building
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Building $building)
    {
        $this->authorize('admin.building.edit', $building);

        return view('admin.building.edit', [
            'building' => $building,
            'mode'  => 'edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateBuilding $request
     * @param  Building $building
     * @return Response|array
     */
    public function update(UpdateBuilding $request, Building $building)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values Building
        $building->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/buildings'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/buildings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyBuilding $request
     * @param  Building $building
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyBuilding $request, Building $building)
    {
        $building->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
