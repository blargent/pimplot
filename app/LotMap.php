<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LotMap extends Model
{
    protected $table = 'lot_maps';

    /**
     * A Lot Map has many Lot Defs
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lotDefs() {
        return $this->hasMany('App\LotDef');
    }

    /**
     * A Lot Map belongs to a Subdivision
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subdivision() {
        return $this->belongsTo('App\Subdivision');
    }

    /**
     * WRONG!!!!! added Subdivision layer above!!!!!!!  REMOVE ME
     *
     * A Lot Map belongs to a Community
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
//    public function community() {
//        return $this->belongsTo('App\Community');
//    }
}
