<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\LotMap
 *
 * @property integer $id
 * @property integer $map_num
 * @property integer $subdivision_id
 * @property string $map_name
 * @property string $map_filename
 * @property string $map_storage_location
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\LotDef[] $lotDefs
 * @property-read \App\Subdivision $subdivision
 */
class LotMap extends Model
{
    protected $table = 'lot_maps';

    /**
     * A Lot Map has many Lot Defs
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lotdef() {
        return $this->hasMany('App\LotDef');
    }

//    public function lotinfo() {
//        return $this->hasManyThrough('App\LotInfo', 'App\LotDef');
//    }

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
