<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Absence extends Model
{
    use LogsActivity;

    protected $table = 'absences';

    protected $fillable = ['schoolterm_id', 'classroom_subject_id', 'student_id', 'date', 'number'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function schoolterm() {
    	return $this->belongsTo('App\Schoolterm');
    }
    public function schedule() {
    	return $this->belongsTo('App\Schedule');
    }
    public function student() {
    	return $this->belongsTo('App\Student');
    }
}
