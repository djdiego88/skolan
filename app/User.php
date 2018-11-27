<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cmgmyr\Messenger\Traits\Messagable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable;
    use Messagable;
    use HasRoles;
    use LogsActivity;

    protected $table = 'users';
    protected $dates = ['created_at', 'updated_at', 'last_access', 'birth_date'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'it', 'nid', 'first_name', 'last_name', 'email', 'password', 'birth_date', 'gender', 'phone_number', 'cellphone_number', 'nacionality', 'location', 'address', 'photo', 'status', 'last_access',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function usermeta() {
        return $this->hasMany('App\Usermeta');
    }
    public function student() {
        return $this->hasOne('App\Student');
    }
    public function parent() {
        return $this->hasOne('App\Parent');
    }
    public function teacher() {
        return $this->hasOne('App\Teacher');
    }
    public function classroom() {
        return $this->hasOne('App\Classroom');
    }
    public function scopeSearchByName($query,$name){
        return $query->join('usermeta', function ($join) {
                        $join->on('users.id', '=', 'usermeta.user_id')
                             ->where('usermeta.name', '=', 'display_name');
                    })
                    ->where('users.first_name', 'LIKE', "%$name%")
                    ->orWhere('users.last_name', 'LIKE', "%$name%")
                    ->orWhere('usermeta.value', 'LIKE', "%$name%");
    }
    public function enabled() {
        return $this->status === 'enabled';
    }
}
