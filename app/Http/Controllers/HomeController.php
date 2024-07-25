<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Vehicle;
use App\Models\Project;
use App\Models\Trip;
use App\Models\Insurance;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

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
        if(auth()->user()->first_login) {
            return redirect()->route('password.change');
        }
        $today = Carbon::today();
        $nextMonth = $today->copy()->addDays(30);

        $vehicleActive = Vehicle::where('is_active', 1)
            ->where(function($query) use ($today) {
                $query->whereNull('rental_end_date')
                    ->orWhere('rental_end_date', '>=', $today);
            })
            ->count();

        $vehicleInactive = Vehicle::where('is_active', 0)
            ->where(function($query) use ($today) {
                $query->whereNull('rental_end_date')
                    ->orWhere('rental_end_date', '>=', $today);
            })
            ->count();

        // Seguros prestes a acabar
        $endingInsurances = Insurance::whereBetween('end_date', [$today, $nextMonth])
            ->orderBy('end_date', 'asc')
            ->paginate(10);

        // Viagens ativas para o empregado
        $employee = Employee::with(['trips' => function ($query) use ($today) {
            $query->where('start_date', '<=', $today)
                ->where('end_date', '>=', $today)
                ->with(['vehicles' => function ($query) {
                    $query->where('is_active', 1);
                }]);
        }])->find($employeeId);

        // Viagens que terminam hoje
        $tripsEndingToday = Trip::whereDate('end_date', $today)->count();

        // Seguros que terminam em 30 dias
        $insurancesEndingIn30Days = Insurance::whereBetween('end_date', [$today, $nextMonth])->count();

        $activeTrips = $employee->trips()->with('vehicles')->paginate(10);

        return view('home', compact(
            'vehicleActive',
            'vehicleInactive',
            'endingInsurances',
            'activeTrips',
            'tripsEndingToday',
            'insurancesEndingIn30Days'
        ));
    }


    public function fetchData()
    {
        $today = Carbon::today();

        $internalVehiclesCount = Vehicle::where('is_external', 0)
            ->where(function($query) use ($today) {
                $query->whereNull('rental_end_date')
                    ->orWhere('rental_end_date', '>=', $today);
            })
            ->count();

        $externalVehiclesCount = Vehicle::where('is_external', 1)
            ->where(function($query) use ($today) {
                $query->whereNull('rental_end_date')
                    ->orWhere('rental_end_date', '>=', $today);
            })
            ->count();



        $projectsNotStarted = Project::where('project_status_id', 1)->count();
        $projectsInProgress = Project::where('project_status_id', 2)->count();
        $projectsCompleted = Project::where('project_status_id', 3)->count();
        $projectsCancelled = Project::where('project_status_id', 4)->count();
        $projectsOnHold = Project::where('project_status_id', 5)->count();

        return response()->json([
            'vehiclesData' => [
                'internal' => $internalVehiclesCount,
                'external' => $externalVehiclesCount,
            ],
            'projectsData' => [
                'notStarted' => $projectsNotStarted,
                'inProgress' => $projectsInProgress,
                'completed' => $projectsCompleted,
                'cancelled' => $projectsCancelled,
                'onHold' => $projectsOnHold,
            ]
        ]);
    }

}
