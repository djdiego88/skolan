<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'options';

    protected $fillable = ['name', 'display_name', 'description', 'value'];
}
