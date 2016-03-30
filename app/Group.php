<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function users() {
        return $this->hasMany('App\User');
    }

    public function visitees() {
        return $this->belongsToMany('App\Visitee');
    }
}
