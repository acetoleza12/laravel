<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'password',
        'role',
    ];

    public $timestamps = true;
}
