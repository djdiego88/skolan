<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Schoolterm extends Model
{
    use LogsActivity;

    protected $table = 'schoolterms';

    protected $fillable = ['year_id', 'name', 'start_date', 'end_date', 'status', 'qualifications_blocked'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

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
