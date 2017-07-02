<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUser;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\Auth;
use DB;

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
        $admin_user   = AdminUser::count();
        //查询会员总数量
        $user         = DB::table('users_register')->count();

        //查询今天新管理员总数sql语句
        $today_sql    = 'select count(*) from admin_users where to_days(created_at) = to_days(now())';
        $today_admin  = DB::select($today_sql);

        //查询昨天新管理员总数
        $admin_yeste_sql    = 'select count(*) from admin_users where to_days( now( ) ) - to_days(created_at) <= 1';
        $yeste_admin  = DB::select($admin_yeste_sql);


        //查询今天新注册会员总数sql语句
        $user_today_sql    = 'select count(*) from users_register where to_days(created_at) = to_days(now())';
        $today_user  = DB::select($user_today_sql);

        //查询昨天新注册会员总数
        $user_yeste_sql    = 'select count(*) from users_register where to_days( now( ) ) - to_days(created_at) <= 1';
        $yeste_user  = DB::select($user_yeste_sql);

        // foreach ($today_admin as  $value) {
        //     var_dump($value);
        // }
        // dd($today_admin[0],$yeste_admin);
        return view('admin.main.welcome', compact(
            'request',
            'admin_user', 'today_admin', 'yeste_admin',
            'user', 'today_user', 'yeste_user'
        ));
    }

    /**
     * @return  view    系统日志
     */
    public function SystemLog()
    {
        return view('admin.main.settings.systemlog');
    }
}
