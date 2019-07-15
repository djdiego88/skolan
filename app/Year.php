<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Year extends Model
{
    use LogsActivity;

    protected $table = 'years';

    protected $fillable = ['name', 'status', 'start_date', 'end_date'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function schoolterms()
    {
        return $this->hasMany('App\Schoolterm');
    }
    public function classrooms()
    {
        return $this->hasMany('App\Classroom');
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
}
