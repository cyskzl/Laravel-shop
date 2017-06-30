@extends('home.layouts.layout')

@section('title','常见问题')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/personal.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/css/comProblem.css')}}"/>
@endsection

@section('main')
	<!-- 内容 -->
	    <!-- breadcrumbs start-->
	    <div class="breadcrumbs comWidth">
	        <ul>
	            <li><a href="javascript:;">首页</a><span>&gt;</span></li>
	            <li><a href="javascript:;">个人中心</a><span>&gt;</span></li>
	            <li><a href="javascript:;">常见问题</a></li>
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
	                <dd class="on"><a href="javascript:;">常见问题</a></dd>
	                <dd><a href="javascript:;">用户手册</a></dd>
	                <dd><a href="javascript:;">隐私条款</a></dd>

	                <dt class="level1">设置</dt>
	                <dd><a href="javascript:;">个人信息</a></dd>
	                <dd><a href="javascript:;">地址管理</a></dd>
	            </dl>
	        </div>

	        <div class="personal_main fr">
	            <ul class="personal_tab_header clearfix">
	                <li style="border-left: none"><a href="javascript:;">最新消息</a></li>
	                <li class="on"><a href="javascript:;">常见问题</a></li>
	                <li><a href="javascript:;">用户手册</a></li>
	                <li><a href="javascript:;">隐私条款</a></li>
	            </ul>

	            <!-- 常见问题 -->
	            <div class="personal_tab">
	                <div class="cs_board">
	                    <ul class="cs_board_list">
	                        <li>
	                            <p class="showContent">
	                                <a class="tit" href="javascript:;">注册会员</a>
	                                <span class="icon_to_right"></span>
	                            </p>
	                            <div class="item_content">
	                                <p>APP客户端：进入右下角“我的W concept” ，点击“马上注册”输入手机号码，根据提示进行相关操作即可注册成为会员。</p>
	                                <p>PC网页端：在商城首页的左上角，点击“注册”输入手机号码，根据提示进行相关操作即可注册成为会员。</p>
	                            </div>
	                        </li>
	                        <li>
	                            <p class="showContent">
	                                <a class="tit" href="javascript:;">用户登录</a>
	                                <span class="icon_to_right"></span>
	                            </p>
	                            <div class="item_content">
	                                <p>APP客户端：进入右下角“我的W concept” ，点击“马上注册”输入手机号码，根据提示进行相关操作即可注册成为会员。</p>
	                                <p>PC网页端：在商城首页的左上角，点击“注册”输入手机号码，根据提示进行相关操作即可注册成为会员。</p>
	                            </div>
	                        </li>
	                    </ul>
	                </div>
	            </div>
	            <!-- 常见问题 -->
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
	<script>
        $(function(){
            $('.showContent').toggle(
                function(){
                    $(this).next().css({"display":"block"});
                    $(this).children('.icon_to_right').css({"transform":"rotate(90deg)"});
                },
                function(){
                    $(this).next().css({"display":"none"});
                    $(this).children('.icon_to_right').css({"transform":"rotate(0deg)"});
                }
            );
        });
	</script>
@endsection
