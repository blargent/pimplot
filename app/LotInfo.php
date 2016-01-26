<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LotInfo extends Model
{
    protected $table = 'lot_infos';

    protected $fillable = ['lot_id', 'lot_num', 'status_id', 'plan_num', 'elevation', 'handing_id', 'order_num', 'notes'];
    //
}
