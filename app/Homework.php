<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    protected $table = 'homeworks';

    protected $fillable = ['classroom_subject_id', 'name', 'description', 'deadline'];

    public function schedule() {
    	return $this->belongsTo('App\Schedule');
    }
}
