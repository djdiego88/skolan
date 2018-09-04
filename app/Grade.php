<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grades';

    protected $fillable = ['name'];

    public function classrooms() {
        return $this->hasMany('App\Classroom');
    }
    public function preenrollments() {
        return $this->hasMany('App\Preenrollment');
    }
}
