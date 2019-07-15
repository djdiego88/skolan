<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Guardian extends Model
{
    use LogsActivity;

    protected $table = 'guardians';

    protected $fillable = ['user_id', 'occupation', 'marital_status', 'studies', 'neighborhood', 'socioeconomic_level', 'commune'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function students()
    {
        return $this->belongsToMany('App\Student')->withPivot('relation')->withTimestamps();
    }
}
