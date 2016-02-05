<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BuildTypeDef
 *
 * @property integer $id
 * @property string $label
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class BuildTypeDef extends Model
{
    protected $table = 'build_type_defs';
    //
}
