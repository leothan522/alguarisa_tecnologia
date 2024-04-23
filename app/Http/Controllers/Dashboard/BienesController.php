<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\BienesExport;
use App\Http\Controllers\Controller;
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
        return Excel::download(new BienesExport(), 'Bienes.xlsx');
    }

}
