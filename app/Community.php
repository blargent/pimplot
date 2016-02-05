<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * This is used in the app and labeled as "Customer" per Dustin's specification with B.Largent.
 * 
 * This will certainly need to be renamed/aliased/refactored before setting up any sale-ability.
 * 
 * This will suck. Bigtime. But let it be known that it should be something like, "customer_community"
 * or something OTHER than just Community.
 * 
 * This is most used in the drilldowns and map selection areas. Oh and everywhere else. Groan. :-p
 * 
 * Class Community
 *
 * @package App
 * @property integer $id
 * @property string $community_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Subdivision[] $subdivisions
 */
class Community extends Model
{
    protected $table = 'community_defs';

    /**
     * A Community has many Subdivisions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subdivisions() {
        return $this->hasMany('App\Subdivision');
    }

    /**
     * A Community has many Lot Maps
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function maps() {
        return $this->hasManyThrough('App\LotMap', 'App\Subdivision');
    }
    //
}
