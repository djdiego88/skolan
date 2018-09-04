<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annotation extends Model
{
    protected $table = 'annotations';

    protected $fillable = ['student_id', 'teacher_id', 'year_id', 'schoolterm_id', 'type', 'name', 'description', 'show'];

    public function teacher() {
    	return $this->belongsTo('App\Teacher');
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
