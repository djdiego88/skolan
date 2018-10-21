<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Preenrollment extends Model
{
    use LogsActivity;

    protected $table = 'preenrollments';

    protected $fillable = ['grade_id', 'student_id', 'year_id', 'type'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function grade() {
    	return $this->belongsTo('App\Grade');
    }
    public function student() {
    	return $this->belongsTo('App\Student');
    }
    public function year() {
    	return $this->belongsTo('App\Year');
    }
}
