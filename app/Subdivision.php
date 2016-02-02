<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdivision extends Model
{
    protected $table = 'subdivision_defs';
    //

    /**
     * A Subdivision belongs to one Community
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function community() {
        return $this->belongsTo('App\Community');
    }

    /**
     * A Subdivision can have many Lot Maps
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function map() {
        return $this->hasMany('App\LotMap');
    }

    public function lotDefs() {
        return $this->hasManyThrough('App\LotDef', 'App\LotMap');
    }
}
