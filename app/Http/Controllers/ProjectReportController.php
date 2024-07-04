<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Trip;
use Carbon\Carbon;

class ProjectReportController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::all();
        $projectId = $request->input('project_id');
        $totalCost = 0;
        $tripCount = 0;
        $costTypesSummary = collect();
        $trips = collect();

        if ($projectId) {
            $query = Trip::where('project_id', $projectId)
                ->with(['tripDetails', 'tripDetails.costType']);

            $allTrips = $query->get();

            $totalCost = $allTrips->sum(function ($trip) {
                return $trip->tripDetails->sum('cost');
            });
            $tripCount = $allTrips->count();

            $costTypesSummary = $allTrips->flatMap(function ($trip) {
                return $trip->tripDetails;
            })->groupBy('cost_type_id')->map(function ($details) {
                return [
                    'type_name' => $details->first()->costType->type_name,
                    'total_cost' => $details->sum('cost'),
                    'details' => $details
                ];
            });

            $trips = $query->paginate(10);
        }

        return view('pages.Project-report.index', compact('projects', 'trips', 'projectId', 'totalCost', 'tripCount',  'costTypesSummary'));
    }

    public function filter(Request $request)
    {
        $request->validate([
            'project_id' => 'nullable|integer|exists:projects,id',
        ], [
            'project_id.required' => 'O projeto é obrigatório.',
            'project_id.integer' => 'O projeto deve ser um número inteiro.',
            'project_id.exists' => 'O projeto selecionado não existe.',
        ]);

        return redirect()->route('project.report.index', [
            'project_id' => $request->input('project_id'),
        ]);
    }
}
