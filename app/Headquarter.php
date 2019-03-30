<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Headquarter extends Model
{
    use LogsActivity;

    protected $table = 'headquarters';

    protected $fillable = ['name', 'location', 'address', 'dane', 'telephone'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function classrooms() {
        return $this->hasMany('App\Classroom');
    }
}
