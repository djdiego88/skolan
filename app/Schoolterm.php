<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schoolterm extends Model
{
    protected $table = 'schoolterms';

    protected $fillable = ['year_id', 'name', 'start_date', 'end_date', 'status'];

    public function year() {
    	return $this->belongsTo('App\Year');
    }
    public function absences() {
        return $this->hasMany('App\Absence');
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
}
