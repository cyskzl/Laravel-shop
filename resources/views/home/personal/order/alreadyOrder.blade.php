@extends('home.layouts.layout')

@section('title','已付款订单')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/personal.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/css/order.css')}}"/>
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

	        <div class="personal_left fl">
	            <dl>
	                <dt class="personal_info"><a href="javascript:;"><img src="{{asset('/templates/home/uploads/personal.jpg')}}" alt=""/></a></dt>
	                <dd class="phone">13843838438</dd>

	                <dt class="level1">交易管理</dt>
	                <dd><a href="javascript:;">浏览记录</a></dd>
	                <dd><a href="javascript:;">收藏夹</a></dd>
	                <dd><a href="javascript:;">购物车</a></dd>

	                <dt class="level1">订单详情</dt>
	                <dd><a href="javascript:;">待付款订单</a></dd>
	                <dd class="on"><a href="javascript:;">已付款订单</a></dd>
	                <dd><a href="javascript:;">已取消订单</a></dd>
	                <dd><a href="javascript:;">退款／退货订单</a></dd>

	                <dt class="level1">个人中心</dt>
	                <dd><a href="javascript:;">W积分</a></dd>
	                <dd><a href="javascript:;">会员等级</a></dd>
	                <dd><a href="javascript:;">优惠券</a></dd>
	                <dd><a href="javascript:;">我的评论</a></dd>

	                <dt class="level1">服务中心</dt>
	                <dd><a href="javascript:;">最新消息</a></dd>
	                <dd><a href="javascript:;">常见问题</a></dd>
	                <dd><a href="javascript:;">用户手册</a></dd>
	                <dd><a href="javascript:;">隐私条款</a></dd>

	                <dt class="level1">设置</dt>
	                <dd><a href="javascript:;">个人信息</a></dd>
	                <dd><a href="javascript:;">地址管理</a></dd>
	            </dl>
	        </div>

	        <div class="personal_main fr">
	            <ul class="personal_tab_header clearfix">
	                <li><a href="javascript:;">待付款订单</a></li>
	                <li class="on"><a href="javascript:;">已付款订单</a></li>
	                <li><a href="javascript:;">已取消订单</a></li>
	                <li><a href="javascript:;">退款／退货订单</a></li>
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

@section('js')
	<script src="{{asset('/templates/home/js/dynamic.js')}}"></script>
@endsection
