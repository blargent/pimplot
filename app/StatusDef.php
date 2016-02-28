<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\StatusDef
 *
 * @property integer $id
 * @property integer $build_type_id
 * @property integer $status_order
 * @property string $status_name
 * @property string $status_label
 * @property integer $days_out
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $days_duration
 * @property integer $user_id
 */
class StatusDef extends Model
{
    protected $table = 'status_defs';

    protected $fillable = ['build_type_id', 'lot_map_id', 'order', 'name', 'label', 'days_duration', 'user_id'];
    //

//    public function map() {
//        return $this->belongsTo('App\LotMap', 'lot_map_id');
//    }

    public function buildtype() {
        return $this->belongsTo('App\BuildType', 'id', 'build_type_id');
    }

//    public function lotinfo() {
//        return $this->belongsTo('App\LotInfo', 'status_id');
//    }

//    public function lotinfo() {
//        return $this->hasMany('App\LotInfo');
//    }
}
