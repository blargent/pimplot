<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class TagLocation extends Model
{
    protected $table = 'taglocations';

    public function communities() {
        return $this->hasMany('App\Community', 'taglocation_id', 'id');
    }

/*    public function subdivisions() {
        return $this->hasMany('App\Subdivision');
    }

    public function maps() {
        return $this->hasManyThrough('App\LotMap', 'App\Subdivision');
    }*/
}
