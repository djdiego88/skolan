<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Schedule extends Model
{
    use LogsActivity;

    protected $table = 'classroom_subject';

    protected $fillable = ['classroom_id', 'subject_id', 'teacher_id', 'day', 'start_time', 'end_time'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
    public function absences()
    {
        return $this->hasMany('App\Absence');
    }
    public function homeworks()
    {
        return $this->hasMany('App\Homework');
    }
    public function qualifications()
    {
        return $this->hasMany('App\Qualification');
    }
    public function finalqualifications()
    {
        return $this->hasMany('App\FinalQualification');
    }
}
