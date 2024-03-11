<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BienesController extends Controller
{
    public function index()
    {
        return view('dashboard.bienes.index');
    }
}
