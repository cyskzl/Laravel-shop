<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Cookie;


class UserController extends Controller
{
    public function login(Request $request)
    {
        return view('home.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 登录限制
     */
    public function doLogin(Request $request)
    {
        $this->validate($request,[
            'email'=>'required | email',
            'password'=>'required | between:6,16',
        ],[
            'required'=>':attribute必须填写',
            'email'=>':attribute格式不正确',
            'between'=>':attribute长度必须介于6和16之间',
        ],[
            'email'=>'邮箱',
            'password'=>'密码'
        ]);

        $user['login_name'] = $request->input('email');
        $user['password'] = $request->input('password');
        $is_check = boolval($request->input('is_check'));
        if(\Auth::attempt($user, $is_check)){
            return redirect('/home');
        }else {
            return back()->withInput()->with(['fail'=>'用户名或密码错误']);
        }
    }


    public function logOut()
    {
        \Auth::logout();
        return redirect('/home/login');
    }
}
