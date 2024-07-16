<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insurance;
use App\Models\Vehicle;
use TCPDF;
use Carbon\Carbon;

class InsuranceReportController extends Controller
{
    public function index(Request $request)
    {
        $insurances = collect(); 
        $startDate = null;
        $endDate = null;
        $totalCost = 0;
        $totalResults = 0;

        if ($request->has(['start_date', 'end_date'])) {
            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);

            $insurances = Insurance::whereBetween('created_at', [$startDate, $endDate])
                ->with(['vehicle'])
                ->paginate(10);

            $totalCost = $insurances->sum('cost');
            $totalResults = $insurances->total();
        }

        return view('pages.InsuranceReport.index', compact('insurances', 'startDate', 'endDate', 'totalCost', 'totalResults'));
    }

    public function filter(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ], [
            'start_date.required' => 'A data inicial é obrigatória.',
            'start_date.date' => 'A data inicial deve ser uma data válida.',
            'start_date.before_or_equal' => 'A data inicial deve ser anterior ou igual à data final.',
            'end_date.required' => 'A data final é obrigatória.',
            'end_date.date' => 'A data final deve ser uma data válida.',
            'end_date.after_or_equal' => 'A data final deve ser posterior ou igual à data inicial.',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $insurances = Insurance::whereBetween('created_at', [$startDate, $endDate])
            ->with(['vehicle'])
            ->paginate(10);

        $totalCost = $insurances->sum('cost');
        $totalResults = $insurances->total();

        return view('pages.Insurance-report.index', compact('insurances', 'startDate', 'endDate', 'totalCost', 'totalResults'));
    }

    public function generateInsuranceReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ], [
            'start_date.required' => 'A data inicial é obrigatória.',
            'start_date.date' => 'A data inicial deve ser uma data válida.',
            'start_date.before_or_equal' => 'A data inicial deve ser anterior ou igual à data final.',
            'end_date.required' => 'A data final é obrigatória.',
            'end_date.date' => 'A data final deve ser uma data válida.',
            'end_date.after_or_equal' => 'A data final deve ser posterior ou igual à data inicial.',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $insurances = Insurance::whereBetween('created_at', [$startDate, $endDate])
            ->with(['vehicle'])
            ->get();

        $data = [
            'insurances' => $insurances,
            'start_date' => $startDate,
            'end_date' => $endDate
        ];

        // Configurar o PDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Seu Nome');
        $pdf->SetTitle('Relatório de Seguros');
        $pdf->SetSubject('Relatório de Seguros');
        $pdf->SetKeywords('TCPDF, PDF, exemplo, teste, guia');

        // Remover cabeçalho e rodapé padrão
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Adicionar uma página
        $pdf->AddPage();

        // Definir o conteúdo do PDF
        $html = view('components.InsuranceReports.insurance-pdf-report', $data)->render();

        $pdf->writeHTML($html, true, false, true, false, '');

        // Fechar e gerar o PDF
        $pdf->lastPage();
        return $pdf->Output('insurance_report.pdf', 'D'); // 'D' força o download
    }
}
