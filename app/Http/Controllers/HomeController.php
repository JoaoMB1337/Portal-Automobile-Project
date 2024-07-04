<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Vehicle;
use App\Models\Project;
use App\Models\Trip;
use App\Models\Insurance;

use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $employeeId = auth()->id();

        // Contagem dos veículos internos e externos
        $internalVehiclesCount = Vehicle::where('is_external', 0)->count();
        $externalVehiclesCount = Vehicle::where('is_external', 1)->count();
        $vehicleactive = Vehicle::where('is_active', 1)->count();

        // Status dos projetos
        $projectsNotStarted = Project::where('project_status_id', 1)->count();
        $projectsInProgress = Project::where('project_status_id', 2)->count();
        $projectsCompleted = Project::where('project_status_id', 3)->count();
        $projectsCancelled = Project::where('project_status_id', 4)->count();
        $projectsOnHold = Project::where('project_status_id', 5)->count();

        // Seguros prestes a vencer
        $today = Carbon::today();
        $nextMonth = $today->copy()->addDays(30);
        $endingInsurances = Insurance::whereBetween('end_date', [$today, $nextMonth])
                                    ->orderBy('end_date', 'asc')
                                    ->paginate(10);

        // Recuperar viagens ativas para o empregado
        $employee = Employee::with(['trips' => function ($query) use ($today) {
            $query->where('start_date', '<=', $today)
                ->where('end_date', '>=', $today);
        }])->find($employeeId);

        $activeTrips = $employee->trips()->paginate(10);

        return view('home', compact(
            'internalVehiclesCount',
            'externalVehiclesCount',
            'vehicleactive',
            'projectsNotStarted',
            'projectsInProgress',
            'projectsCompleted',
            'projectsCancelled',
            'projectsOnHold',
            'endingInsurances',
            'activeTrips'
        ));
    }
}
