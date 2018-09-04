<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $table = 'absences';

    protected $fillable = ['schoolterm_id', 'classroom_subject_id', 'student_id', 'date', 'number'];

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
