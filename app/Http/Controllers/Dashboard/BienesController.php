<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\BienesExport;
use App\Http\Controllers\Controller;
use App\Models\Bien;
use App\Models\Imagen;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BienesController extends Controller
{
    public function index()
    {
        return view('dashboard.bienes.index');
    }

    public function export()
    {
        $hoy = date("d-m-Y");
        return Excel::download(new BienesExport(), "Bienes_Registrados_$hoy.xlsx");
    }

    public function printEtiqueta($id)
    {
        $bien = Bien::where('id', $id)->orWhere('token', $id)->first();
        if (!$bien){
            return redirect()->route('web.index');
        }

        $identificador = null;
        $serial = null;

        if (!empty($bien->identificador)) {
            $identificador = "\nIDENTIFICADOR N°: " . strtoupper(verUtf8($bien->identificador));
        }
        if (!empty($bien->serial)) {
            $serial = "\nSERIAL: " . strtoupper(verUtf8($bien->serial));
        }

        $qr_texto = "ALIMENTOS DEL GUARICO S.A. $identificador $serial \nTIPO: " . strtoupper(verUtf8($bien->tipo->nombre)) . "  \nMARCA: " . strtoupper(verUtf8($bien->marca->nombre)). "  \nMODELO: " . strtoupper(verUtf8($bien->modelo->nombre)). "  \n" . strtoupper(verUtf8($bien->condicion->nombre));
        $qr_url = route('etiquetas.web', $id);
        return view('dashboard.bienes.etiquetas.print_etiqueta')
            ->with('texto', $qr_texto)
            ->with('url', $qr_url)
            ->with('serial', $bien->serial)
            ->with('identificador', $bien->identificador);
    }

    public function webEtiqueta($id)
    {
        $bien = Bien::where('id', $id)->orWhere('token', $id)->first();
        if (!$bien){
            return redirect()->route('web.index');
        }
        $imagenFrontal = Imagen::where('bienes_id', $bien->id)->where('nombre', 'frontal')->first();
        $imagenPosterior = Imagen::where('bienes_id', $bien->id)->where('nombre', 'posterior')->first();
        return view('dashboard.bienes.etiquetas.web_etiqueta')
            ->with('bien', $bien)
            ->with('imagenFrontal', $imagenFrontal)
            ->with('imagenPosterior', $imagenPosterior);
    }

}
