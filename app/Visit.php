<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = ['user_id', 'visitee_id', 'category_id'];

    protected $date = ['created_at'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function visitee() {
        return $this->belongsTo('App\Visitee');
    }

    public function notes() {
        return $this->hasMany('App\VisitNote');
    }

    public function type() {
        return $this->belongsTo('App\CheckinType', 'category_id');
    }

}
