<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use DB;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    /**
     * AdminRoleController constructor.
     */
    public function __construct()
    {
//        $this->middleware('permission:edit_role', ['only' => 'update']);
//        $this->middleware('permission:delete_role', ['only' => 'destroy']);
    }

    /**
     * @return  view    角色列表
     */
    public function index()
    {
        $res = Role::with('perms')->get();
        $count = Role::paginate(10);

        return view('admin.main.adminrole.index', compact('res', 'count'));
    }

    /**
     * @return  view    添加角色
     */
    public function create()
    {
        $roles = Role::with('perms')->get();
        $perms = Permission::get();
        return view('admin.main.adminrole.add', compact('roles', 'perms'));
    }


    /**
     * 添加新角色
     * @param Request $request
     * @return int
     */
    public function store(Request $request)
    {
        //json数据转为对象
        $req = json_decode($request->json);

        //json数据转为数组
        $perms = json_decode($request->perms, true);

        //查询是否已存在
        $name = Role::where('name', '=', $req->name)->first();

        if (!$name) {
            //执行添加到数据库
            $roles = Role::create([
                'name' => $req->name,
                'display_name' => $req->display_name,
                'description' => $req->description,
            ]);

            //判断是否添加成功，如果添加成功且选中了某个权限继续添加
            if ($roles) {
                if ($perms) {

                    $roles->attachPermissions($perms);
                    return 1;
                }
            }

        } else {

            return 0;
        }

    }

    /**
     * 修改角色信息
     * @param   $id     角色ID
     * @return  view    角色修改
     */
    public function edit($id)
    {
        //查询角色
        $role = Role::find($id);

        //获取所有权限列表
        $permission = Permission::get();

        //连表查询
        $rolePermissions = DB::table("permission_role")
            ->where("permission_role.role_id", $id)
            ->lists('permission_role.permission_id', 'permission_role.permission_id');

        return view('admin.main.adminrole.edit', compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * 更新角色权限列表
     *
     * @param   Request $request
     * @return  int
     */
    public function update(Request $request, $id)
    {
        //json数据转为数组
        $perms = json_decode($request->perms, true);

        //json数据转为对象
        $request = json_decode($request->json);

        //查询角色
        $role = Role::findOrFail($request->id);

        //进行修改
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        //删除原有权限
        DB::table('permission_role')
            ->where('permission_role.role_id', '=', $id)
            ->delete();

        //修改为新的权限
        foreach ($perms as $value) {

            $res = $role->attachPermission($value);
        }

    }


    /**
     * 删除指定角色
     * @param $id
     * @return int  0 => false  1 => true
     */
    public function destroy($id)
    {

//        $role = Role::where('id', '=', $id)->delete();
//        $data = DB::table('permission_role')
//              ->where('role_id', '=', $id)
//              ->delete();

        $role = Role::findOrFail($id); // 获取给定权限

        // 正常删除
        $role->delete();

        if ($role) {
            //删除成功 return 返回给 Ajax
            return 1;
        } else {
            //删除失败
            return 0;
        }

    }


}
