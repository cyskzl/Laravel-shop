
@extends('home.layouts.layout')

@section('title','登录')

@section('style')
    <link rel="stylesheet" href="{{asset('/templates/home/css/registe.css')}}">

@endsection

@section('main')
    <div class="main clearfix">
        <!-- 左侧图片 -->
        <div class="main-img">
            <img src="{{asset('/templates/home/public/png/account_init.png')}}" alt="">
        </div>
        <!-- 右侧表单 -->
        <div class="main-form">
            <div class="registe-wray">
                <div class="reg-title">
                    会员登陆
                </div>
                @if(session('fail'))
                    <span style="color:mediumvioletred;">
                        {{session('fail')}}
                    </span>
                @endif
                <form action="{{url('home/doLogin')}}" method="post">
                    {{csrf_field()}}
                    <div class="reg-inner">
                        <input type="email" placeholder="请填写邮箱" id="email" name="email" value="{{old('email')}}">
                        <span style="color:mediumvioletred;">
                            {{ $errors->first('email') }}
                        </span>
                        <input type="password" placeholder="登陆密码" id="pass" name="password">
                        <span style="color:mediumvioletred;">
                            {{$errors->first('password') }}
                        </span>
                        <input type="submit" id="submit" class="btn-submit" value="登录" >
                    </div>
                    <div class="clause clearfix">
                        <input type="checkbox" id="check" value="1" name="is_check">
                        <span class="clause-font" >下次免登录</span>
                        <a href="" class="clause-font">忘记密码</a>
                        <a href="javascript:;" class="clause-font">|</a>
                        <a href="{{url('home/register')}}" class="clause-font">快速注册</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<!--主体内容-->

<!-- 错误弹窗 -->
@section('alert')
    <div class="tip">
        <img src="{{asset('/templates/home/public/png/icon_error.png')}}" alt="">
        <p id="text"></p>
        <span id="close">X</span>
    </div>
@endsection

@section('js')
    <script>
        // 判断浏览器中是否存有登录的Cookie
//        var cook = $.cookie('youwei');
//        if(cook){
//
//        }
//        var cook = $.cookie('youwei');
//        console.log(cook);
//        $('form').on('submit',function (){
//            var flag = $('#check').is(':checked');
//            // 判断七天免登录是否勾选
//            if (flag) {
//                var email = $('#email').val();
//                var password = $('#pass').val();
//                // 将登录信息存入Cookie，并保存7天
//                $.cookie('youwei', JSON.stringify({"email":email,"password":password}),{expires:7});
//            }
//        });
    </script>
@endsection
