<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Option extends Model
{
	use LogsActivity;

    protected $table = 'options';

    protected $fillable = ['name', 'display_name', 'description', 'value'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;
}
