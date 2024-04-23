<?php

namespace App\Exports;

use App\Models\Bien;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BienesExport implements FromView, ShouldAutoSize
{

    public function view(): View
    {
        $bienes = Bien::all();
        return view('dashboard._export.export_excel_bienes')
            ->with('bienes', $bienes);
    }
}
