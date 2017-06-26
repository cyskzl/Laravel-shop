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
//        $cook = $request->cookie();
//        dd($cook);
        return view('home.login');
    }

    public function doLogin(Request $request)
    {
        $email = $request->input('email');
        $pass = $request->input('pass');
        $checked = $request->input('check');
        if($checked){
            Cookie::quequ('youwei','wqeqw',3);
        }

    }
}
