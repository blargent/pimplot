<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LotDef
 * @package App
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
    //
}
