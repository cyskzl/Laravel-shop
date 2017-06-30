<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $table = 'permissions';

    protected $fillable = [
    	'name','display_name','description'
    ];

    /**
     * 权限属于哪个角色
     *
     * @return $this
     */
    public function roles()
    {
        return $this->belongsToMany(\App\Role::class, 'permission_role', 'permission_id', 'role_id')->withPivot(['permission_id', 'role_id']);
    }

    /**
     * 判断权限
     *
     * @param $role
     * @param null   $permission
     */
    public function adminPerms($role, $permission=null)
    {
        if(!\Auth::guard('admin')->user()->ability($role, $permission)){
            return abort(403);
        }


    }

    /**
     * 判断权限
     *
     * @param   $role
     * @param   null $permission
     * @return  string
     */
    public function adminDelPerms($role, $permission=null)
    {
        if(!\Auth::guard('admin')->user()->ability($role, $permission)){
            $error['success'] = 0;
            $error['info']    = '您没有删除权限';
            return json_encode($error);
        }
    }
}
