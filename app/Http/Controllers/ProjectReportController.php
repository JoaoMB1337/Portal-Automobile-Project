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
        $trips = collect(); // Inicializa como uma coleção vazia
        $projectId = $request->input('project_id');

        if ($projectId) {
            $trips = Trip::where('project_id', $projectId)
                ->with(['tripDetails', 'tripDetails.costType'])
                ->get();
        }

        // Inicializa o contador e o preço total
        $totalCost = $trips->flatMap->tripDetails->sum('cost');
        $tripCount = $trips->flatMap->tripDetails->count();

        return view('pages.Project-report.index', compact('projects', 'trips', 'projectId', 'totalCost', 'tripCount'));
    }

    public function filter(Request $request)
    {
        $request->validate([
            'project_id' => 'required|integer|exists:projects,id',
        ]);

        $projectId = $request->project_id;
        $trips = Trip::where('project_id', $projectId)
            ->with(['tripDetails', 'tripDetails.costType'])
            ->get();

        $projects = Project::all(); // Garante que a variável $projects está disponível

        // Inicializa o contador e o preço total
        $totalCost = $trips->flatMap->tripDetails->sum('cost');
        $tripCount = $trips->flatMap->tripDetails->count();

        return view('pages.Project-report.index', compact('trips', 'projectId', 'projects', 'totalCost', 'tripCount'));
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

        $totalCost = $trips->flatMap->tripDetails->sum('cost');
        $tripCount = $trips->flatMap->tripDetails->count();

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
