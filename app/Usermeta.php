<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usermeta extends Model
{
    protected $table = 'usermeta';

    protected $fillable = ['user_id', 'name', 'value'];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
