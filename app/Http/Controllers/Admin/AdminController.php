<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\Goods;
use DB;
use Illuminate\Http\Request;

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
    public function welcome(Request $request)
    {
        //查询管理员总数量
        $admin_user = AdminUser::count();
        //查询会员总数量
        $user_count = DB::table('users_register')->count();
        $goods_count = Goods::count();
        return view('admin.main.welcome', compact('request','admin_user', 'user_count', 'goods_count'));
    }

    /**
     * @return  view    系统日志
     */
    public function SystemLog()
    {
        return view('admin.main.settings.systemlog');
    }
}
