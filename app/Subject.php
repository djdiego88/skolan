<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Subject extends Model
{
    use LogsActivity;

    protected $table = 'subjects';

    protected $fillable = ['area_id', 'name'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function area()
    {
        return $this->belongsTo('App\Area');
    }
    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }
    /*public function classrooms()
    {
        return $this->belongsToMany('App\Classroom')->withPivot('teacher_id', 'day', 'start_time', 'end_time')->withTimestamps();
    }*/
}
