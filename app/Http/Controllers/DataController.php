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
        $moo = LotDef::where('map_id', 2)->pluck('id')->toArray();

        $lotinfos = collect(LotInfo::whereIn('lot_id', $moo)->get(array('lot_num', 'lot_name', 'status_id', 'critical_issue_flag',
                                                                    'build_type_id', 'notes', 'builder_date', 'adjust_date_to',
                                                                    'created_at', 'verify_no_update', 'user_id')));
        $lotinfos = $lotinfos->sortByDesc('created_at');
        $lotinfos = $lotinfos->unique('lot_num');
        $lotinfos = $lotinfos->values();

        return Datatable::collection($lotinfos)
            ->showColumns('lot_num', 'lot_name')
            ->addColumn('status_id', function($model){
                return $model->statusdef->label;
            })
            ->showColumns('critical_issue_flag')
            ->addColumn('build_type_id', function($model) {
                return $model->buildtype->label;
            })
            ->showColumns('notes', 'builder_date', 'adjust_date_to', 'created_at', 'verify_no_update')
            ->addColumn('user_id', function($model) {
                return $model->user->name;
            })
            ->searchColumns('lot_num')
            ->orderColumns('lot_num')
            ->make();
    }


//    public function getIndex() {
//        return view('newreports.index');
//    }

}
