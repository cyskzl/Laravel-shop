@extends('home.layouts.layout')

@section('title','W积分')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/personal.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/css/integral.css')}}"/>
@endsection

@section('main')
	<!-- 内容 -->
	    <div class="breadcrumbs comWidth">
	        <ul>
	            <li><a href="javascript:;">首页</a><span>&gt;</span></li>
	            <li><a href="javascript:;">个人中心</a><span>&gt;</span></li>
	            <li><a href="javascript:;">w积分</a></li>
	        </ul>
	    </div>
	    <!-- breadcrumbs end-->

	    <!-- personal_center start-->
	    <div class="personal_center comWidth clearfix">

			@include('home.personal.left_memu')

	        <div class="personal_main fr">
	            <ul class="personal_tab_header clearfix">
					<li class="on" style="border-left: none"><a href="{{ url('home/integral') }}" data-memu="9">w积分</a></li>
	                <li><a href="{{ url('home/memberlevel') }}" data-memu="10">会员等级</a></li>
	                <li><a href="{{ url('home/coupon') }}" data-memu="11">优惠券</a></li>
	                <li><a href="{{ url('home/comment') }}" data-memu="12">我的评论</a></li>
	            </ul>

	            <!-- 我的积分 -->
	            <div class="personal_tab">
	                <div class="tab_point">
	                    <div class="point_total">
	                        <div class="avatar">
	                            <a  href="javascript:;">
	                                <img src="./uploads/personal.jpg" alt=""/>
	                            </a>
	                        </div>
	                        <div class="point_total_info flex">
	                            <span class="BR">可用积分 <strong>0P</strong></span>
	                            <span>将要过期的积分 <strong>0P</strong></span>
	                        </div>
	                        <div class="point_history"></div>
	                        <div class="empty-box">
	                            <span>无积分记录</span>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <!-- 我的积分 -->
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
