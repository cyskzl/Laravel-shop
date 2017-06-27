<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AdminRole;
use App\AdminPermission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = AdminRole::paginate(10);
        return view('admin.main.adminrole.index', compact('roles'));
    }


    public function create()
    {
        $permission   = AdminPermission::all();
        $myPermission = new AdminRole;
        $myPermission->permission;
        // dd($myPermission);
        return view('admin.main.adminrole.add', compact('permission'));
    }

    //保存新建角色及其权限
    public function store(Request $request)
    {
        //获取角色名称及描述  Object
        $json   = json_decode($request->json);

        //获取权限ID Array
        $perms  = json_decode($request->perms, true);

        //实例化角色类
        $roles  = new AdminRole;
        $roles->name = $json->name;
        $roles->description =  $json->description;

        //保存新建角色
        if ($roles->save()) {
            //如果新建角色保存成功，继续执行添加权限
            $permissions    = AdminPermission::find($perms);
            $myPermissions  = $roles->permissions;

            //对已经有的权限
            $addPermissions = $permissions->diff($myPermissions);
            foreach ($addPermissions as $permission) {
                $roles->grantPermission($permission);
            }

            //删除原有角色权限
            $deletePermissions = $myPermissions->diff($permissions);
            foreach ($deletePermissions as $permission) {
                $role->deletePermissions($permission);
            }
            //返回成功值给 Ajax
            return 1;
        }
        return 0;
    }

    public function edit($id)
    {   
        return view('admin.main.adminrole.edit');
    }
}
