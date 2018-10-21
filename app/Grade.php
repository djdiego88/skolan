<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Grade extends Model
{
    use LogsActivity;

    protected $table = 'grades';

    protected $fillable = ['name'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function classrooms() {
        return $this->hasMany('App\Classroom');
    }
    public function preenrollments() {
        return $this->hasMany('App\Preenrollment');
    }
}
