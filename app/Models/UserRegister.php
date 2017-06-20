<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRegister extends Model
{
    protected $table = 'users_register';

//    public $fillable = ['tel','email','password','third_party_id','register_ip'];

    public function userinfo()
    {
        return $this->hasOne('App\Models\UserInfo','user_id');
    }
}
