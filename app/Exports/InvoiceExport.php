<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InvoiceExport implements FromView, ShouldAutoSize, WithStyles
{
    use Exportable;

    protected $groupedOrders;

    public function __construct($groupedOrders)
    {
        $this->groupedOrders = $groupedOrders;
    }

    public function view(): View
    {
        return view('dashboard.invoice_excel', ['groupedOrders' => $this->groupedOrders]);
    }

    public function styles(Worksheet $sheet)
    {
        // Define styles here, for example:
        $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'font' => [
                'bold' => true,
            ],
        ];

        // Apply styles to a range of cells, for example, A1 to G10
        $sheet->getStyle('A1:G10')->applyFromArray($styleArray);
    }
}
