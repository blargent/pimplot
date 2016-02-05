<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\LotInfo;
use App\LotDef;
use App\LotMap;
use App\StatusDef;

use Illuminate\Support\Facades\Redirect;
use Log;

use Auth;

class LotInfosController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    //
    public function map() {
        $lotmap     = LotMap::latest()->get();
        $lotdefs    = LotDef::where('map_id', '=', 2)->get();
        $lotinfos   = LotInfo::all();
        $statusdefs = StatusDef::where('build_type_id', '=', 3)->orderBy('status_order', 'DESC')->get();

        return view('lot_master', compact('lotmap', 'lotdefs', 'lotinfos', 'statusdefs'));
    }

    public function buildMap($id) {
        $lotmap  = LotMap::where('id', $id)->get();
        $lotdefs = $lotmap->first()->lotDefs;

        // !!!!!!!!!! Status defs are going to be dynamic based on build_type_id!!!!!!!! !!!!!!!!!
        // !!!!!!!!!! Need to come back and figure out how to make this dynamic in modal box each time!!!
        $statusdefs = StatusDef::where('build_type_id', 3)->orderBy('status_order', 'DESC')->get();

//        return Redirect::route('')

        return view('lot_master_beta', compact('lotmap', 'lotdefs', 'statusdefs'));
        // return response()->view('lot_master_beta', compact('lotmap', 'lotdefs', 'statusdefs'));
    }

    public function loadMapInfos($id) {
        $lotmap  = LotMap::where('id', $id)->get();
        $lotdefs = $lotmap->first()->lotDefs;

        // !!!!!!!!!! Status defs are going to be dynamic based on build_type_id!!!!!!!! !!!!!!!!!
        // !!!!!!!!!! Need to come back and figure out how to make this dynamic in modal box each time!!!
        $statusdefs = StatusDef::where('build_type_id', 3)->orderBy('status_order', 'DESC')->get();

//        return Redirect::route('')

        return view('lot_master_beta', compact('lotmap', 'lotdefs', 'statusdefs'));
        // return response()->view('lot_master_beta', compact('lotmap', 'lotdefs', 'statusdefs'));
    }

    public function getLotInfo($id, LotInfo $lotInfo) {
        $lotInfoData = $lotInfo::where('lot_id', $id)->get();
//            ->orderBy('created_at', 'desc')
//            ->first();
//        $lotInfoData = $lotInfo::where('lot_id', $id)->first();
//        $lotInfoData = $lotInfo::where('lot_id', $id)->firstOrFail();

        return [ 'rdata' => $lotInfoData->last(), 'count' => $lotInfoData->count() ];
    }

    public function store($id, Request $request, LotInfo $lotinfo, LotDef $lotdef, LotMap $lotmap) {
        // find and compare real lot id from lot_num, map_num (figuire out), and maybe community num?
        $user = Auth::id();

        $lotinfo            = new LotInfo();
        $lotinfo->lot_id    = $request->lot_id;
        $lotinfo->lot_num   = $request->lot_num;
        $lotinfo->notes     = $request->lot_notes;
        $lotinfo->user_id = $user;
        $lotinfo->status_id = $request->lot_status;
//        $lotinfo->plan_num  = $request->lot_plan_num;
//        $lotinfo->elevation = $request->lot_elevation;
//        $lotinfo->handing   = $request->lot_handing;
        $lotinfo->critical_issue_flag = $request->lot_critical_issue;
        $lotinfo->verify_no_update    = $request->lot_verify_no_update;
        if ($request->has('lot_fv_install_date')) {
            $lotinfo->fv_install_date = Carbon::createFromFormat('Y-m-d', $request->lot_fv_install_date);
        }
        else {
            $lotinfo->fv_install_date = null;
        }
        if ($request->has('lot_builder_date')) {
            $lotinfo->builder_date = Carbon::createFromFormat('Y-m-d', $request->lot_builder_date);
        }
        else {
            $lotinfo->builder_date = null;
        }

//        $lotinfo->fv_install_date       = Carbon::createFromFormat('d-m-Y', $request->lot_fv_install_date);
//        $lotinfo->builder_date          = Carbon::createFromFormat('d-m-Y', $request->lot_builder_date);
        //dd($lotinfo);

        $lotinfo->save();

        return response([ 'msg' => 'success' ], 200)
            ->header('Content-Type', 'application/json');


    }

    public function alpha() {
        $lotmap     = LotMap::latest()->get();
        $lotdefs    = LotDef::where('map_id', '=', 2)->get();
        $lotinfos   = LotInfo::all();
        $statusdefs = StatusDef::where('build_type_id', '=', 3)->orderBy('status_order', 'DESC')->get();

        //dd(compact('lotmap', 'lotdefs', 'lotinfos'));
        return view('lot_master_alpha', compact('lotmap', 'lotdefs', 'lotinfos', 'statusdefs'));
    }

}
