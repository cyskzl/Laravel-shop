@extends('home.layouts.layout')

@section('title','最新消息')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/personal.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/css/newest.css')}}"/>
@endsection

@section('main')
	<!-- 内容 -->
	    <!-- breadcrumbs start-->
	    <div class="breadcrumbs comWidth">
	        <ul>
	            <li><a href="javascript:;">首页</a><span>&gt;</span></li>
	            <li><a href="javascript:;">个人中心</a><span>&gt;</span></li>
	            <li><a href="javascript:;">最新消息</a></li>
	        </ul>
	    </div>
	    <!-- breadcrumbs end-->

	    <!-- personal_center start-->
	    <div class="personal_center comWidth clearfix">

			@include('home.personal.left_memu')

	        <div class="personal_main fr">
	            <ul class="personal_tab_header clearfix">
					<li class="on" style="border-left: none"><a href="{{ url('home/newest') }}" data-memu="13">最新消息</a></li>
	                <li><a href="{{ url('home/comproblem') }}" data-memu="14">常见问题</a></li>
	                <li><a href="{{ url('home/usermanual') }}" data-memu="15">用户手册</a></li>
	                <li><a href="{{ url('home/privacyclause') }}" data-memu="16">隐私条款</a></li>
	            </ul>

	            <!-- 最新消息 -->
	            <div class="personal_tab">
	                <div class="tab_paid">
	                    <div class="empty-box">
	                        <span class="icn-empty-order"></span>
	                        <span>暂无数据</span>
	                    </div>
	                </div>
	            </div>
	            <!-- 最新消息 -->
	        </div>

	    </div>
	    <!-- personal_center end-->
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
