<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JoinRequest extends Model
{
    protected $table = 'join_requests';

    protected $fillable = ['group_id', 'owner_id', 'user_id', 'code'];
}
