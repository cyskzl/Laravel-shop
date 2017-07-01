<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Permission;
use App\Models\RoleUser;
use App\Role;
use DB;
use Symfony\Component\VarDumper\Caster\AmqpCaster;

class AdminListController extends Controller
{
	protected $perms;

	public function __construct()
	{
		$this->perms = new Permission;
	}


	/**
	 * @return  view    管理员列表
	 */
	public function index(Request $request)
	{
        //判断是否有权限访问列表
        $this->perms->adminPerms('admin', 'admin_list');

		//搜索
		$search = AdminUser::orderBy('id', 'desc')
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('nickname','like','%'.$keyword.'%');
                }
            })->paginate(10);

		return view('admin.main.administrator.index', compact('search','request'));
	}

	/**
	 * @return  view    添加管理员页
	 */
	public function create()

	{
        //判断是否有权限添加
	    $this->perms->adminPerms('admin', 'create_role');
		$roles = Role::all();
		return view('admin.main.administrator.add', compact('roles'));
	}

    /**
     * 添加管理员
     *
     * @param  Request $request  Array
     * @return string
     */
	public function store(Request $request)
	{

		//获取新管理员信息
        $json = json_decode($request->json);

        //获取要赋予该管理员的角色
        $role = json_decode($request->roles);

		$user = new AdminUser;
	   $res  = $user->where('nickname', '=', $json->nickname)
                    ->OrWhere('email', '=', $json->email)
                    ->first();

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
		   $roles = Role::find($role);
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

	/**
     * @param   $id
	 * @return  view    修改管理员
	 */

	public function edit($id)
	{
        //判断是否有权限修改
		$this->perms->adminPerms('admin', 'edit_list');

        $roles = Role::all();
        $user = AdminUser::find($id);
        $myRoles = $user->roles;

		return view('admin.main.administrator.edit', compact('roles', 'user', 'myRoles'));
	}

    /**
     * 管理员修改
     *
     * @param  Request $request   json_edit   json
     * @param  $id
     * @return string
     */
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
                $role = Role::find($roles);
                $myRoles = $user->roles;
				// $deleteRole = $role->diff($myRoles);

                foreach ($myRoles as $row) {
                    $user->deleteRole($row);
                }

                //添加新权限
                $addRoels = $role->diff($myRoles);

                foreach ($role as $role) {
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

    /**
     * 管理员删除
     *
     * @param  Request $request  json
     * @param  $id
     * @return string
     */
    public function destroy(Request $request, $id)
    {
        //判断是否有权限删除
		$error = $this->perms->adminDelPerms('admin', 'delete_admin');

		if ($error) {
			return $error;
		}
		//获取 Ajax json数据
        $json = json_decode($request->json);

        $res  = AdminUser::where('id', '=', $json->id)->delete();

        if ($res) {
           //删除该管理员下的角色
           $role = \DB::table('role_user')->where('user_id', '=', $id)->delete();
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
