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
				<!-- 选项卡切换开始 -->
				<div class="box_hezi">
					<ul class="menu">
						<li class="li_one"><a href="{{url('home/register')}}">邮箱注册</a></li>
						<li class="li_two"><a href="{{url('home/phone_register')}}">手机注册</a></li>
					</ul>
					<ul class="macn">
						<li  class="li_theer" style="display:block;">
							<form action="{{url('home/email_register')}}" method="post">
								{{csrf_field()}}
								<div class="reg-inner">
									<span style="color:mediumvioletred;">
										{{ $errors->first('email') }}
									</span>
									<input type="text" id="email" name="email" placeholder="请填写邮箱" id="email" value="{{old('email')}}"><span style="color:#C73F49;"></span>
									<div class="code clearfix">

										<input type="text" name="validate_code" placeholder="请填写图形验证码">
										<span>
                            				<img src="{{url('home/register/code')}}" class="validate_code">
                        				</span>
										{{ $errors->first('validate_code') }}
										@if(session('fail'))
											{{session('fail')}}
										@endif
									</div>
									<span style="color:mediumvioletred;">
										{{ $errors->first('password') }}
									</span>
									<input type="password" name="password" placeholder="设置密码" id="pass" ><span style="color:#C73F49;"></span>
									<span style="color:mediumvioletred;">
										{{ $errors->first('repassword') }}
									</span>
									<input type="password" name="repassword" placeholder="确认密码" id="pass_again"><span style="color:#C73F49;"></span>
									<input type="submit" id="submit" class="btn-submit" value="立即注册" >
								</div>
								<div class="clause clearfix">
									<input type="checkbox" id="check" name="check" >
									<span class="clause-font" >接受Wconcept隐私条款</span>
									<a href="" class="clause-font">去登陆</a>
								</div><span style="color:#C73F49;"></span>
								<span style="color:mediumvioletred;">
									{{ $errors->first('check') }}
								</span>
							</form>
						</li>
					</ul>
				</div>
				<!-- 选项卡结束 -->
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

        // 验证邮箱是否注册
        $('#email').blur(function(){
            var email = $(this).val();
            var that = $(this);
//            console.log(email);return false;
            // 保存一开始输入的邮箱
            var origin = that.data('u');
            if(origin != email){
//                origin = '';
                $.ajax({
                    type: "POST",
                    url: './register/validate',
                    dataType: 'json',
                    cache: false,
                    data: {'email': email,'_token': "{{csrf_token()}}"},
                    success: function(data) {
//                        console.log(data);return false;
                        that.data('u',email);
                        if (data == 1) {
                            //先把input后面的所有span.tip标签删除
                            var text = 'Tip:该邮箱已注册';
                            $('#alert').show("fast",function(){
                                $('#text').text(text);
                            });
                            return false;
                        }
                        return true;
                    }
                });
            }

        });

        var inputs = $('form').find('input');
        var pass = $('input[name=password]');
        //        console.log(pass);
        for(var i=0;i<inputs.length;i++)
        {
            inputs[i].onfocus = function () {
                this.nextSibling.innerHTML = '';
                this.parentNode.nextSibling.innerHTML = '';
            }
            inputs[i].onblur = function () {
                this.nextSibling.innerHTML = '';

                var iname = this.name;
                // 检测输入框为空值
                if (this.value == '') {
                    if(iname == 'email'){
                        this.nextSibling.innerHTML = '请输入邮箱';
                    }
                    if(iname == 'password'){
                        this.nextSibling.innerHTML = '请输入密码';
                    }
                    if(iname == 'repassword'){
                        this.nextSibling.innerHTML = '请再次输入密码';
                    }
                    if(iname == 'validate_code'){
                        this.parentNode.nextSibling.innerHTML = '请输入验证码';
                    }
                } else {

                    regPattern.checkPattern(this);
                }

            }

        }
        var regPattern = {

            email_pattern: [
                /^[1-9a-zA-Z_][0-9a-zA-Z_-]{1,}@\w+\.\w{2,}$/
            ],

            email_val: [
                '请输入正确的邮箱格式'
            ],

            password_pattern: [
                /^\w{6,}$/
            ],
            password_val: [
                '请至少输入6位的密码'
            ],
            checkPattern: function (input) {

                var Val = input.value;

                for (var i = 0; i < (this[input.name + '_pattern']).length; i++) {
//                    console.log(this[input.name + '_pattern'][i]);
                    // break;
                    var pattern = this[input.name + '_pattern'][i];
                    var res = Val.match(pattern);
                    if (res == null) {
                        // input.nextSibling.innerHTML = this[input.name+'_val'][i];
                        $(input).next().css({color: 'red'}).html(this[input.name + '_val'][i]);
                        break;
                    }
                }
            }
        }
        $('input[name=repassword]').blur(function () {
            if((this.value)!= pass.val()){
                this.nextSibling.innerHTML = '请再次输入相同的密码';
            }
        });

        $('input[name=repassword]').focus(function () {
            this.nextSibling.innerHTML = '';
        });


        // 关闭弹出层
        $('#close').click(function(){
            $('#alert').hide();
        });
	</script>
@endsection
