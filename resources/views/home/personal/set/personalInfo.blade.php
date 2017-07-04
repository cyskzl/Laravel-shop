@extends('home.layouts.layout')

@section('title','个人中心')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/personal.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/css/section.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/css/personalInfo.css')}}"/>
@endsection

@section('main')
	<!--中部-->
	    <!-- breadcrumbs start-->
	    <div class="breadcrumbs comWidth">
	        <ul>
	            <li><a href="{{ url('home/')  }}">首页</a><span>&gt;</span></li>
	            <li><a href="{{ url('home/personal')  }}">个人中心</a></li>
	        </ul>
	    </div>
	    <!-- breadcrumbs end-->

	    <!-- personal_center start-->
	    <div class="personal_center comWidth clearfix">

			@include('home.personal.left_memu')

	        <div class="personal_main fr">
	            <ul class="personal_tab_header clearfix">
	                <li class="on" style="border-left: none"><a href="{{ url('home/personal')  }}" data-memu="7">个人信息</a></li>
	                <li><a href="{{ url('home/address')  }}" data-memu="8">地址管理</a></li>
	            </ul>

	            <!-- 个人信息 -->
	            <div class="personal_tab">
	                <div class="tab_personal">
	                    <ul class="personal_infomation">
	                        <li>
	                            <div class="head_portrait ">
	                                <div class="head_portrait_img">
	                                    <img src="{{ asset(''.$user->avatar.'') }}" alt=""/>
	                                </div>
	                                <a class="ladda-button" href="javascript:;">上传头像</a>
	                            </div>

								<div class="site-demo-upload">
									  <img id="LAY_demo_upload" src="http://res.layui.com/images/fly/fly.jpg">
									  <div class="site-demo-upbar">
									    <div class="layui-box layui-upload-button"><form target="layui-upload-iframe" method="get" key="set-mine" enctype="multipart/form-data" action="/test/upload.json"><input type="file" name="file" class="layui-upload-file" id="test"></form><span class="layui-upload-icon"><i class="layui-icon"></i>上传图片</span></div>
									  </div>
									</div>
	                        </li>
	                        <li>
	                            <span>手机号码</span>{{ $user->tel }}
	                        </li>
							<li>
							   <span>真实姓名</span>
							   <p>{{ $user->realname  }}</p>
							   <a href="#editrealname" class="edit_realname">修改真实姓名</a>
							   <div id="editrealname" style="display:none;">
								   <!-- <div class="change_form_bg"></div> -->
								   <div class="change_form">
									   <div class="close">
										   <img src="{{ asset('templates/home/images/closeItems.png') }}">
									   </div>
									   <div class="title">修改真实姓名</div>
									   <form action="" method="post" autocomplete="off" id="form-pass" class="scaffold-form" enctype="multipart/form-data">
										   <input name="_token" type="hidden" value="{{ csrf_token() }}">

										   <div class="form_content">
											   <p>
												   <label>真实姓名</label>
												   <input type="text" id="realname" name="realname" class="input-password">
											   </p>

										   </div>

									   </form>
									   <p class="btn_block">
										   <input type="button" id="submit_realname" class="btn_submit " value="保存">
									   </p>

								   </div>
							   </div>
						   </li>
	                        <li>
	                            <span>昵&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称</span>
	                            <p>{{ $user->nickname  }}</p>
	                            <a href="#editname" class="edit_name">修改昵称</a>
								<div id="editname" style="display:none;">
									<!-- <div class="change_form_bg"></div> -->
									<div class="change_form">
				                        <div class="close">
											<img src="{{ asset('templates/home/images/closeItems.png') }}">
										</div>
				                        <div class="title">修改昵称</div>
				                        <form action="" method="post" autocomplete="off" id="form-pass" class="scaffold-form" enctype="multipart/form-data">
				                            <input name="_token" type="hidden" value="{{ csrf_token() }}">

				                            <div class="form_content">
				                                <p>
				                                    <label>昵称</label>
				                                    <input type="text" id="nickname" name="nickname" class="input-password">
				                                </p>

				                            </div>

				                        </form>
				                        <p class="btn_block">
				                            <input type="button" id="submit_name" class="btn_submit " value="保存">
				                        </p>

				                    </div>
								</div>
	                        </li>
	                        <li>
	                            <span>修改密码</span>
	                            <p>＊＊＊＊＊＊＊＊</p>
	                            <a href="#editpassword" id="modaltrigger" class="edit_pass">修改密码</a>
								<div id="editpassword" style="display:none;">
									<!-- <div class="change_form_bg"></div> -->
									<div class="change_form">
				                        <div class="close">
											<img src="{{ asset('templates/home/images/closeItems.png') }}">
										</div>
				                        <div class="title">修改密码</div>
				                        <form action="" method="post" autocomplete="off" id="form-pass" class="scaffold-form" enctype="multipart/form-data">
				                            <input name="_token" type="hidden" value="{{ csrf_token() }}">

				                            <div class="form_content">
				                                <p>
				                                    <label>填写原密码</label>
				                                    <input type="password" id="current_password" name="current_password" class="input-password">
				                                </p>
				                                <p>
				                                    <label>输入新密码</label>
				                                    <input type="password" id="password" name="password" class="input-password">
				                                </p>
				                                <p>
				                                    <label>确认新密码</label>
				                                    <input type="password" id="confirmation" name="confirmation" class="input-password">
				                                </p>
				                            </div>

				                        </form>
				                        <p class="btn_block">
				                            <input type="button" id="submit" class="btn_submit " value="保存">
				                        </p>

				                    </div>
								</div>
	                        </li>
							<li>
	                            <span>注册时间</span>{{ $user->created_at }}
	                        </li>
	                    </ul>
	                </div>
	            </div>

	            <!-- 个人信息 -->
	        </div>

	    </div>
	    <!-- personal_center end-->
	</main>
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
	<script src="{{asset('/templates/home/js/dynamic.js')}}"></script>
	<script src="{{asset('/templates/home/js/left_memu.js')}}"></script>
	<!-- <script src="{{asset('/templates/home/layui/layui.js')}}"></script> -->

	<script type="text/javascript">
		layui.use(['layer', 'form'], function(){
		  var layer = layui.layer,form = layui.form();

		});

		//修改密码
		$(function(){
		  $('.edit_pass').leanModal({ top: 110, overlay: 0.45, closeButton: ".close" });
		});

		var token = $("input[name='_token']").val();
		$('#submit').on('click',function(){

			var current_password = $("input[name='current_password']");
			var password = $("input[name='password']");
			var confirmation = $("input[name='confirmation']");

			//当前密码
            if (current_password.val().length == 0) {
				layer.alert('当前密码不能为空！', {icon: 7});
				return false;

			}

			//新密码
			if (password.val() == 0) {
				layer.alert('新密码不能为空！', {icon: 7});
				return false;
			}

			if (password.val().length < 6) {

				layer.alert('密码至少需要6个以上的字符!', {icon: 7});
				return false;
			}

			//确认密码
			if (confirmation.val() == 0) {
				layer.alert('请输入确认密码！', {icon: 7});
				return false;
			}

			//判断新密码与确认密码
			if ( confirmation.val() != password.val()) {
				layer.alert('两次输入的密码不一致！', {icon: 7});
                // confirmation.focus();
				return false;
			}

			//执行Ajax认证请求
			$.ajax({
				url:"{{ url('home/personal/editpass/'.Auth::user()->user_id) }}",
				type:'post',
				datatype:'json',
				data:{
					'current_pass':current_password.val(),
					'confirmation':confirmation.val(),
					'newpassword':password.val(),
					'_token':token
				},
				success:function(data){

					data = JSON.parse(data);
					if (data.success == 1) {
						layer.alert(data.info, {icon: 1});

						location.reload();
					} else {
						layer.alert(data.info, {icon: 7});
						return false;
					}
				}
			});

		return false;

		});


		//修改昵称
		$(function(){
		  $('.edit_name').leanModal({ top: 110, overlay: 0.45, closeButton: ".close" });
		});

		$('#submit_name').on('click', function(){

			var nickname = $("input[name='nickname']");

            if (nickname.val().length == 0) {

				layer.alert('昵称还未填写！', {icon: 7});
				return false;
			}

			var url = "{{ url('home/personal/editname/'.Auth::user()->user_id) }}";
			var data = userAjax(url,nickname.val());

			console.log(data);
			if (data.success == 1) {
				layer.alert(data.info, {icon: 1});

				location.reload();
			} else {
				layer.alert(data.info, {icon: 7});
				return false;
			}

			return false;
		});


		//修改真实姓名
		$(function(){
		  $('.edit_realname').leanModal({ top: 110, overlay: 0.45, closeButton: ".close" });
		});

		$('#submit_realname').on('click', function(){

			var realname = $("input[name='realname']");

            if (realname.val().length == 0) {

				layer.alert('真实姓名还未填写！', {icon: 7});
				return false;
			}
			// console.log( JSON.stringify( realname.val() ) );
			var url = "{{ url('home/personal/editrealname/'.Auth::user()->user_id) }}";
			var data = userAjax(url,realname.val());

			// console.log(data);
			if (data.success == 1) {
				layer.alert(data.info, {icon: 1});

				location.reload();
			} else {
				layer.alert(data.info, {icon: 7});
				return false;
			}

			return false;
		});

		function userAjax(url,data){
			var res = '';
			$.ajax({
				url:url,
				type:'post',
				datatype:'json',
				data:{
					'data':data,
					'_token':token
				},
				async: false,
				success:function(result){
					res = JSON.parse(result);
				}
			});

			return res;
		}



	layui.use('upload', function(){

		  layui.upload({
		    url: '/test/upload.json'
		    ,elem: '#avater' //指定原始元素，默认直接查找class="layui-upload-file"
		    ,method: 'get' //上传接口的http类型
		    ,success: function(res){
		      LAY_demo_upload.src = res.url;
		    }
		  });
	});

	</script>

@endsection
