<?php

namespace App\Http\Controllers;

use App\LotDef;
use App\LotInfo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Datatable;

class DataController extends Controller
{
    public function getDataTable() {
//        return Datatable::collection(LotInfo::all())
        return Datatable::collection(LotInfo::all(array('lot_num', 'lot_name', 'status_id', 'notes', 'user_id')))
            ->showColumns('lot_num', 'lot_name')
            ->addColumn('status_id', function($model){
                return $model->statusdef->label;
            })
            ->showColumns('notes', 'user_id')
            ->searchColumns('lot_num')
            ->orderColumns('lot_num')
            ->make();
    }


//    public function getIndex() {
//        return view('newreports.index');
//    }

//$lots = DB::table('lot_defs')->select('id')->where('map_id', 2)->distinct()->pluck('id');
//    public function anyData() {
//        return Datatables::of(LotDef::query()
//            ->where('map_id', 2)
//            ->with('latestlotinfo', 'latestlotinfo.statusdef', 'latestlotinfo.user', 'latestlotinfo.buildtype'))
//            ->make(true);
//        return Datatables::of(LotInfo::query())->make(true);
//    }
}
