<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\CountryResponsitory;
use Modules\Dashboard\Http\Requests\UpdateCountryRequest;
use Modules\Dashboard\Http\Requests\CreateCountryRequest;

class CountryController extends DashboardController
{
    protected $menuActive = 'users';
    protected $subMenuActive = 'country';
    protected $countryRepository;

    public function __construct(CountryResponsitory $countryRepository) {
        $this->countryRepository = $countryRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $countries = $this->countryRepository->all();
        return $this->viewDashboard('country.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $country = $this->countryRepository;
        return $this->viewDashboard('country.create', compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateCountryRequest $request)
    {
        $create = ['name' => $request->name];
        $create['code'] = $this->countryRepository->getMaxCode() + 1;
        $this->countryRepository->create($create);
        return redirect(route('dashboard.country.index'))->with('alert-success', 'Create country success!');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $country = $this->countryRepository->find($id);
        return $this->viewDashboard('country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateCountryRequest $request, $id)
    {
        $update = [
            'name' => $request->name,
        ];
        $this->countryRepository->update($update, $id);
        return redirect(route('dashboard.country.index'))->with('alert-success', 'Update country success!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $arItem = $this->countryRepository->find($id);
        $arItem->delete();
        return redirect(route('dashboard.country.index'))->with('alert-success', 'Delete country success');
    }
}
