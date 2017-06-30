<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Auth;


class LoginController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

 /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'loginout']);

    }

    /**
     * @return  view    登录视图
     */
    public function index()
    {
        return view('admin.login.index');
    }

    /**
     * 验证登录
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'nickname' => 'required|unique:admin_users|max:30',
            'password' => 'required',
        ]);

        $res = AdminUser::where('nickname', '=', $request->username)->first();
        if ($res) {
            // 验证登录
            if (Auth::guard('admin')->attempt(['nickname' => $request->username, 'password' => $request->password])) {
                // 认证通过...
                return redirect('/admin');
            }else {
                dd('认证失败');
            }
        } else {
            dd('不存在');
        }

    }

    /**
     * @param Request $request
     */
    public function loginout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');

    }
}
