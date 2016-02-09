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
use App\Http\Requests;
//use Illuminate\Http\Request;

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

    Route::group(['middleware' => 'auth'], function() {
        Route::get('standard', function() {
           return view('standard');
        });

        Route::get('report', 'ReportController@index');
//        Route::get('report', 'ReportController@index');

        Route::get('source', function()
        {
            $columns = array(
//                'id',
//                'lot_id',
                'lot_num',
                'lot_name',
                'status_id',
                'verify_no_update',
                'critical_issue_flag',
                'build_type_id',
                'notes',
                'builder_date',
                'adjust_date_to',
                'created_at',
                'user_id',
            );
            $settings = array(
                'sort'        => 'lot_num',
                'direction'   => 'asc',
                'max_results' => 50,
            );
            // Status
//            $columnss = array(
//                'lot_num',
//                'build_type_id',
//                'critical_issue_flag',
//                'verify_no_update',
//                'notes',
//                'created_at',
//                'status_id',
//            );
//            $settingss = array(
//                'sort'        => 'lot_num',
//                'direction'   => 'asc',
//                'max_results' => 50,
//            );

            $relations      = ['statusdef'];
            $relationsu     = ['user'];
            $relate         = ['statusdef', 'user', 'buildtype'];
//            $relatetest     = []

//            $data = App\LotInfo::with([ 'statusdef' => function($query) {
//                $query->orderBy('created_at', 'desc')
//                    ->take(1)->get();
//            } ]);
            $data = App\LotInfo::with($relate);



//            $sdata = $data->

            // // Initiate by a database query
//             return DataGrid::make(DB::table('cities'), $columns, $settings);
            // // Or by an Eloquent model query
            // return DataGrid::make(with(new City)->newQuery(), $columns, $settings);
            // Or by an Eloquent model

//            dd(DataGrid::make($data, $columns, $settings)->toArray());
            return DataGrid::make($data, $columns, $settings);

//            return DataGrid::make(new App\LotInfo, $columns, $settings);
        });

        Route::get('api/lotinfo/{lotid}', 'LotInfosController@getLotInfo');

        Route::put('api/lotinfo/{lotid}', 'LotInfosController@store');

        Route::post('api/lotinfo/{lotid}', 'LotInfosController@store');

//    Route::get('/mapa', 'LotInfosController@alpha');
//    Route::get('api/mapselection/getcommunities/{community_id}', 'MapSelectionController@');
//    Route::get('api/mapselection/subdivision/{subdivision_id}', 'MapSelectionController@buildSubdivisions');
        Route::get('api/mapselection/getsubdivisions/{communityid}', 'MapSelectionController@buildSubdivisions');

        Route::get('api/mapselection/getmaps/{subdivisionid}', 'MapSelectionController@buildMaps');

        Route::post('api/mapselection/goto/{mapid}', 'MapSelectionController@gotoMap');

        Route::get('loadmap/{mapid}', 'LotInfosController@loadMapInfos');

        // Going to need to update this soon to not be static!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        Route::get('mapselection', function() {
//        $communities = App\Community::where('id', 1)->get();
            $communities = App\Community::all();

            return view('pages.map_select', compact('communities'));
        });


    });
/*    Route::get('token', function () {
        return csrf_token();
    });*/


    Route::get('/', function() {
        return view('welcome');
    });

});
