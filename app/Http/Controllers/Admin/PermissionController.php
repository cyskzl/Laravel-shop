<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Models\PermissionClass;

class PermissionController extends Controller
{
    /**
     * @return  view    权限规则列表页
     */
    public function index()
    {
        $perms = Permission::join('permission_class', 'permissions.class_id', '=', 'permission_class.id')
                            ->select('permissions.*', 'permission_class.class_name')
                            ->get();
        $class = PermissionClass::get();
        return view('admin.main.permission.index', compact('perms','class'));
    }

    /**
     * @return  view    权限规则修改页
     */
    public function edit($id)
    {
        $perms  = Permission::find($id);
        $class = PermissionClass::get();
        return view('admin.main.permission.edit', compact('perms', 'class'));

    }

    public function update(Request $request, $id)
    {

    }

    /**
     * @param Request $request  获取Ajax传参
     */
    public function store(Request $request)
    {   dd($request->all());
        //JSON数据转为对象
        $req = json_decode($request->json);

        //查询新权限名称是否存在
        $res = Permission::where('display_name', '=', $req->display_name)
                         ->orWhere('name', '=', $req->name)
                         ->first();

        if (!$res) {
            //执行添加
            $perms = new Permission;

            $perms->name         = $req->name;
            $perms->display_name = $req->display_name;
            $perms->description  = $req->description;


            if ($perms->save()){
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
