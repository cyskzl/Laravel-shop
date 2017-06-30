<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Zizaco\Entrust\HasRole;
//use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{

<<<<<<< HEAD
    // use HasRole;
//    use Notifiable;
    use EntrustUserTrait;

    protected $table = 'admin_users';

=======
    use EntrustUserTrait;

    //定义表名
    protected $table = 'admin_users';

    //定义批量添加
>>>>>>> origin/dasuan
    protected $fillable = [
    	'nickname', 'password', 'email', 'status','role_id'
    ];

<<<<<<< HEAD
    //用户有哪些角色
=======

    /**
     * 用户有哪些角色
     *
     * @return $this
     */
>>>>>>> origin/dasuan
    public function roles()
    {
        return $this->belongsToMany(\App\Role::class, 'role_user',  'user_id', 'role_id')->withPivot(['user_id', 'role_id']);
    }

<<<<<<< HEAD
    //判断是否有某个角色，某些角色
=======
    /**
     * 判断是否有某个角色，某些角色
     *
     * @param  $role
     * @return bool
     */
>>>>>>> origin/dasuan
    public function isInRoles($role)
    {
        return !!$role->intersect($this->roles)->count();
    }

<<<<<<< HEAD
    //给用户分配角色
=======
    /**
     * 给用户分配角色
     *
     * @param  $role
     * @return mixed
     */
>>>>>>> origin/dasuan
    public function assignRole($role)
    {
        return $this->roles()->save($role);
    }

<<<<<<< HEAD
    //取消用户分配的角色
=======
    /**
     * 取消用户分配的角色
     *
     * @param  $role
     * @return mixed
     */
>>>>>>> origin/dasuan
    public function deleteRole($role)
    {
        return $this->roles()->detach($role);
    }

<<<<<<< HEAD
    //用户是否有权限
=======
    /**
     * 用户是否有权限
     *
     * @param  $permission
     * @return bool
     */
>>>>>>> origin/dasuan
    public function hasPermission($permission)
    {
        return $this->isInRoles($permission->roles);
    }

    

}
