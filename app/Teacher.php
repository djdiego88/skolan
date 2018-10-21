<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Teacher extends Model
{
    use LogsActivity;

    protected $table = 'teachers';

    protected $fillable = ['user_id', 'acronym', 'area_id', 'profession', 'experience', 'applied_studies', 'scale', 'resolution'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function user() {
    	return $this->belongsTo('App\User');
    }
    public function area() {
    	return $this->belongsTo('App\Area');
    }
    public function schedules() {
        return $this->hasMany('App\Schedule');
    }
    public function annotations() {
        return $this->hasMany('App\Annotation');
    }
}
