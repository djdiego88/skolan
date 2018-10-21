<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Area extends Model
{
    use LogsActivity;

    protected $table = 'areas';

    protected $fillable = ['name'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function teachers() {
        return $this->hasMany('App\Teacher');
    }
    public function subjects() {
        return $this->hasMany('App\Subject');
    }
}
