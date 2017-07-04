@extends('home.layouts.layout')

@section('title','地址管理')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/personal.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/css/adress.css')}}"/>
@endsection

@section('main')
	<!-- 内容 -->
	    <!-- breadcrumbs start-->
	    <div class="breadcrumbs comWidth clearfix">
	        <ul>
	            <li><a href="javascript:">首页</a><span>&gt;</span></li>
	            <li><a href="javascript:">个人中心</a><span>&gt;</span></li>
	            <li><a href="javascript:">地址管理</a></li>
	        </ul>
	    </div>
	    <!-- breadcrumbs end-->

	    <!-- personal_center start-->
	    <div class="personal_center comWidth clearfix">

			@include('home.personal.left_memu')

	        <div class="personal_main fr">
	            <ul class="personal_tab_header clearfix">
					<li><a href="{{ url('home/personal')  }}" data-memu="7">个人信息</a></li>
	                <li class="on"><a href="{{ url('home/address')  }}" data-memu="8">地址管理</a></li>
	            </ul>

	            <!-- 地址管理 -->
	            <div class="personal_tab">
	                <div class="tab_paid">
	                    <div class="empty-box">
	                        <span class="icn-empty-address"></span>
	                        <a class="address_btn" href="{{ url('home/address/create')  }}">新增地址</a>
	                    </div>
	                </div>
	            </div>
	            <!-- 地址管理 -->
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
