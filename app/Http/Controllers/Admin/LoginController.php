<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Auth;

class LoginController extends Controller
{

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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {

        $res = AdminUser::where('nickname', '=', $request->username)->first();
        if ($res) {
            // 验证登录
            if (Auth::attempt(['nickname' => $request->username, 'password' => $request->password])) {
                // 认证通过...
                session(['admin_user'=> $res]);
                return redirect('/admin');
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
        $request->session()->forget('admin_user');

    }
}
