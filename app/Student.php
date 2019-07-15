<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Student extends Model
{
    use LogsActivity;

    protected $table = 'students';

    protected $fillable = ['user_id', 'neighborhood', 'socioeconomic_level', 'commune', 'health_care', 'blood_type', 'allergies', 'diseases'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function guardians()
    {
        return $this->belongsToMany('App\Guardian')->withPivot('relation')->withTimestamps();
    }
    public function absences()
    {
        return $this->hasMany('App\Absence');
    }
    public function enrollments()
    {
        return $this->hasMany('App\Enrollment');
    }
    public function annotations()
    {
        return $this->hasMany('App\Annotation');
    }
    public function qualifications()
    {
        return $this->hasMany('App\Qualification');
    }
    public function finalqualifications()
    {
        return $this->hasMany('App\FinalQualification');
    }
    public function preenrollments()
    {
        return $this->hasMany('App\Preenrollment');
    }
    /*public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }*/
}
