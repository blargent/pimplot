<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\LotInfo
 *
 * @property integer $id
 * @property integer $lot_id
 * @property integer $lot_num
 * @property integer $status_id
 * @property string $plan_num
 * @property string $elevation
 * @property string $handing
 * @property string $order_num
 * @property integer $build_type_id
 * @property string $fv_install_date
 * @property string $builder_date
 * @property string $adjust_date_to
 * @property boolean $critical_issue_flag
 * @property boolean $verify_no_update
 * @property string $notes
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $user_id
 * @property-read \App\User $user
 */
class LotInfo extends Model
{
    protected $table = 'lot_infos';

//    protected $dates = ['fv_install_date', 'builder_date'];

    //protected $fillable = ['lot_id', 'lot_num', 'status_id', 'notes'];
    protected $fillable = ['lot_num', 'status_id', 'plan_num', 'elevation', 'handing', 'build_type_id', 'fv_install_date', 'builder_date', 'critical_issue_flag', 'verify_no_update', 'notes', 'user_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function status() {
        return $this->belongsTo('App\StatusDef');
    }
    //
}
