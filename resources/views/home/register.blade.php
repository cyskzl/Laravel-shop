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
						<li class="li_one"><a href="javascript:;">手机注册</a></li>
						<li class="li_two"><a href="javascript:;">邮箱注册</a></li>
					</ul>
					<ul class="macn">
						<li  class="li_theer" style="display: block;">
							<form action="{{url('home/phone_register')}}" method="POST">
								{{csrf_field()}}
								<div class="reg-inner">
									<input type="text" name="tel" placeholder="请填写手机号码" id="phone">
									<div class="code clearfix">
										<input type="text" name="phone_code" placeholder="请填写图形验证码">
										<span id="phone_code">发送验证码</span>
									</div>
									<input type="password" name="password" placeholder="设置密码" id="pass">
									<input type="password" name="repassword" placeholder="确认密码" id="pass_again">
									<input type="submit" id="submit" class="btn-submit" value="立即注册" >
								</div>
								<div class="clause clearfix">
									<input type="checkbox" id="check"  >
									<span class="clause-font" >接受Wconcept隐私条款</span>
									<a href="" class="clause-font">去登陆</a>
								</div>
							</form>
						</li>
						<li class="li_forn">
							<form action="{{url('home/email_register')}}" method="post">
								{{csrf_field()}}
								<div class="reg-inner">
									<input type="text" name="email" placeholder="请填写邮箱" id="email">
									<div class="code clearfix">
										<input type="text" name="validate_code" placeholder="请填写图形验证码">
										<span>
                            				<img src="{{url('home/register/code')}}" class="validate_code">
                        				</span>

									</div>
									<input type="password" name="password" placeholder="设置密码" id="pass">
									<input type="password" name="repassword" placeholder="确认密码" id="pass_again">
									<input type="submit" id="submit" class="btn-submit" value="立即注册" >
								</div>
								<div class="clause clearfix">
									<input type="checkbox" id="check"  >
									<span class="clause-font" >接受Wconcept隐私条款</span>
									<a href="" class="clause-font">去登陆</a>
								</div>
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
	<div class="cart">
		<a href="">
			<i></i>
			<p>购物车</p>
			<b>0</b>
		</a>
	</div>
	<!--回到顶部-->
	<div id="scrolltop">
		<img src="{{asset('/templates/home/uploads/go_to_top.png')}}" alt=""  >
	</div>
@endsection
@section('js')
	<script>
        // 验证码点击换图
        $('.validate_code').on('click', function () {
            $(this).attr('src', '/home/register/code?random=' + Math.random());
        });
	</script>
	<script src="{{asset('/templates/home/js/dynamic.js')}}"></script>
@endsection