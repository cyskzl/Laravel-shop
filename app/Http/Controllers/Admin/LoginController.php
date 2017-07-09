<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tool\Validate\ValidateCode;
use App\Models\AdminUser;
use Auth;
use session;
use DB;

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
     * 验证码
     *
     * @param Request $request
     */
    public function createCode(Request $request)
    {
        $validateCode = new ValidateCode();
        $request->session()->set('validate_code', $validateCode->getCode());
//        dd($request->session()->get('validate_code'));
        return $validateCode->doimg();
    }

    /**
     * @return  view    登录视图
     */
    public function index()
    {
        if ( Auth::guard('admin')->check() ) {
            return redirect('/admin');
        }

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
            'username'      => 'required',
            'password'      => 'required',
            'validate_code' => 'required',
        ], [
            'required'      => ':attribute必须填写',
        ], [
            'username'      => '管理员名称',
            'password'      => '密码',
            'validate_code' => '验证码'
        ]);

        //校验验证码
        $validate_code = $request->session()->get('validate_code');

        if ( $request->validate_code != $validate_code ) {

            return back()->withInput()->with(['fail'=>'验证码错误！']);
        }

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

                    //写入登录日志
                    $log = DB::table('admin_log')->insert([

                        'nickname'   => $res->nickname,
                        'user_id'    => $res->id,
                        'status'     => $res->status,
                        'content'    => '登录成功',
                        'login_ip'   => $request->getClientIp(),
                        'login_time' => date('Y-m-d H:i:s'),
                    ]);
                    return redirect('/admin');
                }

                return back()->withInput()->with(['fail'=>'密码错误！']);
            }

            //写入登录日志
            $log = DB::table('admin_log')->insert([

                'nickname'   => $res->nickname,
                'user_id'    => $res->id,
                'status'     => $res->status,
                'content'    => '登录失败',
                'login_ip'   => $request->getClientIp(),
                'login_time' => date('Y-m-d H:i:s'),
            ]);

            return back()->withInput()->with(['fail'=>'该管理员已被禁止登录！']);
        }

        return back()->withInput()->with(['fail'=>'该管理员不存在！']);

    }

    /**
     * @param Request $request
     */
    public function loginout(Request $request)
    {
        if ( Auth::guard('admin')->check() ) {

            Auth::guard('admin')->logout();
            return redirect('/admin/login');
        }

        return back()->withInput()->with(['fail'=>'您没有登录！']);

    }
}
