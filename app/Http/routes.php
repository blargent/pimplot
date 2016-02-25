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
    $goods = [];
    $goods['lotmap'] = App\LotMap::findOrFail(2);
    $goods['lotdefs'] = App\LotDef::all();
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

        Route::get('standard2', function() {
            return view('standard2');
        });

        Route::get('report', function() {
            return view('standard');
        });

        Route::get('report2', function() {
            return view('standard2');
        });

        Route::get('reportv2', function() {
            return view('newreports.index');
        });

        // chump datatables
        Route::get('reportv3', function() {
            return view('newreports.cindex');
        });

        Route::resource('lis', 'DataController');
        Route::get('api/lis/', array('as' => 'api.lis', 'uses' => 'DataController@getDataTable'));



        Route::controller('datatables', 'DatatablesController', [
            'anyData'   => 'datatables.data',
            'getIndex'  => 'datatables',
        ]);




        Route::get('source', function()
        {
            $columns = array(
//                'id',
                'lot_num',
//                'lot_id',
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
//                'max_results' => 100,
//                'throttle'    => 20,
            );

            $relations      = ['statusdef'];
            $relationsu     = ['user'];
            $relate         = ['statusdef', 'user', 'buildtype'];
            $rel    = ['latestlotinfo', 'statusdef', 'user', 'buildtype'];
            $rela   = ['statusdef'];
            $relb   = ['latestlotinfo'];
            $relc   = ['teststatus'];

//            $data = App\LotInfo::with([ 'statusdef' => function($query) {
//                $query->orderBy('created_at', 'desc')
//                    ->take(1)->get();
//            } ], 'user', 'buildtype');

//            $data = App\LotDef::with($rel);
            $lots = DB::table('lot_defs')->select('id')->where('map_id', 2)->distinct()->pluck('id');

            $relates = ['latestlotinfo.statusdef', 'latestlotinfo.user', 'latestlotinfo.buildtype'];
//            $relates = ['latestlotinfo.statusdef', 'latestlotinfo.user', 'latestlotinfo.buildtype'];

//            $data = App\LotInfo::whereIn(['lot_id', $lots => function($q) {
//                $q->latest();
//            }])

            //before playing with................................
            $data = App\LotInfo::whereIn('lot_id', $lots)
                ->orderBy('created_at', 'desc')->first()
                ->groupBy('lot_num')
                ->distinct()
                ->with(
                    [
                    'statusdef',
                    'buildtype',
                    'user'
                    ]);
            //before playing with................................


            // // Initiate by a database query
//             return DataGrid::make(DB::table('cities'), $columns, $settings);
            // // Or by an Eloquent model query
            // return DataGrid::make(with(new City)->newQuery(), $columns, $settings);
            // Or by an Eloquent model

            return DataGrid::make($data, $columns, $settings);
//            return DataGrid::make(new App\LotInfo, $columns, $settings);
        });

        Route::get('source2', function()
        {
            $columns = array(
//                'lot_id',
//                'info.lot_id',
                'latestlotinfo.lot_num',
                'latestlotinfo.lot_name',
                'latestlotinfo.statusdef.label',
                'latestlotinfo.verify_no_update',
                'latestlotinfo.buildtype.label',
                'latestlotinfo.notes',
                'latestlotinfo.builder_date',
                'latestlotinfo.adjust_date_to',
                'latestlotinfo.created_at',
                'latestlotinfo.user.name',
            );
            $settings = array(
                'sort'        => 'lot_num',
                'direction'   => 'asc',
//                'max_results' => 100,
//                'throttle'    => 20,
            );


            $relate         = ['statusdef', 'user', 'buildtype'];
            $relates = ['latestlotinfo.statusdef', 'latestlotinfo.user', 'latestlotinfo.buildtype'];

//            $data = [];
            $lots = DB::table('lot_defs')->select('id')->where('map_id', 2)->distinct()->pluck('id');
//            $lots = collect($lots);
//            $li = new App\LotInfo;

//            $lis = App\LotInfo::whereIn('lot_id', $lots)->latest()->get();

//            foreach ($lots as $lot => $num) {
//                $li = App\LotInfo::where('lot_id', $num)->orderBy('created_at', 'DESC')->first();
//                $data[$num]['statusname']   = $li->statusdef->name;
//                $data[$num]['buildlabel']   = $li->buildtype->description;
//                $data[$num]['username']     = $li->user->name;
//                $data[] = $li;
////                $data[$num] = $li;
////                $data[$num]['status'] = $li->with('statusdef')->get();
////                $data[$num] = App\LotInfo::with('statusdef')->where('lot_id', $num)->orderBy('created_at', 'DESC')->first();
////                $data[$num] = App\LotInfo::where('lot_id', $num)->orderBy('created_at', 'DESC')->first();
////                $data[$num] = $li->where('lot_id', $num)->orderBy('created_at', 'DESC')->first();
//            }

//            $data = collect($data);

//            $lotinfos = $lis->map(function($li) {
//               return $li->lot_num = $li->lot_name;
//            });
//            $lis = $lis

//            dd($lotinfos);
            $megalis = App\LotInfo::whereIn('lot_id', DB::table('lot_defs')->select('id')->where('map_id', 2)->distinct()->pluck('id'));

            $data = LotDef::query()
                ->where('map_id', 2)
                ->with('latestlotinfo', 'latestlotinfo.statusdef', 'latestlotinfo.user', 'latestlotinfo.buildtype')->get();

//            dd($data);

//            $data = App\LotInfo::whereIn('lot_id', $lots)
//                ->orderBy('created_at', 'desc')->first()
//                ->groupBy('lot_num')
//                ->distinct()
//                ->with(
//                    [
//                    'statusdef',
//                    'buildtype',
//                    'user'
//                    ]);

            // // Initiate by a database query
//             return DataGrid::make(DB::table('cities'), $columns, $settings);
            // // Or by an Eloquent model query
            // return DataGrid::make(with(new City)->newQuery(), $columns, $settings);
            // Or by an Eloquent model

            return DataGrid::make($data, $columns, $settings);
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
