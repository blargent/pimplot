<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LotMap extends Model
{
    protected $table = 'lot_maps';

    public function lotDefs() {
        return $this->hasMany('App\LotDef');
    }
    //
}
