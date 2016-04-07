<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitee extends Model {

    protected $guarded = ['id'];

    public function groups() {
        return $this->belongsToMany('App\Group')->withTimestamps();
    }

//    public function group() {
//        return $this->belongsTo('App\Group');
//    }

    public function visits() {
        return $this->hasMany('App\Visit');
    }

    public function notes() {
        return $this->hasManyThrough('App\VisitNote', 'App\Visit');
    }

}
