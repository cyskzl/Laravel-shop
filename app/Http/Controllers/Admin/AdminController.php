<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUser;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    /**
     * @return  view    后台首页
     */
    public function index(Request $request)
    {

        return view('admin.index');

    }

    /**
     * @return  view    后台首页主体信息
     */
    public function welcome()
    {
        return view('admin.main.welcome');
    }

    /**
     * @return  view    系统日志
     */
    public function SystemLog()
    {
        return view('admin.main.settings.systemlog');
    }
}
