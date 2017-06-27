<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AdminPermission;

class PermissionController extends Controller
{
    //权限列表页
    public function index()
    {
        $permission = AdminPermission::paginate(10);

        return view('admin.main.permission.index', compact('permission'));
    }

    //权限创建页
    public function create()
    {
        return view('admin.main.permission.add');
    }

    //创建新权限
    public function store(Request $request)
    {
        //json数据转为对象
        $json  = json_decode($request->json);

        $perms = new AdminPermission;
        $perms->name = $json->name;
        $perms->description = $json->description;

        if ($perms->save()) {
            $perms['success'] = 1;
            return json_encode($perms);
        }
    }

    //权限修改页
    public function edit()
    {
        return view('admin.main.permission.edit');
    }
}
