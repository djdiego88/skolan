<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watchdog extends Model
{
    protected $table = 'watchdog';

    protected $fillable = ['user_id', 'type', 'text', 'ip'];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
