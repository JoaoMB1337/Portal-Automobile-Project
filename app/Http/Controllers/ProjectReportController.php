<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Trip;
use TCPDF;

class ProjectReportController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::all();
        $projectId = $request->input('project_id');
        $totalCost = 0;
        $tripCount = 0;
        $trips = collect();

        if ($projectId) {
            $allTrips = Trip::where('project_id', $projectId)
                ->with(['tripDetails', 'tripDetails.costType'])
                ->get();

            $totalCost = $allTrips->sum(function ($trip) {
                return $trip->tripDetails->sum('cost');
            });
            $tripCount = $allTrips->sum(function ($trip) {
                return $trip->tripDetails->count();
            });

            // Aplica a paginação
            $trips = Trip::where('project_id', $projectId)
                ->with(['tripDetails', 'tripDetails.costType'])
                ->paginate(10);
        }

        return view('pages.Project-report.index', compact('projects', 'trips', 'projectId', 'totalCost', 'tripCount'));
    }

    public function filter(Request $request)
    {
        $request->validate([
            'project_id' => 'required|integer|exists:projects,id',
        ]);

        $projectId = $request->project_id;
        $projects = Project::all();
        $totalCost = 0;
        $tripCount = 0;
        $trips = collect();

        if ($projectId) {
            $allTrips = Trip::where('project_id', $projectId)
                ->with(['tripDetails', 'tripDetails.costType'])
                ->get();

            $totalCost = $allTrips->sum(function ($trip) {
                return $trip->tripDetails->sum('cost');
            });
            $tripCount = $allTrips->sum(function ($trip) {
                return $trip->tripDetails->count();
            });

            $trips = Trip::where('project_id', $projectId)
                ->with(['tripDetails', 'tripDetails.costType'])
                ->paginate(10);
        }

        return view('pages.Project-report.index', compact('projects', 'trips', 'projectId', 'totalCost', 'tripCount'));
    }

    public function generateProjectReport(Request $request)
    {
        $request->validate([
            'project_id' => 'required|integer|exists:projects,id',
        ]);

        $projectId = $request->project_id;
        $trips = Trip::where('project_id', $projectId)
            ->with(['tripDetails', 'tripDetails.costType'])
            ->get();

        $totalCost = $trips->sum(function ($trip) {
            return $trip->tripDetails->sum('cost');
        });
        $tripCount = $trips->sum(function ($trip) {
            return $trip->tripDetails->count();
        });

        $data = [
            'trips' => $trips,
            'project' => Project::find($projectId),
            'totalCost' => $totalCost,
            'tripCount' => $tripCount,
        ];

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Relatório de Projetos');
        $pdf->SetSubject('Relatório de Projetos');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();

        $html = view('components.Project-reports.project-pdf-report', $data)->render();
        $pdf->writeHTML($html, true, false, true, false, '');

        return $pdf->Output('project_report.pdf', 'D');
    }
}

