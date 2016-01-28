<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LotInfo extends Model
{
    protected $table = 'lot_infos';

    //protected $fillable = ['lot_id', 'lot_num', 'status_id', 'notes'];
    protected $fillable = ['lot_num', 'status_id', 'notes', 'plan_num', 'elevation', 'build_type_id'];
    //
}
