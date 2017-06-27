<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\AdminRole;

class AdminUserController extends Controller
{
    //管理员列表页
    public function index()
    {

        $admin_user = AdminUser::paginate(10);
        // dd($admin_user);
        return view('admin.main.administrator.index', compact('admin_user'));
    }

    //创建管理员页
    public function create()
    {
        //获取所有角色
        $roles   = AdminRole::all();
        return view('admin.main.administrator.add', compact('roles'));
    }

    public function store(Request $request)
    {
        //获取新管理员信息
        $json = json_decode($request->json);

        //获取要赋予该管理员的角色
        $role = json_decode($request->roles);


        $user = new AdminUser;
        $res  = $user->where('nickname', '=', $json->nickname)->OrWhere('email', '=', $json->email)->first();
        if ($res) {
            $error['success'] = 0;
            $error['info']    = '添加失败,管理员名称或邮箱已存在';
            return json_encode($error);
        }
        $user->nickname = $json->nickname;
        $user->password = bcrypt($json->password);
        $user->email    = $json->email;
        $user->status   = $json->status;

        //保存新建管理员的信息
        if ($user->save()) {
            //添加赋予新建管理员的角色
            $roles = AdminRole::find($role);
            $myRoles = $user->roles;
            $addRoles = $roles->diff($myRoles);

            foreach($addRoles as $role){
                $user->assignRole($role);
            }

            //返回成功值给Ajax
            $error['success'] = 1;
            $error['info']    = '添加成功';
            return json_encode($error);
        } else {

            $error['success'] = 0;
            $error['info']    = '添加失败';
            return json_encode($error);
        }

    }

    //修改页
    public function edit($id)
    {
        // $user = new AdminUser;
        $roles = AdminRole::all();
        // $myRoles = $user->find($id)->roles;
        // $myRoles = AdminUser::find($id)->roles;
        $user = AdminUser::find($id);
        $myRoles = $user->roles;

        return view('admin.main.administrator.edit', compact('user', 'roles', 'myRoles'));
    }

    //更新管理员信息
    public function update(Request $request, $id)
    {
        if ($request->json_edit) {

            $json = json_decode($request->json_edit, true);
            $roles = json_decode($request->roles, true);

            unset($json['id']);
            unset($json['roles[]']);

            if($json['password'] != ''){
                $json['password'] = bcrypt($json['password']);
            } else {
                unset($json['password']);
            }

            if (AdminUser::where('id', '=', $id)->update($json)) {

                //删除原有权限
                $user = AdminUser::find($id);
                $role = AdminRole::findMany($roles);
                $myRoles = $user->roles;
                // dd($role);

                foreach ($role as $row) {
                    $user->deleteRole($row);
                }

                //添加新权限
                $addRoels = $role->diff($myRoles);
                foreach ($addRoels as $role) {
                    $user->assignRole($role);
                }
                $error['success'] = 1;
                $error['info']    = '保存成功';
                return json_encode($error);
            }

        } else {

            //管理员状态修改
            $data = json_decode($request->json);
            $user = AdminUser::find($id);
            if ($user) {
                $info = AdminUser::where('id', '=', $id)->update(['status'=> $data->status]);
                if ($info) {
                    $error['success'] = 1;
                    $error['info']    = '已禁用';
                    return json_encode($error);
                } else {
                    $error['success'] = 0;
                    $error['info']    = '禁用失败';
                    return json_encode($error);
                }
            }

        }

        $error['success'] = 0;
        $error['info']    = '操作失败';
        return json_encode($error);

    }


    //删除
    public function destroy(Request $request, $id)
    {
        //获取 Ajax json数据
        $json = json_decode($request->json);

        $res  = AdminUser::where('id', '=', $json->id)->delete();

        if ($res) {
            //删除该管理员下的角色
            $role = \DB::table('admin_role_user')->where('user_id', '=', $id)->delete();
            if ($role) {

                $error['success'] = 1;
                $error['info']    = '删除成功';
                return json_encode($error);
            } else {

                $error['success'] = 0;
                $error['info']    = '该管理员的所属角色ID删除失败,或不存在';
                return json_encode($error);
            }

        }

    }

}
