<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Auth;
use DB;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{

    protected $perms;

    /**
     * AdminRoleController constructor.
     */
 	public function __construct()
 	{
 		$this->perms = new Permission;
 	}


    /**
     * @return  view    角色列表
     */
    public function index()
    {
        //判断是否有权限访问列表
        $this->perms->adminPerms('admin', 'role_list');

        $roles = Role::paginate(10);
        return view('admin.main.adminrole.index', compact('roles'));
    }

    /**
     * @return  view    添加角色
     */
    public function create()
    {
        //判断是否有权限添加
        $this->perms->adminPerms('admin', 'create_role');

        $permission   = Permission::all();

        return view('admin.main.adminrole.add', compact('permission'));
    }


    /**
     * 添加新角色
     * @param Request $request  json
     * @return int
     */
    public function store(Request $request)
    {


        //获取角色名称及描述  Object
       $json   = json_decode($request->json);

       //获取权限ID Array
       $perms  = json_decode($request->perms, true);

       //实例化角色类
       $roles  = new Role;
       $roles->name = $json->name;
       $roles->description =  $json->description;

       //保存新建角色
       if ($roles->save()) {
           //如果新建角色保存成功，继续执行添加权限
           $permissions    = Permission::find($perms);
           $myPermissions  = $roles->permissions;

           //添加权限
           $addPermissions = $permissions->diff($myPermissions);
           foreach ($addPermissions as $permission) {
               $roles->grantPermission($permission);
           }

           //返回成功值给 Ajax
           return 1;
       }
       return 0;

    }

    /**
     * 修改角色信息
     *
     * @param   $id     角色ID
     * @return  view    角色修改
     */
    public function edit($id)
    {
        //判断是否有权限修改
        $this->perms->adminPerms('admin', 'edit_role');

        $roles        = Role::find($id);
        //获取权限列表
        $permissions  = Permission::all();
        //获取已有的权限
        $myPermissions = $roles->permissions;
        dd($myPermissions,$permissions);
        return view('admin.main.adminrole.edit', compact('permissions', 'myPermissions', 'roles'));
    }

    /**
     * 更新角色权限列表
     *
     * @param   $id
     * @param   Request $request    json
     * @return string
     */
    public function update(Request $request, $id)
    {
        $role  = json_decode($request->json, true);
        $perms = json_decode($request->perms, true);

        //删除数组无用元素
        unset($role['id']);
        unset($role['perms[]']);

        $roles = Role::find($id);
        //更新角色信息
        $res   = $roles->where('id', '=', $id)->update($role);

        if ($res) {

            //角色信息更新成功继续更新权限
            $permissions = Permission::find($perms);
            $myPermissions = $roles->permissions;

            //删除原有的权限
            foreach ($myPermissions as $permission) {
                $roles->deletePermission($permission);
            }

            //更新新的权限
            foreach ($permissions as $permission) {
                $roles->grantPermission($permission);
            }

            //返回成功信息给Ajax
            $error['success'] = 1;
            $error['info']    = '保存成功';
            return json_encode($error);

        }

        $error['success'] = 0;
        $error['info']    = '保存失败';
        return json_encode($error);
    }


    /**
     * 删除指定角色
     *
     * @param $id
     * @return string
     */
    public function destroy($id)
    {
        //判断是否有权限删除
        $error = $this->perms->adminDelPerms('admin', 'delete_role');
		if ($error) {
			return $error;
		}

        //查询是否存在
       $role = Role::where('id', '=', $id)->first();

       if ($role) {
           //删除角色
           $res = Role::where('id', '=', $id)->delete();
           if ($res) {

               //删除该角色下的权限
               $myPermissions = $role->permissions;
               foreach ($myPermissions as $permission) {
                   $role->deletePermission($permission);
               }

               //返回成功信息给Ajax
               $error['success'] = 1;
               $error['info']    = '删除成功';
               return json_encode($error);

           }

           $error['success'] = 0;
           $error['info']    = '删除失败';
           return json_encode($error);

       }

        $error['success'] = 0;
        $error['info']    = '该角色不存在';
        return json_encode($error);

    }


}
