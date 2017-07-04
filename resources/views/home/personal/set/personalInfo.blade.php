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
	                            <div class="head_portrait">
	                                <div class="head_portrait_img">
	                                    <img src="./uploads/personal.jpg" alt=""/>
	                                </div>
	                                <a class="ladda-button" href="javascript:;">上传头像</a>
	                            </div>
	                        </li>
	                        <li>
	                            <span>手机号码</span>13843838438
	                        </li>
	                        <li>
	                            <span>昵&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称</span>
	                            <p>13843838438</p>
	                            <a href="javascript:;">修改昵称</a>
	                        </li>
	                        <li>
	                            <span>修改密码</span>
	                            <p>＊＊＊＊＊＊＊＊</p>
	                            <a href="javascript:;">修改密码</a>
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

@endsection
