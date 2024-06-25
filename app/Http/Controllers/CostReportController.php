<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TripDetail;
use TCPDF;

class CostReportController extends Controller
{
    public function index(Request $request)
    {
        $costs = collect(); // Coleção vazia para inicializar

        if ($request->has(['start_date', 'end_date'])) {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            $startDate = $request->start_date;
            $endDate = $request->end_date;

            $costs = TripDetail::whereBetween('created_at', [$startDate, $endDate])
                ->with(['costType', 'trip'])
                ->get();
        }

        return view('pages.Cost-report.index', compact('costs'));
    }

    public function generateCostReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $costs = TripDetail::whereBetween('created_at', [$startDate, $endDate])
            ->with(['costType', 'trip'])
            ->get();

        $data = [
            'costs' => $costs,
            'start_date' => $startDate,
            'end_date' => $endDate
        ];

        // Configurar o PDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Relatório de Custos');
        $pdf->SetSubject('Relatório de Custos');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // Remover cabeçalho e rodapé padrão
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Adicionar uma página
        $pdf->AddPage();

        // Definir o conteúdo do PDF
        $html = view('components.Cost-reports.costTrip-pdf-report', $data)->render();

        $pdf->writeHTML($html, true, false, true, false, '');

        // Fechar e gerar o PDF
        $pdf->lastPage();
        return $pdf->Output('cost_report.pdf', 'D'); // 'D' força o download
    }
}
