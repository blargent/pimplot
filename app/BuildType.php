<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BuildTypeDef
 *
 * @property integer $id
 * @property string $label
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class BuildType extends Model
{
    protected $table = 'build_type_defs';

    public function statuses() {
        return $this->hasMany('App\StatusDef', 'build_type_id', 'id');
    }

    public function statusmenu($id, $status_id) {
        $stats = $this->where('id', $id)->first();

        $stats = $this->statuses()->pluck('label', 'id');

        $statmenu = $stats->reject(function($value, $status_id) {
           return $value < $status_id;
        });

//        dd($statmenu);

        return $statmenu;

//        $stats      = BuildType::where('id', $buildtype)->get()->last()->statuses
//            ->pluck('id')
//            ->reject(function($value, $lotInfo) {
//                return $value < $lotInfo->status_id;
//            })
//        ;
    }

//
//
//    public function lotinfo() {
//        return $this->belongsTo('App\BuildType', 'build_type_id');
//    }
    //
}
