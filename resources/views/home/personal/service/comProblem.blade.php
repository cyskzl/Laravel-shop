@extends('home.layouts.layout')

@section('title','常见问题')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/personal.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/css/comProblem.css')}}"/>
@endsection

@section('main')
	<!-- 内容 -->
	    <!-- breadcrumbs start-->
	    <div class="breadcrumbs comWidth">
	        <ul>
	            <li><a href="javascript:;">首页</a><span>&gt;</span></li>
	            <li><a href="javascript:;">个人中心</a><span>&gt;</span></li>
	            <li><a href="javascript:;">常见问题</a></li>
	        </ul>
	    </div>
	    <!-- breadcrumbs end-->

	    <!-- personal_center start-->
	    <div class="personal_center comWidth clearfix">

			@include('home.personal.left_memu')

	        <div class="personal_main fr">
	            <ul class="personal_tab_header clearfix">
	                <li style="border-left: none"><a href="{{ url('home/newest') }}" data-memu="13">最新消息</a></li>
	                <li class="on"><a href="{{ url('home/comproblem') }}" data-memu="14">常见问题</a></li>
	                <li><a href="{{ url('home/usermanual') }}" data-memu="15">用户手册</a></li>
	                <li><a href="{{ url('home/privacyclause') }}" data-memu="16">隐私条款</a></li>
	            </ul>

	            <!-- 常见问题 -->
	            <div class="personal_tab">
	                <div class="cs_board">
	                    <ul class="cs_board_list">
	                        <li>
	                            <p class="showContent">
	                                <a class="tit" href="javascript:;">注册会员</a>
	                                <span class="icon_to_right"></span>
	                            </p>
	                            <div class="item_content">
	                                <p>APP客户端：进入右下角“我的W concept” ，点击“马上注册”输入手机号码，根据提示进行相关操作即可注册成为会员。</p>
	                                <p>PC网页端：在商城首页的左上角，点击“注册”输入手机号码，根据提示进行相关操作即可注册成为会员。</p>
	                            </div>
	                        </li>
	                        <li>
	                            <p class="showContent">
	                                <a class="tit" href="javascript:;">用户登录</a>
	                                <span class="icon_to_right"></span>
	                            </p>
	                            <div class="item_content">
	                                <p>APP客户端：进入右下角“我的W concept” ，点击“马上注册”输入手机号码，根据提示进行相关操作即可注册成为会员。</p>
	                                <p>PC网页端：在商城首页的左上角，点击“注册”输入手机号码，根据提示进行相关操作即可注册成为会员。</p>
	                            </div>
	                        </li>
	                    </ul>
	                </div>
	            </div>
	            <!-- 常见问题 -->
	        </div>

	    </div>
	    <!-- personal_center end-->
@endsection

@section('shop')
	
@endsection
@section('js')
	<script src="{{asset('/templates/home/js/dynamic.js')}}"></script>
	<script src="{{asset('/templates/home/js/left_memu.js')}}"></script>
	<script>
        $(function(){
            $('.showContent').toggle(
                function(){
                    $(this).next().css({"display":"block"});
                    $(this).children('.icon_to_right').css({"transform":"rotate(90deg)"});
                },
                function(){
                    $(this).next().css({"display":"none"});
                    $(this).children('.icon_to_right').css({"transform":"rotate(0deg)"});
                }
            );
        });
	</script>
@endsection
