<?php

namespace App;

use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use AlgoliaEloquentTrait;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function users() {
        return $this->hasMany('App\User');
    }

    public function visitees() {
        return $this->belongsToMany('App\Visitee')->withTimestamps();
    }

    public function visits() {
        return $this->hasManyThrough('App\Visit', 'App\Visitee');
    }

    public $algoliaSettings = [
        'attributesToIndex' => ['name', 'city', 'state', 'zip'],
    ];
}
