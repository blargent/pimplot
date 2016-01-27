<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Http\Request;

/*Route::get('/', function () {
    $lotmap = App\LotMap::latest()->get();
    return $lotmap->toArray();
    //return view('welcome');
});*/

Route::get('k', function() {
    //$lotmap = App\LotMap::where('map_num', '=', 1)->get();
    $goods = [];
//    $lotmap = App\LotMap::findOrFail(2);
//    $lotdefs = App\LotDef::all();
    $goods['lotmap'] = App\LotMap::findOrFail(2);
    $goods['lotdefs'] = App\LotDef::all();


    //return $lotdefs->toArray();

    return $goods;
});

Route::get('map', 'LotInfosController@map');



Route::resource('lotinfos', 'LotInfosController');

//Route::get('/', function () {
//    $lotmap = App\LotMap::latest()->get();
//    return $lotmap->toArray();
//    //return view('lot_master', 'map', $lotmap);
//});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

/*Route::group(['middleware' => ['web']], function () {
    //
});*/

Route::group(['middleware' => 'web'], function () {
    Route::get('mapa', 'LotInfosController@alpha');

    Route::get('api/lotinfo/{lotid}', 'LotInfosController@getLotInfo');

    Route::post('api/lotinfo/{lotid}', 'LotInfosController@store');

    Route::put('api/lotinfo/{lotid}', 'LotInfosController@store');



    Route::auth();

    Route::get('/home', 'HomeController@index');
});
