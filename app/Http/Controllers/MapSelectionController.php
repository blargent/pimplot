<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Community;
use App\Subdivision;
use App\LotMap;

class MapSelectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        // stuff will go here. Do static for now.
        // Probably = buildCommunities for community (customer) inital DROP DOWN
    }

//    public function buildSubdivisions($id, Request $request) {
    public function buildSubdivisions($id) {
        $subdivisions = Subdivision::where('community_id', $id)->get();
//        $community = Input::get('option');

//        $subdivisions = Subdivision::where('community_id', $community)->get();
//        $subdivisions = Subdivision::where('community_id', $request->option)->get();

//        return $subdivisions;
        return ['data' => $subdivisions, 'count' => $subdivisions->count()];
        //

    }

    public function buildMaps($id) {
        $maps = LotMap::where('subdivision_id', $id)->get();

        return ['data' => $maps, 'count' => $maps->count()];
    }

    // Let's move this to the LotInfoController instead and handle there.
    public function goToMap() {
        $lotmap = LotMap::latest()->get();
        $lotdefs = LotDef::where('map_id','=', 2)->get();
        $lotinfos = LotInfo::all();
        $statusdefs = StatusDef::where('build_type_id', '=', 3)->orderBy('status_order', 'DESC')->get();

        return view('lot_master_alpha', compact('lotmap', 'lotdefs', 'lotinfos', 'statusdefs'));
    }
}
