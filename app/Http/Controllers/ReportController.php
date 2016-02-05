<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\LotInfo;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.dgrid1');
    }
}
