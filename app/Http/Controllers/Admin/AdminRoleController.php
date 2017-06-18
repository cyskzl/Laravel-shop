<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminRoleController extends Controller
{
    /**
     * @return  view    角色列表
     */
    public function index()
    {
        return view('admin.main.adminrole.index');
    }

    /**
     * @return  view    添加角色
     */
    public function create()
    {
        return view('admin.main.adminrole.add');
    }

    /**
     * @return  view    角色修改
     */
    public function edit()
    {
        return view('admin.main.adminrole.edit');
    }


}
