<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Usermeta extends Model
{
    use LogsActivity;

    protected $table = 'usermeta';

    protected $fillable = ['user_id', 'name', 'value'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
