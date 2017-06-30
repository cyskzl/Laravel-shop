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
	            <li><a href="javascript:;">首页</a><span>&gt;</span></li>
	            <li><a href="javascript:;">个人中心</a></li>
	        </ul>
	    </div>
	    <!-- breadcrumbs end-->

	    <!-- personal_center start-->
	    <div class="personal_center comWidth clearfix">

	        <div class="personal_left fl">
	            <dl>
	                <dt class="personal_info"><a href="javascript:;"><img src="./uploads/personal.jpg" alt=""/></a></dt>
	                <dd class="phone">13843838438</dd>

	                <dt class="level1">交易管理</dt>
	                <dd><a href="javascript:;">浏览记录</a></dd>
	                <dd><a href="javascript:;">收藏夹</a></dd>
	                <dd><a href="javascript:;">购物车</a></dd>

	                <dt class="level1">订单详情</dt>
	                <dd><a href="javascript:;">待付款订单</a></dd>
	                <dd><a href="javascript:;">已付款订单</a></dd>
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
	                <dd class="on"><a href="javascript:;">个人信息</a></dd>
	                <dd><a href="javascript:;">地址管理</a></dd>
	            </dl>
	        </div>

	        <div class="personal_main fr">
	            <ul class="personal_tab_header clearfix">
	                <li class="on" style="border-left: none"><a href="javascript:;">个人信息</a></li>
	                <li><a href="javascript:;">地址设置</a></li>
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
@endsection
