<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Subdivision
 *
 * @property integer $id
 * @property string $subdivision_name
 * @property integer $community_id
 * @property string $address_street
 * @property string $address_city
 * @property string $address_state
 * @property string $address_zipcode
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Community $community
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\LotMap[] $map
 */
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
