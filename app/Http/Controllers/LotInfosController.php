<?php

namespace App\Http\Controllers;

use App\BuildType;
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
        $statusdefs = StatusDef::where('build_type_id', '=', 3)->orderBy('order', 'DESC')->get();

        return view('lot_master', compact('lotmap', 'lotdefs', 'lotinfos', 'statusdefs'));
    }

    public function buildMap($id) {
        $lotmap  = LotMap::where('id', $id)->get();
        $lotdefs = $lotmap->first()->lotDefs;

        // !!!!!!!!!! Status defs are going to be dynamic based on build_type_id!!!!!!!! !!!!!!!!!
        // !!!!!!!!!! Need to come back and figure out how to make this dynamic in modal box each time!!!
        $statusdefs = StatusDef::where('build_type_id', 3)->orderBy('order', 'DESC')->get();

//        return Redirect::route('')

        return view('lot_master_beta', compact('lotmap', 'lotdefs', 'statusdefs'));
        // return response()->view('lot_master_beta', compact('lotmap', 'lotdefs', 'statusdefs'));
    }

    public function loadMapInfos($id) {
        $lotmap  = LotMap::where('id', $id)->get();
        $lotdefs = $lotmap->first()->lotdef;

        // !!!!!!!!!! Status defs are going to be dynamic based on build_type_id!!!!!!!! !!!!!!!!!
        // !!!!!!!!!! Need to come back and figure out how to make this dynamic in modal box each time!!!
        $statusdefs = StatusDef::where('build_type_id', 3)->orderBy('order', 'DESC')->get();

//        return Redirect::route('')

        return view('lot_master_beta', compact('lotmap', 'lotdefs', 'statusdefs'));
        // return response()->view('lot_master_beta', compact('lotmap', 'lotdefs', 'statusdefs'));
    }

    public function getLotInfo($id, LotInfo $lotInfo) {
        $lotInfoData = $lotInfo::where('lot_id', $id)->get()->last();


        /***
         *
         * MOVE ME TO REPORT (DATA) CONTROLLER????!!!!!!????
         *
         **/
        $statuses = collect(
            StatusDef::where('build_type_id', $lotInfoData->build_type_id)->pluck('days_duration')
        );
        $statusCurrent  = $lotInfoData->statusdef->days_duration;
        $statusDaysLeft = $statuses->reject(function( $value, $statusCurrent ) {
            return $value < $statusCurrent;
        });
        $statusDaysRemaining = $statusDaysLeft->sum();


        // If default build type is not zero get the status menu else do build zero stuff???
        $buildtype  = $lotInfoData->build_type_id;
        $statusNow  = $lotInfoData->status_id;

//        $statsa = $lotInfoData->buildtype->statusmenu($buildtype, $statusNow);

//        $stats      = BuildType::where('id', $buildtype)->get()->last()->statuses
//            ->pluck('id')
//            ->reject(function($value, $lotInfo) {
//                return $value < $lotInfo->status_id;
//            })
//        ;
//        $stats      = collect($lotInfoData->buildtype->statuses->pluck('id'));
        $stats = StatusDef::where('build_type_id', $buildtype)->where('id', '>=', $statusNow)->get();
//        $stats = StatusDef::where('build_type_id', $buildtype)->pluck('id');

//        $statsa = $stats->filter(function($stat, $statusNow) {
//           return $stat->where('id', '<', $statusNow);
//        });
//        $statsa = $stats->reject(function($value, $statusNow) {
//           return $value < $statusNow;
//        });

//        dd($stats);


//        $statsa = $stats->reject(function($value, $key, $statusNow) {
//           return $value < $statusNow;
//        });

//        $statusMenu = $stats->where('id', '<', $statusNow);
//        $stats      = $lotInfoData->buildtype->statuses->pluck('label', 'id');


//        $stats = $stats->flip();
//        $statusMenu = null;

        // If > 0 reduce status menu to only statuses remaining ELSE display entire menu
//        if ($buildtype > 0) {
//            $statusMenu = $stats->reject(function($value, $statusNow) {
//                return $value < $statusNow;
//            });
//        }


        return [ 'rdata' => $lotInfoData, 'count' => $lotInfoData->count(), 'days_remaining' => $statusDaysRemaining, 'status_menu' => $stats];
    }


    public function loadBuildTypes() {

    }

    public function getStatusMenu($id) {
        // what to do if 0???? Need definitions from Dustin!!!!

        // If 0, don't do status reject and status sum??? Just display entire list? Is list just 1 "unknown" or multiple like any other build??

        // Build full status menu without filtering
        $statuses = BuildType::where('id', $id)->first()->statuses()->pluck('label', 'id');



//        return
    }

    public function changeStatusMenu($id, $currentStatus, $buildType) {

    }

    public function buildMaps($id) {
        $maps = LotMap::where('subdivision_id', $id)->get();

        return ['data' => $maps, 'count' => $maps->count()];
    }

    public function store($id, Request $request, LotInfo $lotinfo, LotDef $lotdef, LotMap $lotmap) {
        // find and compare real lot id from lot_num, map_num (figuire out), and maybe community num?
        $user = Auth::id();

        $lotinfo            = new LotInfo();
        $lotinfo->lot_id    = $request->lot_id;
        $lotinfo->lot_num   = $request->lot_num;
        if ($request->has('lot_name')) {
            $lotinfo->lot_name = $request->lot_name;
        } else {
            $lotinfo->lot_name = $lotinfo->lot_num;
        }
        $lotinfo->lot_name  = $request->lot_name;
        $lotinfo->notes     = $request->lot_notes;
        $lotinfo->user_id   = $user;
        $lotinfo->status_id = $request->lot_status;
        $lotinfo->priority  = $request->lot_priority;
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
        $lds        = $lotdefs->select('id')->distinct()->pluck('id');
        $lotinfos   = LotInfo::whereIn('id', $lds);
//        $lotinfos   = LotInfo::all();
        $statusdefs = StatusDef::where('build_type_id', '=', 3)->orderBy('order', 'DESC')->get();

        //dd(compact('lotmap', 'lotdefs', 'lotinfos'));
        return view('lot_master_alpha', compact('lotmap', 'lotdefs', 'lotinfos', 'statusdefs'));
    }

}
