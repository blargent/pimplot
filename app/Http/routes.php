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

use App\LotDef;

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

//Route::get('/', function() {
//    return view('welcome');
//});

Route::get('map', 'LotInfosController@map');

Route::get('defs', function(){
   $defs = LotDef::all();

    return $defs;
});

//Route::get('mapa', 'LotInfosController@alpha');
//Route::get('api/lotinfo/{lotid}', 'LotInfosController@getLotInfo');
//Route::post('api/lotinfo/{lotid}', 'LotInfosController@store');

Route::resource('lotinfos', 'LotInfosController');


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
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('api/lotinfo/{lotid}', 'LotInfosController@getLotInfo');

    Route::put('api/lotinfo/{lotid}', 'LotInfosController@store');

    Route::post('api/lotinfo/{lotid}', 'LotInfosController@store');

    Route::get('/mapa', 'LotInfosController@alpha');

    Route::get('/mapselection', function() {
        return view('pages.map_select');
    });
//    Route::get('/mapselection', 'MapSelectionController@index');


    Route::get('/', function() {
        return view('welcome');
    });

});
