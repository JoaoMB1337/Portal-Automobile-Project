<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use TCPDF;
use Carbon\Carbon;

class ExternalCarReportController extends Controller
{
    public function index(Request $request)
    {
        $vehicles = collect(); // Coleção vazia para inicializar

        if ($request->has(['start_date', 'end_date'])) {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            $startDate = $request->start_date;
            $endDate = $request->end_date;

            $vehicles = Vehicle::where('is_external', true)
                ->where(function($query) use ($startDate, $endDate) {
                    $query->whereBetween('rental_start_date', [$startDate, $endDate])
                        ->orWhereBetween('rental_end_date', [$startDate, $endDate]);
                })
                ->with(['fuelType', 'carCategory', 'brand', 'vehicleCondition'])
                ->get();
        }

        return view('pages.ExternalCarReport.index', compact('vehicles'));
    }

    public function generateExternalCarReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $vehicles = Vehicle::where('is_external', true)
            ->where(function($query) use ($startDate, $endDate) {
                $query->whereBetween('rental_start_date', [$startDate, $endDate])
                    ->orWhereBetween('rental_end_date', [$startDate, $endDate]);
            })
            ->with(['fuelType', 'carCategory', 'brand', 'vehicleCondition'])
            ->get();

        // Calcular o custo total de aluguel para cada veículo
        foreach ($vehicles as $vehicle) {
            $rentalStartDate = Carbon::parse($vehicle->rental_start_date);
            $rentalEndDate = Carbon::parse($vehicle->rental_end_date);
            $numberOfDays = $rentalStartDate->diffInDays($rentalEndDate) + 1; // Adicionar +1 para incluir o dia final
            $vehicle->total_rental_cost = $vehicle->rental_price_per_day * $numberOfDays;
        }

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
        $html = view('components.ExternalCarReport.pdf-report', $data)->render();

        $pdf->writeHTML($html, true, false, true, false, '');

        // Fechar e gerar o PDF
        $pdf->lastPage();
        return $pdf->Output('external_car_report.pdf', 'D'); // 'D' força o download
    }
}
