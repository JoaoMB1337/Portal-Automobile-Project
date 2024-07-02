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
        $trips = collect(); // Coleção vazia para inicializar
        $projectId = null;

        if ($request->has('project_id')) {
            $projectId = $request->project_id;
            $trips = Trip::where('project_id', $projectId)
                ->with(['tripDetails', 'tripDetails.costType'])
                ->get();
        }

        return view('pages.Project-report.index', compact('projects', 'trips', 'projectId'));
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

        $projects = Project::all(); // Adicione esta linha para garantir que a variável $projects esteja disponível

        return view('pages.Project-report.index', compact('trips', 'projectId', 'projects'));
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

        $data = [
            'trips' => $trips,
            'project' => Project::find($projectId)
        ];

        // Configurar o PDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Relatório de Projetos');
        $pdf->SetSubject('Relatório de Projetos');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // Remover cabeçalho e rodapé padrão
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Adicionar uma página
        $pdf->AddPage();

        // Definir o conteúdo do PDF
        $html = view('components.Project-reports.project-pdf-report', $data)->render();

        $pdf->writeHTML($html, true, false, true, false, '');

        // Fechar e gerar o PDF
        $pdf->lastPage();
        return $pdf->Output('project_report.pdf', 'D'); // 'D' força o download
    }
}
