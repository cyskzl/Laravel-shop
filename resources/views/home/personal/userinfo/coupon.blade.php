@extends('home.layouts.layout')

@section('title','优惠券')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/personal.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/css/coupon.css')}}"/>
@endsection

@section('main')
	<!-- 内容 -->
	    <!-- breadcrumbs start-->
	    <div class="breadcrumbs comWidth">
	        <ul>
	            <li><a href="javascript:;">首页</a><span>&gt;</span></li>
	            <li><a href="javascript:;">个人中心</a><span>&gt;</span></li>
	            <li><a href="javascript:;">优惠券</a></li>
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
	                <li class="on"><a href="{{ url('home/coupon') }}" data-memu="11">优惠券</a></li>
	                <li><a href="{{ url('home/comment') }}" data-memu="12">我的评论</a></li>
	            </ul>

	            <!-- 优惠券 -->
	            <div class="personal_tab">
	                <div class="tab_coupon">
	                    <div class="coupon_list flex">
	                        <div class="coupon_item flex">
	                            <div class="CBL">
	                                <p class="coupon_price">九折优惠券</p>
	                            </div>
	                            <div class="CBR">无限制</div>
	                        </div>
	                        <div class="coupon_item flex">
	                            <div class="CBL">
	                                <p class="coupon_price">九折优惠券</p>
	                            </div>
	                            <div class="CBR">无限制</div>
	                        </div>
	                        <div class="coupon_item flex">
	                            <div class="CBL">
	                                <p class="coupon_price">九折优惠券</p>
	                            </div>
	                            <div class="CBR">无限制</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <!-- 优惠券 -->
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
