<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    protected $menuActive = 'dashboard';
    protected $subMenuActive = 'home';
    protected $pageTitle;
    protected $siteTitle;
    protected $subPageTitle;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return $this->viewDashboard('index');
    }

    /**
     * Display a view with data(s).
     * @return Response
     */
    protected function viewDashboard($view='dashboard', $newData = []){
        $oldData = [
            'menuActive' => $this->menuActive,
            'subMenuActive' => $this->subMenuActive,
            'pageTitle' => !empty($this->pageTitle) ? $this->pageTitle : trans('dashboard::dashboard.dashboard'),
            'siteTitle' => !empty($this->siteTitle) ? $this->siteTitle : config('app.name', 'Laravel'),
            'subPageTitle' => !empty($this->subPageTitle) ? $this->subPageTitle : null
        ];
        $data = array_merge($oldData, $newData);
        return view('dashboard::'.$view, $data);
    }

}
