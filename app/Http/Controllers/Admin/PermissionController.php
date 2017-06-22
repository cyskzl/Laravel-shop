<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission;

class PermissionController extends Controller
{
    /**
     * @return  view    权限规则列表页
     */
    public function index()
    {
        return view('admin.main.permission.index');
    }

    /**
     * @return  view    权限规则修改页
     */
    public function edit()
    {
        return view('admin.main.permission.edit');
    }

    /**
     * @param Request $request  获取Ajax传参
     */
    public function store(Request $request)
    {
        //JSON数据转为对象
        $req = json_decode($request->json);

        //查询新权限名称是否存在
        $res = Permission::where('display_name', '=', $req->display_name)
                         ->orWhere('name', '=', $req->name)
                         ->first();

        if (!$res) {
            //执行添加
            $perms = Permission::create([
                'name' => $req->name,
                'display_name' => $req->display_name,
                'description' => $req->description,
            ]);

            if ($perms){
                //添加成功则返回json格式数据
                $perms['success'] = 1;
               return  json_encode($perms);
            } else {
                //添加失败返回 0
                $perms['success'] = 0;
                return json_encode($perms);
            }
        }

    }


}
