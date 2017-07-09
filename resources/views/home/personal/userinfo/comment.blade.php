@extends('home.layouts.layout')

@section('title','我的评论')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/personal.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/css/comment.css')}}"/>
@endsection


@section('main')
	<!-- 内容 -->
	    <div class="breadcrumbs comWidth">
	        <ul>
	            <li><a href="javascript:;">首页</a><span>&gt;</span></li>
	            <li><a href="javascript:;">个人中心</a><span>&gt;</span></li>
	            <li><a href="javascript:;">我的评论</a></li>
	        </ul>
	    </div>
	    <!-- breadcrumbs end-->

	    <!-- personal_center start-->
	    <div class="personal_center comWidth clearfix">

			@include('home.personal.left_memu')

	        <div class="personal_main fr">
	            <ul class="personal_tab_header clearfix">
	                <li style="border-left: none"><a href="{{ url('home/integral') }}" data-memu="9">w积分</a></li>
	                <li><a href="{{ url('home/memberlevel') }}" data-memu="10">会员等级</a></li>
	                <li><a href="{{ url('home/coupon') }}" data-memu="11">优惠券</a></li>
	                <li class="on"><a href="{{ url('home/comment') }}" data-memu="12">我的评论</a></li>
	            </ul>

	            <!-- 我的评论 -->
	            <div class="personal_tab">
	                <div class="tab_paid">
	                    <div class="empty-box">
	                        <span class="icn-empty-review"></span>
	                        <span>暂无评论，快来说点什么吧…</span>
	                    </div>
	                </div>
	            </div>
	            <!-- 我的评论 -->
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
