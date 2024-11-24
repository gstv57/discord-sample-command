<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'username',
        'discord_id',
        'is_admin',
    ];
}
