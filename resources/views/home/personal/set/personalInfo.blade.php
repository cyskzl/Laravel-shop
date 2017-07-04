@extends('home.layouts.layout')

@section('title','个人中心')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/personal.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/css/section.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/css/personalInfo.css')}}"/>
	<style media="screen">
	.personal_infomation .site-demo-upload span {
		width: 100%;
		text-align: left;
		padding-right: 0px;
	}


	</style>
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
								<div class="site-demo-upload">
								  <img id="LAY_demo_upload" src="{{ asset(''.$user->avatar.'') }}">
								  <div class="site-demo-upbar">
								    <input type="file" name="file" class="layui-upload-file" id="avatar">
								  </div>
								</div>
	                        </li>
	                        <li>
	                            <span>手机号码</span>{{ $user->tel }}
	                        </li>
							<li>
							   <span>真实姓名</span>
							   <p>{{ $user->realname or '未填写' }}</p>
							   <a href="#edit_realname" class="edit_realname">修改真实姓名</a>
							   <div id="edit_realname" style="display:none;">
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
	                            <p>{{ $user->nickname or $user->tel }}</p>
	                            <a href="#edit_name" class="edit_name">修改昵称</a>
								<div id="edit_name" style="display:none;">
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
							   <span>性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别</span>
							   <p>
								   @if ($user->sex == '1')
								   		男
									@elseif ($user->sex == '2')
										女
									@elseif ($user->sex == '3')
										保密
									@else
										未知
									@endif
							   </p>
							   <a href="#edit_sex" class="edit_sex">修改性别</a>
							   <div id="edit_sex" style="display:none;">
								   <!-- <div class="change_form_bg"></div> -->
								   <div class="change_form">
									   <div class="close">
										   <img src="{{ asset('templates/home/images/closeItems.png') }}">
									   </div>
									   <div class="title">修改性别</div>
									   <form action="" method="post" autocomplete="off" id="form-pass" class="scaffold-form layui-form" enctype="multipart/form-data">
										   <input name="_token" type="hidden" value="{{ csrf_token() }}">
											   <div class="layui-form-item">
												    <label class="layui-form-label">性别</label>
												    <div class="layui-input-block">
												      <input type="radio" name="sex" value="1" title="男" {{ $user->sex == '1' ? 'checked' : '' }}>
												      <input type="radio" name="sex" value="2" title="女" {{ $user->sex == '2' ? 'checked' : '' }}>
												      <input type="radio" name="sex" value="3" title="保密" {{ $user->sex == '3' ? 'checked' : '' }}>
												    </div>
												</div>
									   </form>
									   <p class="btn_block">
										   <input type="button" id="submit_sex" class="btn_submit " value="保存">
									   </p>

								   </div>
							   </div>
						   </li>

						   	<li>
							   	<span>生&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日</span>
								<p>{{ $user->birthday }}</p>
							   	<a href="#edit_birthday" id="modaltrigger" class="edit_birthday">修改生日</a>
							   	<div id="edit_birthday" style="display:none;">
							   		<!-- <div class="change_form_bg"></div> -->
							   		<div class="change_form">
							   			<div class="close">
							   				<img src="{{ asset('templates/home/images/closeItems.png') }}">
							   			</div>
							   			<div class="title">修改生日</div>
							   			<form action="" method="post" autocomplete="off" id="form-pass" class="scaffold-form" enctype="multipart/form-data">
							   				<input name="_token" type="hidden" value="{{ csrf_token() }}">

											<div class="form_content">
													<label class="layui-form-label">生&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日</label>
												<div class="layui-inline">
													<input name="birthday" class="layui-input" placeholder="{{ $user->birthday }}" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD'})" value="{{ $user->birthday }}">

											</div>
											</div>
							   			</form>
							   			<div class="btn_block">
							   				<input type="button" id="submit_birthday" class="btn_submit " value="保存">
							   			</div>

							   		</div>
							   	</div>
						    </li>

	                        <li>
	                            <span>修改密码</span>
	                            <p>＊＊＊＊＊＊＊＊</p>
	                            <a href="#edit_password" id="modaltrigger" class="edit_pass">修改密码</a>
								<div id="edit_password" style="display:none;">
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
				url:"{{ url('home/personal/editPass/'.Auth::user()->user_id) }}",
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

			var url = "{{ url('home/personal/editName/'.Auth::user()->user_id) }}";
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
			var url = "{{ url('home/personal/editRealname/'.Auth::user()->user_id) }}";
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


		//修改性别
		$(function(){
			$('.edit_sex').leanModal({ top: 110, overlay: 0.45, closeButton: ".close" });
		});

		$('#submit_sex').on('click', function(){

			var sex = $("input[name='sex']:checked").val();

			var url = "{{ url('home/personal/editSex/'.Auth::user()->user_id) }}";

			var data = userAjax(url,sex);

			if (data.success == 1) {
				layer.alert(data.info, {icon: 1});

				location.reload();
			} else {
				layer.alert(data.info, {icon: 7});
				return false;
			}

		});


		//修改生日
		$(function(){
			$('.edit_birthday').leanModal({ top: 110, overlay: 0.45, closeButton: ".close" });
		});

		$('#submit_birthday').on('click', function(){

			var birthday = $("input[name='birthday']");
			if (birthday.val().length == 0) {
				layer.alert('日期不能为空！', {icon: 7});
				return false;
			}

			var url = "{{ url('home/personal/editBirthday/'.Auth::user()->user_id) }}";
			var data = userAjax(url,birthday.val());

			if (data.success == 1) {
				layer.alert(data.info, {icon: 1});

				location.reload();
			} else {
				layer.alert(data.info, {icon: 7});
				return false;
			}

		});


		//封装Ajax
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

		layui.use('laydate', function(){
			var laydate = layui.laydate;

			var start = {
				min: laydate.now()
				,max: '2099-06-16'
				,istoday: false
				,choose: function(datas){
				  end.min = datas; //开始日选好后，重置结束日的最小日期
				  end.start = datas //将结束日的初始值设定为开始日

				}
			};

	  	});

		//图片上传
		layui.use('upload', function(){

			  layui.upload({
				url: "{{ url('home/personal/editavatar/'.Auth::user()->user_id) }}",
				ext: 'jpg|png|gif',
				elem: '#avatar', //指定原始元素，默认直接查找class="layui-upload-file"
				method: 'post', //上传接口的http类型
				before: function(input){
				  var data = {'_token':token};
				  extra_data(input,data);

				},
				success: function(res){

					if (res.success == 1) {
						LAY_demo_upload.src = res.url;
						layer.msg(res.info);

					} else {

						layer.msg(res.info);
					}


				}
			  });
		});

	//图片上传自定义参数封装
	function extra_data(input,data){
		var item=[];
		$.each(data,function(k,v){
			item.push('<input type="hidden" name="'+k+'" value="'+v+'">');
		})
		$(input).after(item.join(''));
	}
	</script>

@endsection
