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
        $vehicles = collect();

        if ($request->has(['start_date', 'end_date'])) {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);

            $vehicles = Vehicle::where('is_external', true)
                ->where(function($query) use ($startDate, $endDate) {
                    $query->where(function($q) use ($startDate, $endDate) {
                        $q->whereBetween('rental_start_date', [$startDate, $endDate])
                          ->orWhereBetween('rental_end_date', [$startDate, $endDate]);
                    })
                    ->orWhere(function($q) use ($startDate, $endDate) {
                        $q->where('rental_start_date', '<=', $startDate)
                          ->where('rental_end_date', '>=', $endDate);
                    });
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

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $vehicles = Vehicle::where('is_external', true)
            ->where(function($query) use ($startDate, $endDate) {
                $query->where(function($q) use ($startDate, $endDate) {
                    $q->whereBetween('rental_start_date', [$startDate, $endDate])
                    ->orWhereBetween('rental_end_date', [$startDate, $endDate]);
                })
                ->orWhere(function($q) use ($startDate, $endDate) {
                    $q->where('rental_start_date', '<=', $startDate)
                    ->where('rental_end_date', '>=', $endDate);
                });
            })
            ->with(['fuelType', 'carCategory', 'brand', 'vehicleCondition'])
            ->orderBy('rental_start_date', 'asc')
            ->get();

        // Calcular o custo total de aluguel para cada veículo
        foreach ($vehicles as $vehicle) {
            $rentalStartDate = Carbon::parse($vehicle->rental_start_date);
            $rentalEndDate = Carbon::parse($vehicle->rental_end_date);

            // Ajustar o intervalo de datas para que fique dentro do intervalo de datas solicitado
            $effectiveStartDate = $rentalStartDate->greaterThan($startDate) ? $rentalStartDate : $startDate;
            $effectiveEndDate = $rentalEndDate->lessThan($endDate) ? $rentalEndDate : $endDate;

            // Verificar se há sobreposição válida de datas para calcular o custo
            if ($effectiveStartDate->lessThanOrEqualTo($effectiveEndDate)) {
                $numberOfDays = $effectiveStartDate->diffInDays($effectiveEndDate) + 1; // +1 para incluir o último dia
                $vehicle->total_rental_cost = $vehicle->rental_price_per_day * $numberOfDays;
            } else {
                $vehicle->total_rental_cost = 0; // Não há sobreposição válida de datas
            }
        }

        $data = [
            'vehicles' => $vehicles,
            'start_date' => $startDate->toDateString(),
            'end_date' => $endDate->toDateString()
        ];

        // Configurar o PDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Seu Nome');
        $pdf->SetTitle('Relatório de Carros Externos');
        $pdf->SetSubject('Relatório de Carros Externos');
        $pdf->SetKeywords('TCPDF, PDF, exemplo, teste, guia');

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
