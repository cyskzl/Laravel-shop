@extends('home.layouts.layout')

@section('title','会员等级')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/personal.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/css/memberLevel.css')}}"/>
@endsection

@section('main')
	<!-- 内容 -->
	    <div class="breadcrumbs comWidth">
	        <ul>
	            <li><a href="javascript:;">首页</a><span>&gt;</span></li>
	            <li><a href="javascript:;">个人中心</a><span>&gt;</span></li>
	            <li><a href="javascript:;">会员等级</a></li>
	        </ul>
	    </div>
	    <!-- breadcrumbs end-->

	    <!-- personal_center start-->
	    <div class="personal_center comWidth clearfix">

			@include('home.personal.left_memu')

	        <div class="personal_main fr">
	            <ul class="personal_tab_header clearfix">
					<li style="border-left: none"><a href="{{ url('home/integral') }}" data-memu="9">w积分</a></li>
	                <li class="on"><a href="{{ url('home/memberlevel') }}" data-memu="10">会员等级</a></li>
	                <li><a href="{{ url('home/coupon') }}" data-memu="11">优惠券</a></li>
	                <li><a href="{{ url('home/comment') }}" data-memu="12">我的评论</a></li>
	            </ul>

	            <!-- 会员等级 -->
	            <div class="personal_tab">
	                <div class="tab_class">
	                    <div class="my_class">
	                        <div class="avatar">
	                            <a href="javascript:;">
	                                <img src="./uploads/W1.png" alt=""/>
	                            </a>
	                        </div>
	                        <div class="myclass_name">我的会员等级</div>
	                        <img src="./uploads/mypage_class.png" alt=""/>
	                    </div>
	                </div>
	            </div>
	            <!-- 会员等级 -->
	        </div>

	    </div>
	    <!-- personal_center end-->
@endsection

@section('shop')

@endsection
@section('js')
	<script src="{{asset('/templates/home/js/dynamic.js')}}"></script>
	<script src="{{asset('/templates/home/js/left_memu.js')}}"></script>
@endsection
