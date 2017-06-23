<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;


class RoleUser extends Model
{
    use EntrustUserTrait;

    protected $table = 'role_user';

    protected $fillable = [
        'user_id','role_id'
    ];





}
