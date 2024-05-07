<?php

namespace App\Exports;

use App\Models\Bien;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class BienesExport implements FromView, ShouldAutoSize, WithColumnFormatting
{

    public function view(): View
    {
        $bienes = Bien::all();
        return view('dashboard._export.export_excel_bienes')
            ->with('bienes', $bienes);
    }

    public function columnFormats(): array
    {
        // TODO: Implement columnFormats() method.
        return [
            /*'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'C' => NumberFormat::FORMAT_CURRENCY_EUR_INTEGER,*/
            'D' => NumberFormat::FORMAT_TEXT
        ];
    }
}
