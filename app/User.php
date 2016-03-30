<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first', 'last', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function groups() {
        return $this->belongsToMany('App\Group');
    }

    public function visits() {
        return $this->hasMany('App\Visit');
    }

    public function settings() {
        return $this->hasMany('App\UserSetting');
    }

    public function visitNotes() {
        return $this->hasManyThrough('App\VisitNote', 'App\Visit');
    }
}
