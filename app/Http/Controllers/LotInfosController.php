<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LotInfosController extends Controller
{
    //
    public function map() {
        $lotmap = \App\LotMap::latest()->get();
        $lotdefs = \App\LotDef::where('map_id','=', 2)->get();

        //return view('lot_master', moooooo );
        return view('lot_master')->with([
            'lotmap' => $lotmap,
            'lotdefs' => $lotdefs
        ]);
//        return 'map';
    }

}
