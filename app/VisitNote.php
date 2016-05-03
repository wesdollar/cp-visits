<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitNote extends Model
{

    protected $fillable = ['note', 'visit_id', 'image'];

    public function visit() {
        return $this->belongsTo('App\Visit');
    }

}
