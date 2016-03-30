<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupOwner extends Model
{
    protected $table = 'group_owner';

    protected $fillable = ['group_id', 'owner_id'];
}
