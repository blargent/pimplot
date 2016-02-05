<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

/**
 * Class LotDef
 *
 * @package App
 * @property integer $id
 * @property integer $lot_map_id
 * @property integer $map_id
 * @property integer $lot_num
 * @property integer $plan_num
 * @property integer $priority
 * @property string $map_area_shape
 * @property string $map_area_coords
 * @property string $location_address
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $notes_temp
 * @property-read \App\LotMap $map
 * @property integer $updated_by
 */
class LotDef extends Model
{
    protected $table = 'lot_defs';

    /**
     * A Lot Def is owned by a Lot Map
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function map() {
        return $this->belongsTo('App\LotMap');
    }

    public static function boot() {
        static::updating(function ($lotdef) {
           $lotdef->updated_by = Auth::user()-id;
        });
    }
    //
}
