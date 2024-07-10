<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TripDetail;
use TCPDF;
use Carbon\Carbon;

class CostReportController extends Controller
{
    public function index(Request $request)
    {
        $costs = collect();
        $startDate = null;
        $endDate = null;

        if ($request->has(['start_date', 'end_date'])) {
            $startDate = $request->start_date;
            $endDate = $request->end_date;

            $costs = TripDetail::whereBetween('created_at', [$startDate, $endDate])
                ->with(['costType', 'trip'])
                ->paginate(10);
        }

        return view('pages.Cost-report.index', compact('costs', 'startDate', 'endDate'));
    }

    public function filter(Request $request)
    {
        $this->validateDate($request);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $costs = TripDetail::whereBetween('created_at', [$startDate, $endDate])
            ->with(['costType', 'trip'])
            ->paginate(10);

        return view('pages.Cost-report.index', compact('costs', 'startDate', 'endDate'));
    }

    public function generateCostReport(Request $request)
    {
        $this->validateDate($request);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $costs = TripDetail::whereBetween('created_at', [$startDate, $endDate])
            ->with(['costType', 'trip'])
            ->get();

        $totalCost = $costs->sum('cost');

        $data = [
            'costs' => $costs,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'totalCost' => $totalCost,
        ];

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('InnoDrive');
        $pdf->SetTitle('Relatório de Custos');
        $pdf->SetSubject('Relatório de Custos');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();

        $html = view('components.Cost-reports.costTrip-pdf-report', $data)->render();
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->lastPage();
        return $pdf->Output('cost_report.pdf', 'D');
    }

    private function validateDate(Request $request)
    {
        $request->validate([
            'start_date' => [
                'required',
                'date',
                'before_or_equal:end_date',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->isFuture()) {
                        $fail('A data de início não deve ser uma data futura.');
                    }
                },
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->isFuture()) {
                        $fail('A data de término não deve ser uma data futura.');
                    }
                },
            ],
        ], [
            'start_date.required' => 'A data de início é obrigatória.',
            'start_date.date' => 'A data de início deve ser uma data válida.',
            'start_date.before_or_equal' => 'A data de início deve ser anterior ou igual à data de término.',
            'end_date.required' => 'A data de término é obrigatória.',
            'end_date.date' => 'A data de término deve ser uma data válida.',
            'end_date.after_or_equal' => 'A data de término deve ser posterior ou igual à data de início.',
        ]);
    }
}
