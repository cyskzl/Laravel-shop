@extends('home.layouts.layout')

@section('title','注册')

@section('style')
    <link rel="stylesheet" href="{{asset('/templates/home/css/registe.css')}}">
    {{--<script src="{{asset('/templates/home/js/registe.js')}}"></script>--}}
    <script src="{{asset('/templates/home/js/xuanxiangka.js')}}"></script>
@endsection


@section('main')

    <!--主体内容-->
    <div class="main clearfix">
        <!-- 左侧图片 -->
        <div class="main-img">
            <img src="{{asset('/templates/home/public/png/account_init.png')}}" alt="">
        </div>
        <!-- 右侧表单 -->
        <div class="main-form">
            <div class="registe-wray">
                <div class="reg-title">
                    注册会员
                </div>
            @if(session('fail'))
                {{session('fail')}}
            @endif
            <!-- 选项卡切换开始 -->
                <div class="box_hezi">
                    <ul class="menu">
                        <li class="li_one"><a href="{{url('home/register')}}">邮箱注册</a></li>
                        <li class="li_two"><a href="{{url('home/phone_register')}}">手机注册</a></li>
                    </ul>
                    <ul class="macn">
                        <li  class="li_theer" style="display:block;">
                            <form action="{{url('home/phone_register')}}" method="POST">
                                {{csrf_field()}}
                                <div class="reg-inner">
                                    <span style="color:mediumvioletred;">
										{{ $errors->first('tel') }}
									</span>
                                    <input type="text" name="tel" placeholder="请填写手机号码" id="phone">
                                    <div class="code clearfix">
                                        <input type="text" name="phone_code" placeholder="请填写图形验证码">
                                        <button id="phone_code" type="button" data-id="0">获取验证码</button>
                                        {{ $errors->first('phone_code') }}
                                    </div>
                                    <span style="color:mediumvioletred;">
										{{ $errors->first('password') }}
									</span>
                                    <input type="password" name="password" placeholder="设置密码" id="pass">
                                    <span style="color:mediumvioletred;">
										{{ $errors->first('repassword') }}
									</span>
                                    <input type="password" name="repassword" placeholder="确认密码" id="pass_again">
                                    <button class="btn-submit" type="submit" id="submit">立即注册</button>
                                </div>
                                <div class="clause clearfix">
                                    <input type="checkbox" id="check" name="check" >
                                    <span class="clause-font" >接受Wconcept隐私条款</span>
                                    <a href="" class="clause-font">去登陆</a>
                                    {{ $errors->first('check') }}
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
<!-- 错误弹窗 -->
@section('alert')
    <div class="tip">
        <img src="{{asset('/templates/home/public/png/icon_error.png')}}" alt="">
        <p id="text"></p>
        <span id="close">X</span>
    </div>
@endsection

@section('shop')
    
@endsection
@section('js')
    <script src="{{asset('/templates/home/js/dynamic.js')}}"></script>
    <script>
        // 验证码点击换图
        $('.validate_code').on('click', function () {
            $(this).attr('src', '/home/register/code?random=' + Math.random());
        });

        //输出ajax获取验证码返回的错误信息
//        function errinfo(obj,info) {
//            console.log(info);
//            obj.prev('p').remove();
//            obj.css('border-color','red').before('<p style="text-align: center;color: red">' + info +'</p>');
//            return false;
//        }


        //获取手机验证码
        $('#phone_code').on('click',function () {

            var phone = $('#phone').val();

            $('#phone').prev('p').remove();

            if (phone == ''){
                $('#phone').css('border-color','red').before('<p style="text-align: center;color: red">请填写手机号码</p>');
                return false;
            }


            var than = $(this);

            than.attr('data-id','1');


            than.attr("disabled", true);


            setTimeout("$('#phone_code').removeAttr('disabled')",1000);

//            console.log(than);


            var regex = /^[1][34578]\d{9}$/;

            var boot = regex.test(phone);

            $('#phone').prev('p').remove();

            if (!boot){

                $('#phone').css('border-color','red').before('<p style="text-align: center;color: red">手机号码不合法</p>');
                return false;
            }

            $.ajax({
                url:"/home/register/phonecode",
                type:"GET",
                data:{'phone':phone},
                success:function (data) {

                    data = JSON.parse(data);

                    console.log(data.error);

                    switch (data.error){
                        case 0:
                            settime(than);
                            break;
                        case 1:
                            $('#phone').css('border-color','red').before('<p style="text-align: center;color: red">手机号码不合法</p>');
                            return false;
                            break;
                        case 2:
                            $('#phone').css('border-color','red').before('<p style="text-align: center;color: red">手机号码已注册</p>');
                            return false;
                            break;
                        case 3:
                            than.html("重新发送");
                            break;
                        case 4:
                            $('#phone').css('border-color','red').before('<p style="text-align: center;color: red">请勿重复获取验证码</p>');
                            return false;
                            break;
                    }

                }
            });

        });


        //成功发送验证码后锁定获取按钮60秒。
        var countdown=60;

        function settime(obj) {
            if (countdown == 0) {
                obj.attr("disabled",false);
                obj.html("获取验证码");
                countdown = 60;
                return;
            } else {
                obj.attr("disabled", true);
                obj.html("重新发送(" + countdown + ")");
                countdown--;
            }

            setTimeout(function() {
                    settime(obj) }
                ,1000)
        }


        $("form").submit(function(e){
            var dataid = $('#phone_code').attr('data-id');
            if (dataid == '0'){
                $('#phone').css('border-color','red').before('<p style="text-align: center;color: red">请先获手机取验证码</p>');
                return false;
            }
        });

    </script>

@endsection
