<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\ParentsReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelReportController extends Controller
{
    public function exportParents()
    {
        return Excel::download(new ParentsReportExport(), 'laporan_orang_tua_' . date('Ymd') . '.xlsx');
    }
}