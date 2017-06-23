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

class AdminListController extends Controller
{
	/**
	 * @return  view    管理员列表
	 */
	public function index()
	{
		//查询管理员及其所属角色
//        $admin = new AdminUser
		$admin_user = AdminUser::join('roles', 'admin_users.role_id','=','roles.id')
                            ->select('roles.display_name','admin_users.*')
                         ->get();
//        dd($admin_user);
		return view('admin.main.administrator.index', compact('admin_user'));
	}

	/**
	 * @return  view    添加管理员页
	 */
	public function create()
	{
		$role = Role::select('id', 'name', 'display_name')->get();
		return view('admin.main.administrator.add', compact('role'));
	}

    /**
     * 添加管理员
     *
     * @param Request $request  Array
     * @return int
     */
	public function store(Request $request)
	{
	    //json数据转为对象
		$req = json_decode($request->json);
        $res = AdminUser::where('nickname', '=', $req->nickname)->OrWhere('email', '=', $req->email)->first();

		if (!$res) {
            //实例化
            $user =  new AdminUser;

            //创建管理员
            $user->nickname = $req->nickname;
            $user->email    = $req->email;
            $user->password = $req->password;
            $user->status   = $req->status;
            $user->role_id  = $req->role_id;
            //判断是否创建成功
            if ($user->save()) {

                $arr = [
                    'success'=>'1',
                    'info'   =>'添加成功！',
                ];

                return json_encode($arr);

            } else {
                $arr = [
                    'success'=>'0',
                    'info'   =>'添加失败！',
                ];
                return json_encode($arr);
            }

		} else {

		    $arr = [
		        'success'=>'0',
                'info'   =>'用户名或邮箱已存在！',
            ];

		    return json_encode($arr);
        }

	}

	/**
	 * @return  view    修改管理员
	 */
	public function edit($id)
	{
//	    $admin_user = AdminUser::find($id);
        $admin = new AdminUser;
        $res = $admin->find($id);
        $role = Role::get();
//        dd($role);
		return view('admin.main.administrator.edit', compact('res', 'role'));
	}

    /**
     * 管理员修改
     *
     * @param Request $request
     * @param $id
     * @return int
     */
	public function update(Request $request, $id)
    {
        //判断是否是表单修改
        if ($request->json_edit) {

            $json = json_decode($request->json_edit, true);
//            $a = $json['password'] != ''?$json['password']:unset($json['password']);
            if($json['password'] == '') unset($json['password']);

            $res = AdminUser::where('id', '=', $id)->update($json);
            if ($res) {

                return 1;
            } else {

                return 0;
            }
        } else {

            //禁用 => 修改管理员状态
            $data = json_decode($request->json);

            $res = AdminUser::find($id);
            if ($res) {

                $info = AdminUser::where('id', '=', $id)->update(['status'=> $data->status]);

                if ($info) {

                    return 1;
                } else {

                    return 0;
                }
            }

        }

	}

    /**
     * 管理员删除
     *
     * @param Request $request
     * @param $id
     * @return int
     */
    public function destroy(Request $request, $id)
    {
        $json = json_decode($request->json);
        $res = AdminUser::where('id', '=', $json->id)->delete();
        if ($res) {
            return 1;
        } else {
            return 0;
        }

    }


}
