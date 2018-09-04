<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schoolday extends Model
{
    protected $table = 'schooldays';

    protected $fillable = ['name'];

    public function classrooms() {
        return $this->hasMany('App\Classroom');
    }
}
