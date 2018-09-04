<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preenrollment extends Model
{
    protected $table = 'preenrollments';

    protected $fillable = ['grade_id', 'student_id', 'year_id', 'type'];

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
