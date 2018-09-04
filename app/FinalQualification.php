<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinalQualification extends Model
{
    protected $table = 'final_qualifications';

    protected $fillable = ['classroom_subject_id', 'student_id', 'year_id', 'schoolterm_id', 'value'];

    public function schedule() {
    	return $this->belongsTo('App\Schedule');
    }
    public function student() {
    	return $this->belongsTo('App\Student');
    }
    public function year() {
    	return $this->belongsTo('App\Year');
    }
    public function schoolterm() {
    	return $this->belongsTo('App\Schoolterm');
    }
}
