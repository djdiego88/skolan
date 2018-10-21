<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Homework extends Model
{
    use LogsActivity;

    protected $table = 'homeworks';

    protected $fillable = ['classroom_subject_id', 'name', 'description', 'deadline'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function schedule() {
    	return $this->belongsTo('App\Schedule');
    }
}
