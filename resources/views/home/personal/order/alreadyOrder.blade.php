@extends('home.layouts.layout')

@section('title','已付款订单')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/personal.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/css/order.css')}}"/>
@endsection



@section('main')
	<!-- 内容 -->
	    <!-- breadcrumbs start-->
	    <div class="breadcrumbs comWidth">
	        <ul>
	            <li><a href="javascript:;">首页</a><span>&gt;</span></li>
	            <li><a href="javascript:;">个人中心</a><span>&gt;</span></li>
	            <li><a href="javascript:;">已付款订单</a></li>
	        </ul>
	    </div>
	    <!-- breadcrumbs end-->
	    <!-- personal_center start-->
	    <div class="personal_center comWidth clearfix">

			@include('home.personal.left_memu')

	        <div class="personal_main fr">
	            <ul class="personal_tab_header clearfix">
	                <li><a href="{{ url('home/waitorder') }}"  data-memu="3">待付款订单</a></li>
	                <li class="on"><a href="{{ url('home/alreadyorder') }}" data-memu="4">已付款订单</a></li>
	                <li><a href="{{ url('home/cancelorder') }}" data-memu="5">已取消订单</a></li>
	                <li><a href="{{ url('home/refundorder') }}" data-memu="6">退款／退货订单</a></li>
	            </ul>

	            <!-- 已付款订单 -->
	            <div class="personal_tab">
	                <div class="tab_paid">
	                    <div class="empty-box">
	                        <span class="icn-empty-order"></span>
	                        <span>没有符合条件的订单，请尝试其他搜索条件。</span>
	                    </div>
	                </div>
	            </div>
	            <!-- 已付款订单 -->
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
