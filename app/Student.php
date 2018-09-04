<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = ['user_id', 'neighborhood', 'socioeconomic_level', 'commune', 'health_care', 'blood_type', 'allergies', 'diseases'];

    public function user() {
    	return $this->belongsTo('App\User');
    }
    public function parents() {
        return $this->belongsToMany('App\Parent')->withPivot('relation')->withTimestamps();
    }
    public function absences() {
        return $this->hasMany('App\Absence');
    }
    public function enrollments() {
        return $this->hasMany('App\Enrollment');
    }
    public function annotations() {
        return $this->hasMany('App\Annotation');
    }
    public function qualifications() {
        return $this->hasMany('App\Qualification');
    }
    public function finalqualifications() {
        return $this->hasMany('App\FinalQualification');
    }
    public function preenrollments() {
        return $this->hasMany('App\Preenrollment');
    }
}
