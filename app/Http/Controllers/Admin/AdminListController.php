<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Permission;
use App\Role;

class AdminListController extends Controller
{
    /**
     * @return  view    管理员列表
     */
    public function index()
    {
        $admin = AdminUser::join('roles', 'roles.id', '=', 'admin_users.id')->get();
        dd($admin);
        return view('admin.main.administrator.index');
    }

    /**
     * @return  view    添加管理员
     */
    public function create()
    {
        return view('admin.main.administrator.add');
    }

    /**
     * @return  view    修改管理员
     */
    public function edit()
    {
        return view('admin.main.administrator.edit');
    }
}
