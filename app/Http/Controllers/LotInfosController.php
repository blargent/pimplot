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

    public function store() {

    }

}
