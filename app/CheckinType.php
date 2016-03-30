<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckinType extends Model
{
    protected $fillable = ['name', 'active'];
}
