@extends('home.layouts.layout')

@section('title','浏览记录')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/personal.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/css/browseLog.css')}}"/>
@endsection

@section('main')
	<!-- 内容 -->
	    <!-- breadcrumbs start-->
	    <div class="breadcrumbs comWidth">
	        <ul>
	            <li><a href="javascript:;">首页</a><span>&gt;</span></li>
	            <li><a href="javascript:;">个人中心</a><span>&gt;</span></li>
	            <li><a href="javascript:;">浏览记录</a></li>
	        </ul>
	    </div>
	    <!-- breadcrumbs end-->

	    <!-- personal_center start-->
	    <div class="personal_center comWidth clearfix">

			@include('home.personal.left_memu')

	        <div class="personal_main fr">
	            <ul class="personal_tab_header clearfix">
	                <li class="on" style="border-left: none"><a href="{{ url('home/browseLog') }}" data-memu="0">浏览记录</a></li>
	                <li><a href="{{ url('home/favorites') }}" data-memu="1">收藏夹</a></li>
	            </ul>

	            <!-- 浏览记录 -->
	            <div class="personal_tab">
	                <div class="tab_viewed">
	                    <div class="productList">
	                        <div class="infinite-scroll-wrapper clearfix">
	                            <a class="product_card new_line" href="javascript:;">
	                                <span class="product_img"><img src="./images/wimg_450706804_2997502.jpg" alt=""/></span>
	                                <span class="brand">it MICHAA</span>
	                                <span class="name">露肩荷叶边叠层雪纺衬衣_白色</span>
	                                <span class="price">¥ 666</span>
	                            </a>
	                            <a class="product_card new_line" href="javascript:;">
	                                <span class="product_img"><img src="./images/wimg_450706804_2997502.jpg" alt=""/></span>
	                                <span class="brand">it MICHAA</span>
	                                <span class="name">露肩荷叶边叠层雪纺衬衣_白色</span>
	                                <span class="price">¥ 666</span>
	                            </a>
	                             <a class="product_card new_line" href="javascript:;">
	                                <span class="product_img"><img src="./images/wimg_450706804_2997502.jpg" alt=""/></span>
	                                <span class="brand">it MICHAA</span>
	                                <span class="name">露肩荷叶边叠层雪纺衬衣_白色</span>
	                                <span class="price">¥ 666</span>
	                            </a>
	                            <a class="product_card new_line" href="javascript:;">
	                                <span class="product_img"><img src="./images/wimg_450706804_2997502.jpg" alt=""/></span>
	                                <span class="brand">it MICHAA</span>
	                                <span class="name">露肩荷叶边叠层雪纺衬衣_白色</span>
	                                <span class="price">¥ 666</span>
	                            </a>
	                            <a class="product_card new_line" href="javascript:;">
	                                <span class="product_img"><img src="./images/wimg_450706804_2997502.jpg" alt=""/></span>
	                                <span class="brand">it MICHAA</span>
	                                <span class="name">露肩荷叶边叠层雪纺衬衣_白色</span>
	                                <span class="price">¥ 666</span>
	                            </a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <!-- 浏览记录 -->
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
