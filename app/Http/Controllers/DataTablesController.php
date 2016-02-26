<?php

namespace App\Http\Controllers;

use App\LotDef;
use App\LotInfo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Yajra\Datatables\Datatables;

class DataTablesController extends Controller
{
    public function getIndex() {
        return view('newreports.index');
    }

//$lots = DB::table('lot_defs')->select('id')->where('map_id', 2)->distinct()->pluck('id');

//    public function anyData() {
//        return Datatables::of(LotDef::query()
//            ->where('map_id', 2)
//            ->with('latestlotinfo', 'latestlotinfo.statusdef', 'latestlotinfo.user', 'latestlotinfo.buildtype'))
//            ->make(true);
////        return Datatables::of(LotInfo::query())->make(true);
//    }
}
