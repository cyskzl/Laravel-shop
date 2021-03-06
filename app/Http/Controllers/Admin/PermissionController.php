<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission;

class PermissionController extends Controller
{
    protected $perms;

	public function __construct()
	{
		$this->perms = new Permission;
	}
    
    /**
     * @return  view    权限规则列表页
     */
    public function index()
    {
        //判断是否有权限访问列表
        $this->perms->adminPerms('admin', 'permission_list');

        $permission = Permission::OrderBy('id', 'desc')->paginate(10);

        return view('admin.main.permission.index', compact('permission'));
    }

    /**
     * @param   $id
     * @return  view    权限规则修改页
     */
    public function edit($id)
    {
        //判断是否有权限访问修改
        $this->perms->adminPerms('admin', 'edit_permission');
        $permission = Permission::find($id);
        return view('admin.main.permission.edit', compact('permission'));
    }

    /**
     * 更新权限列表
     *
     * @param Request $request  json
     * @param $id
     * @return string
     */
    public function update(Request $request, $id)
    {
        $json = json_decode($request->json, true);
       $permission = Permission::where('id', '=', $id)->first();
       if ($permission) {
           //删除数组无用ID
           unset($json['id']);
           $res = $permission->where('id', '=', $id)->update($json);
           if ($res) {

                   $error['success'] = 1;
                   $error['info'] = '保存成功！';
                   return json_encode($error);
               }

               $error['success'] = 0;
               $error['info'] = '保存失败！';
               return json_encode($error);

           }

            $error['success'] = 0;
            $error['info'] = '该权限信息不存在';
            return json_encode($error);

    }

    /**
     * 权限规则添加
     *
     * @param Request $request  json
     * @return string
     */
    public function store(Request $request)
    {
        //判断是否有权限访问列表
        $this->perms->adminPerms('admin', 'create_permission');

        //json数据转为对象
        $json  = json_decode($request->json);

        $perms = new Permission;
        $perms->name = $json->name;
        $perms->description = $json->description;

        if ($perms->save()) {
            $perms['success'] = 1;
            return json_encode($perms);
        }

    }

    /**
     * 删除权限规则
     *
     * @param  $id
     * @return string
     */
    public function destroy($id)
    {
        //判断是否有权限删除
		$error = $this->perms->adminDelPerms('admin', 'delete_pimission');
		if ($error) {
			return $error;
		}

        $permission = Permission::where('id', '=', $id)->first();
       if ($permission) {
           $res = Permission::where('id', '=', $id)->delete();
           if ($res) {

                   $error['success'] = 1;
                   $error['info'] = '删除成功！';
                   return json_encode($error);
               }

           $error['success'] = 0;
           $error['info'] = '删除失败！';
           return json_encode($error);

       }

        $error['success'] = 0;
        $error['info'] = '该权限信息不存在';
        return json_encode($error);

    }


}
