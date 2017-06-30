<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $table = 'roles';

    protected $fillable = [
    	'name','display_name','description'
    ];

    //当前角色的所有权限
    public function permissions()
    {
        return $this->belongsToMany(\App\Permission::class, 'permission_role', 'role_id', 'permission_id')->withPivot(['permission_id', 'role_id']);
    }

    //给角色赋予权限
    public function grantPermission($permission)
    {
        return $this->permissions()->save($permission);
    }

    //取消用户赋予的角色权限
    public function deletePermission ($permission)
    {
        return $this->permissions()->detach($permission);
    }

    // //判断角色是否有权限
    // public function hasPermission($permission)
    // {
    //     return $this->permissions()->contains($permission);
    // }

}
