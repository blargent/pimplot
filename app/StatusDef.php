<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\StatusDef
 *
 * @property integer $id
 * @property integer $build_type_id
 * @property integer $status_order
 * @property string $status_name
 * @property string $status_label
 * @property integer $days_out
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class StatusDef extends Model
{
    protected $table = 'status_defs';
    //
}
