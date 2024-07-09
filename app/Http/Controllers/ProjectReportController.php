<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Trip;
use Carbon\Carbon;
use TCPDF;

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

        return view('pages.ProjectReport.index', compact('projects', 'trips', 'projectId', 'totalCost', 'tripCount',  'costTypesSummary'));
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

    public function generateProjectReport(Request $request)
    {
        $request->validate([
            'project_id' => 'required|integer|exists:projects,id',
        ], [
            'project_id.required' => 'O projeto é obrigatório.',
            'project_id.integer' => 'O projeto deve ser um número inteiro.',
            'project_id.exists' => 'O projeto selecionado não existe.',
        ]);

        $projectId = $request->input('project_id');
        $project = Project::find($projectId);

        $trips = Trip::where('project_id', $projectId)
            ->with(['tripDetails', 'tripDetails.costType'])
            ->get();

        $totalCost = $trips->sum(function ($trip) {
            return $trip->tripDetails->sum('cost');
        });
        $tripCount = $trips->count();

        $costTypesSummary = $trips->flatMap(function ($trip) {
            return $trip->tripDetails;
        })->groupBy('cost_type_id')->map(function ($details) {
            return [
                'type_name' => $details->first()->costType->type_name,
                'total_cost' => $details->sum('cost'),
                'details' => $details
            ];
        });

        $data = [
            'project' => $project,
            'trips' => $trips,
            'totalCost' => $totalCost,
            'tripCount' => $tripCount,
            'costTypesSummary' => $costTypesSummary,
        ];

        // Configurar o PDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Seu Nome');
        $pdf->SetTitle('Relatório de Projetos');
        $pdf->SetSubject('Relatório de Projetos');
        $pdf->SetKeywords('TCPDF, PDF, exemplo, teste, guia');

        // Remover cabeçalho e rodapé padrão
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Adicionar uma página
        $pdf->AddPage();

        // Definir o conteúdo do PDF
        $html = view('components.ProjectReports.project-pdf-report', $data)->render();

        $pdf->writeHTML($html, true, false, true, false, '');

        // Fechar e gerar o PDF
        $pdf->lastPage();
        return $pdf->Output('project_report.pdf', 'D'); // 'D' força o download
    }

    
}
