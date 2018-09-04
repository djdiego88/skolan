<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $table = 'enrollments';

    protected $fillable = ['classroom_id', 'student_id'];

    public function classroom() {
    	return $this->belongsTo('App\Classroom');
    }
    public function student() {
    	return $this->belongsTo('App\Student');
    }
}
