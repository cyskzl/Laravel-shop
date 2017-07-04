<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Redis;
use Symfony\Component\HttpFoundation\Cookie;


class UserController extends Controller
{
    public function login()
    {
        // dd(bcrypt('dasuan'));
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
            'username'=>'required',
            'password'=>'required | between:6,16',
        ],[
            'required'=>':attribute必须填写',
            'between'=>':attribute长度必须介于6和16之间',
        ],[
            'username'=>'用户名',
            'password'=>'密码'
        ]);


//        $user['login_name'] = $request->input('email');
//        $user['password'] = $request->input('password');
//        $is_check = boolval($request->input('is_check'));
//
//        $user = [
//            'login_name' => $request->get('email'),
//            'password' => $request->get('password')
//        ];

        $username = $request->input('username');

        $emailpattern = '/.*@.*/';

        $phonepattern =  '/^[1][34578]\d{9}$/' ;

        if (preg_match($emailpattern,$username) || preg_match($phonepattern,$username)){

            $user['login_name'] = $username;

            $user['password'] = $request->input('password');
            $is_check = boolval($request->input('is_check'));

            $user = [
                'login_name' => $request->get('email'),
                'password' => $request->get('password')
            ];
//        dd(\Auth::attempt($user));
            if(\Auth::attempt($user,$is_check)){
                return redirect('/home');

            }else {
                return back()->withInput()->with(['fail'=>'用户名或密码错误']);
            }

        }else{
            return back()->withInput()->with(['fail'=>'用户名不符']);
        }


    }


    public function logOut()
    {
        \Auth::logout();
        return redirect('home/login');
    }
}
