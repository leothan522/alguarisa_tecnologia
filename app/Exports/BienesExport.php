<?php

namespace App\Exports;

use App\Models\Bien;
use App\Models\Equipo;
use App\Models\Oficio;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class BienesExport implements FromView, ShouldAutoSize, WithTitle
{

    public function view(): View
    {
        $bienes = Bien::all();
        $bienes->each(function ($bien){
            $arrayOficios = [];
            $equipos = Equipo::where('bienes_id', $bien->id)->get();
            if ($equipos->isNotEmpty()){
                foreach ($equipos as $equipo){
                    $oficio = Oficio::find($equipo->oficios_id);
                    if ($oficio){
                        $arrayOficios[] = $oficio->numero;
                    }
                }
                asort($arrayOficios, SORT_NATURAL | SORT_FLAG_CASE);
                $bien->oficios = $arrayOficios;
            }


        });
        return view('dashboard._export.export_excel_bienes')
            ->with('bienes', $bienes);
    }

    public function title(): string
    {
        // TODO: Implement title() method.
        return "Bienes Registrados";
    }
}
