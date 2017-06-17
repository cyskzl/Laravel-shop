<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    /**
     * @return  view    后台首页
     */
    public function index()
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
