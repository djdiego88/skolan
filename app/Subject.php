<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = ['area_id', 'name'];

    public function area() {
    	return $this->belongsTo('App\Area');
    }
    public function schedules() {
        return $this->hasMany('App\Schedule');
    }
}
