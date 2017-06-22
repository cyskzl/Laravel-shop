<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRegister extends Model
{
    // 将表名指向users_register
    protected $table = 'users_register';

//    public $fillable = ['tel','email','password','third_party_id','register_ip'];

    // 与用户详情表建立一对一关系
    public function userInfo()
    {
        return $this->hasOne('App\Models\UserInfo','user_id');
    }

    // 与用户积分表建立一对一关系
    public function userCode()
    {
        return $this->hasOne('App\Models\UserCode','user_id');
    }

    // 与注册邮箱临时存储表建立一对一关系
    public function tempeMail(){
        return $this->hasOne('App\Models\TempEmail','user_id');
    }

    // 与收货地址建立一对多关系
    public function receivingAddress(){
        return $this->hasMany('App\Models\ReceivingAddress','user_id');
    }
}
