<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Enrollment extends Model
{
    use LogsActivity;

    protected $table = 'enrollments';

    protected $fillable = ['classroom_id', 'student_id'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function classroom() {
    	return $this->belongsTo('App\Classroom');
    }
    public function student() {
    	return $this->belongsTo('App\Student');
    }
}
