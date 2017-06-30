<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    //表名
    protected $table = 'roles';

    //批量添加字段
    protected $fillable = [
    	'name','display_name','description'
    ];

    /**
     * 当前角色的所有权限
     *
     * @return $this
     */
    public function permissions()
    {
        return $this->belongsToMany(\App\Permission::class, 'permission_role', 'role_id', 'permission_id')->withPivot(['permission_id', 'role_id']);
    }

    /**
     * 给角色赋予权限
     *
     * @param $permission
     * @return mixed
     */
    public function grantPermission($permission)
    {
        return $this->permissions()->save($permission);
    }

    /**
     * 取消用户赋予的角色权限
     *
     * @param $permission
     * @return mixed
     */
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
