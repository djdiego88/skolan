<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parent extends Model
{
    protected $table = 'parents';

    protected $fillable = ['user_id', 'occupation', 'civil_status', 'studies', 'neighborhood', 'socioeconomic_level', 'commune'];

    public function user() {
    	return $this->belongsTo('App\User');
    }
    public function students() {
        return $this->belongsToMany('App\Student')->withPivot('relation')->withTimestamps();
    }
}
