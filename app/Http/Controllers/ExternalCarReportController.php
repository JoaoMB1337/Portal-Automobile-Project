<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use TCPDF;

class ExternalCarReportController extends Controller
{
    public function index(Request $request)
    {
        // Se você quiser manter a lógica de filtro no método index
        $vehicles = collect(); 
        $startDate = null;
        $endDate = null;

        if ($request->has(['start_date', 'end_date'])) {
            $startDate = $request->start_date;
            $endDate = $request->end_date;

            $vehicles = Vehicle::whereBetween('rental_start_date', [$startDate, $endDate])
                ->whereNotNull('rental_company')
                ->get();
        }

        return view('pages.ExternalCarReport.index', compact('vehicles', 'startDate', 'endDate'));
    }

    public function filter(Request $request)
    {
        // Copiando a lógica de filtro do método index para o método filter
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $vehicles = Vehicle::whereBetween('rental_start_date', [$startDate, $endDate])
            ->whereNotNull('rental_company')
            ->get();

        return view('pages.ExternalCarReport.index', compact('vehicles', 'startDate', 'endDate'));
    }

    public function generateExternalCarReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $vehicles = Vehicle::whereBetween('rental_start_date', [$startDate, $endDate])
            ->whereNotNull('rental_company')
            ->get();

        $data = [
            'vehicles' => $vehicles,
            'start_date' => $startDate,
            'end_date' => $endDate
        ];

        // Configurar o PDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Relatório de Carros Externos');
        $pdf->SetSubject('Relatório de Carros Externos');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // Remover cabeçalho e rodapé padrão
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Adicionar uma página
        $pdf->AddPage();

        // Definir o conteúdo do PDF
        $html = view('components.ExternalCarReport.external-car-pdf-report', $data)->render();

        $pdf->writeHTML($html, true, false, true, false, '');

        // Fechar e gerar o PDF
        $pdf->lastPage();
        return $pdf->Output('external_car_report.pdf', 'D'); // 'D' força o download
    }
}
