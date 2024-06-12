<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Vehicle;
use App\Models\Project;
use App\Models\Trip;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employee = Employee::find(1);


        $internalVehiclesCount = Vehicle::where('is_external', 0)->count();
        $externalVehiclesCount = Vehicle::where('is_external', 1)->count();

        $vehicleactive = Vehicle::where('is_active', 1)->count();

        $projectsNotStarted = Project::where('project_status_id', 1)->count();
        $projectsInProgress = Project::where('project_status_id', 2)->count();
        $projectsCompleted = Project::where('project_status_id', 3)->count();
        $projectsCancelled = Project::where('project_status_id', 4)->count();
        $projectsOnHold = Project::where('project_status_id', 5)->count();

        return view('home', compact(
            'internalVehiclesCount',
            'externalVehiclesCount',
            'vehicleactive',
            'projectsNotStarted',
            'projectsInProgress',
            'projectsCompleted',
            'projectsCancelled',
            'projectsOnHold'
        ));






    }
}
