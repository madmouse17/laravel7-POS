<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use LogsActivity;

    protected static $logAttributes = ['name', 'email','profile','username'];
    protected static $recordEvents = ['Created','Updated','Deleted'];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} user";
    }
    protected static $logName = "User";
    


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile','username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}