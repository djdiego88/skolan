<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Schoolday extends Model
{
    use LogsActivity;

    protected $table = 'schooldays';

    protected $fillable = ['name'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function classrooms()
    {
        return $this->hasMany('App\Classroom');
    }
}
