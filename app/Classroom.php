<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Classroom extends Model
{
    use LogsActivity;

    protected $table = 'classrooms';

    protected $fillable = ['year_id', 'headquarter_id', 'schoolday_id', 'director_id', 'grade_id', 'name', 'quota'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function year()
    {
        return $this->belongsTo('App\Year');
    }
    public function headquarter()
    {
        return $this->belongsTo('App\Headquarter');
    }
    public function schoolday()
    {
        return $this->belongsTo('App\Schoolday');
    }
    public function director()
    {
        return $this->belongsTo('App\User');
    }
    public function grade()
    {
        return $this->belongsTo('App\Grade');
    }
    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }
    public function enrollments()
    {
        return $this->hasMany('App\Enrollment');
    }
    /*public function students()
    {
        return $this->hasMany('App\Student');
    }*/
    /*public function subjects()
    {
        return $this->belongsToMany('App\Subject')->withPivot('teacher_id', 'day', 'start_time', 'end_time')->withTimestamps();
    }*/
}
