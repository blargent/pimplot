<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\LotInfo;
use App\LotDef;
use App\LotMap;
use App\StatusDef;

use Log;

class LotInfosController extends Controller
{
    //
    public function map() {
        $lotmap = LotMap::latest()->get();
        $lotdefs = LotDef::where('map_id','=', 2)->get();
        $lotinfos = LotInfo::all();
        $statusdefs = StatusDef::where('build_type_id', '=', 3)->orderBy('status_order', 'DESC')->get();

//        return view('lot_master')->with([
//            'lotmap' => $lotmap,
//            'lotdefs' => $lotdefs,
//            'lotinfos' => $lotinfos
//        ]);
        //dd(compact('lotmap', 'lotdefs', 'lotinfos'));
        return view('lot_master', compact('lotmap', 'lotdefs', 'lotinfos', 'statusdefs'));
    }

    public function alpha() {
        $lotmap = LotMap::latest()->get();
        $lotdefs = LotDef::where('map_id','=', 2)->get();
        $lotinfos = LotInfo::all();
        $statusdefs = StatusDef::where('build_type_id', '=', 3)->orderBy('status_order', 'DESC')->get();

        //dd(compact('lotmap', 'lotdefs', 'lotinfos'));
        return view('lot_master_alpha', compact('lotmap', 'lotdefs', 'lotinfos', 'statusdefs'));
    }

    public function getLotInfo($id, LotInfo $lotInfo) {
        $lotInfoData = $lotInfo::where('lot_id', $id)->get();
//            ->orderBy('created_at', 'desc')
//            ->first();
//        $lotInfoData = $lotInfo::where('lot_id', $id)->first();
//        $lotInfoData = $lotInfo::where('lot_id', $id)->firstOrFail();

        return ['rdata' => $lotInfoData->last(), 'count' => $lotInfoData->count()];
    }

    public function store($id, Request $request, LotInfo $lotinfo, LotDef $lotdef, LotMap $lotmap) {
        // find and compare real lot id from lot_num, map_num (figuire out), and maybe community num?

        // for now, assume lot_id is accurate (bad) TEMPORARY
        $lotinfo = new LotInfo();
        $lotinfo->lot_id    = $request->lot_id;
        $lotinfo->lot_num   = $request->lot_num;
        $lotinfo->notes     = $request->lot_notes;
        $lotinfo->status_id = $request->lot_status;
        $lotinfo->save();

        return response(['msg' => 'success'], 200)
            ->header('Content-Type', 'application/json');



    }

}
