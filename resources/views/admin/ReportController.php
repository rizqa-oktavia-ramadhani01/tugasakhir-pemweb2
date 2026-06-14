<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\ParentsReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function exportParents(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        
        return Excel::download(new ParentsReportExport($startDate, $endDate), 'laporan_orang_tua_' . date('Ymd') . '.xlsx');
    }
}