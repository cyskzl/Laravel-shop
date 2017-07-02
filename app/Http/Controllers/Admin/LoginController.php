<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Auth;
use session;

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
//        dd($request->all());
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ], [
            'required' => ':attribute必须填写',
        ], [
            'username' => '管理员名称',
            'password' => '密码'
    ]);

        $res = AdminUser::where('nickname', '=', $request->username)->first();
        if ($res) {
            if ($res->status == 1) {
                // 验证登录
                if (Auth::guard('admin')->attempt(['nickname' => $request->username, 'password' => $request->password])) {
                    // 认证通过...
                    $num = $res->login_num + 1;
                    //把上次登录时间存入session
                    $request->session()->put('last_login_ip', $res->last_login_ip);
                    $request->session()->put('last_login_time', $res->last_login_time);
                    $request->session()->put('login_num', $num);

                    //更新上次登录时间
                    $res->update([
                        'last_login_time' => date('Y-m-d H:i:s'),
                        'last_login_ip'   => $request->getClientIp(),
                        'login_num'       => $num,
                    ]);

                    return redirect('/admin');

                } else {
                    return back()->withInput()->with(['fail'=>'密码错误！']);
                }

            } else {
                return back()->withInput()->with(['fail'=>'该管理员已被禁止登录！']);
            }

        } else {
            return back()->withInput()->with(['fail'=>'该管理员不存在！']);
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
