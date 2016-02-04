<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LotInfo extends Model
{
    protected $table = 'lot_infos';

//    protected $dates = ['fv_install_date', 'builder_date'];

    //protected $fillable = ['lot_id', 'lot_num', 'status_id', 'notes'];
    protected $fillable = ['lot_num', 'status_id', 'plan_num', 'elevation', 'handing', 'build_type_id', 'fv_install_date', 'builder_date', 'critical_issue_flag', 'verify_no_update', 'notes'];
    //
}
