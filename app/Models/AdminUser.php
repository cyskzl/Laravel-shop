<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{

    protected $rememberTokenName = '';

    protected $guarded = [];

    protected $table = 'admin_users';

    protected $fillable = [
    	'nickname', 'password', 'email', 'status', 'remember_token'
    ];


    //用户有哪些角色
    public function roles()
    {
        return $this->belongsToMany(\App\AdminRole::class, 'admin_role_user', 'user_id', 'role_id')->withPivot(['user_id', 'role_id']);
    }

    //判断是否有某个角色， 某些角色
    public function isInRoles($roles)
    {
        return !!$roles->intersect($this->roles)->count();
    }

    //给用户分配角色
    public function assignRole($role)
    {
        return $this->roles()->save($role);
    }

    //取消用户分配的角色
    public function deleteRole($role)
    {
        return $this->roles()->detach($role);
    }

    //用户是否有权限

    public function hasPermission($permission)
    {
        $this->isInRoles($permission->roles);
    }

}
