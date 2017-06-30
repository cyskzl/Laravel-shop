<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserLogin extends Authenticatable
{
    protected $table = 'users_login';

    protected $fillable = [
        'login_name', 'password',
    ];
}
