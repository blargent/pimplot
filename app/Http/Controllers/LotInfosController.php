<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LotInfosController extends Controller
{
    //
    public function map() {
        $lotmap = \App\LotMap::latest()->get();

        //return ('lot_master', $lotmap);
        return 'map';
    }

}
