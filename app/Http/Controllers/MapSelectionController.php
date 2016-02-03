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
use App\StatusDef;


class MapSelectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

//    public function index() {
        // stuff will go here. Do static for now.
        // Probably = buildCommunities for community (customer) inital DROP DOWN
//    }

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

    public function gotoMap($id) {
        $mapCount = LotMap::where('id', $id)->get()->count();

        if ($mapCount > 0) {
            return response()->json(array('success' => true, 'msg' => 'proceed'));
        }
        else {
            return response('fail');
        }
    }

/*    public function gotoMap($id) {
        $lotmap     = LotMap::where('id', $id)->get();
        $lotdefs    = $lotmap->first()->lotDefs;

        // !!!!!!!!!! Status defs are going to be dynamic based on build_type_id!!!!!!!! !!!!!!!!!
        // !!!!!!!!!! Need to come back and figure out how to make this dynamic in modal box each time!!!
        $statusdefs = StatusDef::where('build_type_id', 3)->orderBy('status_order', 'DESC')->get();
//        return Redirect::route('')

        return view('lot_master_beta', compact('lotmap', 'lotdefs', 'statusdefs'));
        // return response()->view('lot_master_beta', compact('lotmap', 'lotdefs', 'statusdefs'));
    }*/

    // Let's move this to the LotInfoController instead and handle there.
/*    public function goToMap() {
        $lotmap = LotMap::latest()->get();
        $lotdefs = LotDef::where('map_id','=', 2)->get();
        $lotinfos = LotInfo::all();
        $statusdefs = StatusDef::where('build_type_id', '=', 3)->orderBy('status_order', 'DESC')->get();

        return view('lot_master_alpha', compact('lotmap', 'lotdefs', 'lotinfos', 'statusdefs'));
    }*/
}
