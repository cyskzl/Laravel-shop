<<<<<<< HEAD
@extends('home.layouts.layout')

@section('title','已取消订单')

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
			<li><a href="javascript:;">已取消订单</a></li>
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
				<dd><a href="javascript:;">已付款订单</a></dd>
				<dd class="on"><a href="javascript:;">已取消订单</a></dd>
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
				<li><a href="javascript:;">已付款订单</a></li>
				<li class="on"><a href="javascript:;">已取消订单</a></li>
				<li><a href="javascript:;">退款／退货订单</a></li>
			</ul>

			<!-- 已取消订单 -->
			<div class="personal_tab">
				<div class="tab_paid">
					<div class="empty-box">
						<span class="icn-empty-order"></span>
						<span>没有符合条件的订单，请尝试其他搜索条件。</span>
					</div>
				</div>
			</div>
			<!-- 已取消订单 -->
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
@endsection


=======
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>已取消订单</title>
	<link rel="stylesheet" href="./css/header.css" type="text/css">
	<link rel="stylesheet" href="./css/footer.css" type="text/css">
	<link rel="stylesheet" href="./css/public.css"/>
    <link rel="stylesheet" href="./css/personal.css"/>
    <link rel="stylesheet" href="./css/order.css"/>
	<script src="./js/jquery-1.7.2.min.js"></script>
	<script src="./js/header.js"></script>
</head>
<body>
<div class="content">
	<!-- 头部 -->
	<div class="header clearfix">
		<!-- 顶部 -->
		<div class="header_top left">
			<ul class="header_top_left left">
				<li><a href="javascript:;">注册</a></li>
				<li><a href="javascript:;">登录</a></li>
				<li class="header_top_left_li">下载APP
					<a href="javascript:">
						<img class="header_top_left_code" src="./uploads/down_app.png" alt="">
					</a>
				</li>
			</ul>
			<ul class="header_top_right right">
				<li>我的订单</li>
				<li>收藏</li>
				<li>消息</li>
				<li class="header_top_right_li">个人中心&nbsp;
					<span>
						<img src="./uploads/pCenter_qian.png" alt="">
					</span>
					<div class="header_top_right_div">
					<a href="javascript:">购物车</a>
					<a href="javascript:">收藏夹</a>
					<a href="javascript:">W积分</a>
					<a href="javascript:">优惠券</a>
				</div>
				</li>
				<li>客户服务</li>
				<li class="header_top_left_li_two">关注我们
					<a href="javascript:" class="header_top_left_li_two_ding">
						<img class="header_top_left_code_two" src="./uploads/down_app.png" alt="">
					</a>
				</li>

			</ul>
		</div>
		<!-- 搜索区 -->
		<div class="header_top_bottom left">
			<div class="header_top_bottom_people left">
				<a href="javascript:">女士</a>
				<a href="javascript:">男士</a>
				<a href="javascript:">创意生活</a>
			</div>
			<div class="header_logo left">
				<img src="./uploads/logo (1).png" alt="">
			</div>
			<div class="header_search right">
				<div>
					<input type="text" class="header_searchForm left" placeholder="请输入搜索内容" style="outline:none">
					<a href="javascript:" id="header_searchin">
						<img src="./uploads/icon_searchin.png" alt="">
					</a>
				</div>
				<ul class="left">
					<li><a href="javascript:">SALONDEJU</a></li>
					<li><a href="javascript:">ANDERSSON BELL</a></li>
					<li><a href="javascript:">FIND KAPOOR</a></li>
					<li><a href="javascript:">MONTS</a></li>
					<li><a href="javascript:">BIBYSEOB</a></li>
					<li><a href="javascript:">Yuul Yie</a></li>
				</ul>
			</div>
		</div>
		<!-- 头部nav -->
		<div class="header_nav left">
			<div class="header_nav_left left">
				<div id="header_nav_left_nab">
					<a href="javascript:">6.18</a>
					<div class="header_nav_left_nab">
					</div>
				</div>
				<div id="header_nav_left_new">
					<a href="javascript:">新品</a>
					<div class="header_nav_left_new">
						<div class="elastic_no">
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
						</div>
					</div>
				</div>
				<div id="header_nav_left_new">
					<a href="javascript:">服饰</a>
					<div class="header_nav_left_new">
						<div class="elastic_no">
							<div class="header_nav_left_new_one_text">
								<a href="javascript:">帽衫／卫衣</a>
								<a href="javascript:">衬衫</a>
								<a href="javascript:">毛衣／针织衫</a>
								<a href="javascript:">T恤</a>
								<a href="javascript:">大衣／风衣</a>
								<a href="javascript:">夹克</a>
								<a href="javascript:">便服</a>
								<a href="javascript:">牛仔</a>
								<a href="javascript:">西装</a>
								<a href="javascript:">皮衣</a>
								<a href="javascript:">连衣裙</a>
								<a href="javascript:">半身裙</a>
								<a href="javascript:">休闲裤</a>
								<a href="javascript:">运动裤</a>
								<a href="javascript:">西裤</a>
								<a href="javascript:">羽绒服／棉服</a>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
						</div>
					</div>
				</div>
				<div id="header_nav_left_new">
					<a href="javascript:">鞋履</a>
					<div class="header_nav_left_new">
						<div class="elastic_no">
							<div class="header_nav_left_new_one_text">
								<a href="javascript:">帽衫／卫衣</a>
								<a href="javascript:">衬衫</a>
								<a href="javascript:">毛衣／针织衫</a>
								<a href="javascript:">T恤</a>
								<a href="javascript:">大衣／风衣</a>
								<a href="javascript:">夹克</a>
								<a href="javascript:">便服</a>
								<a href="javascript:">牛仔</a>
								<a href="javascript:">西装</a>
								<a href="javascript:">皮衣</a>
								<a href="javascript:">连衣裙</a>
								<a href="javascript:">半身裙</a>
								<a href="javascript:">休闲裤</a>
								<a href="javascript:">运动裤</a>
								<a href="javascript:">西裤</a>
								<a href="javascript:">羽绒服／棉服</a>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
						</div>
					</div>
				</div>
				<div id="header_nav_left_new">
					<a href="javascript:">包袋</a>
					<div class="header_nav_left_new">
						<div class="elastic_no">
							<div class="header_nav_left_new_one_text">
								<a href="javascript:">帽衫／卫衣</a>
								<a href="javascript:">衬衫</a>
								<a href="javascript:">毛衣／针织衫</a>
								<a href="javascript:">T恤</a>
								<a href="javascript:">大衣／风衣</a>
								<a href="javascript:">夹克</a>
								<a href="javascript:">便服</a>
								<a href="javascript:">牛仔</a>
								<a href="javascript:">西装</a>
								<a href="javascript:">皮衣</a>
								<a href="javascript:">连衣裙</a>
								<a href="javascript:">半身裙</a>
								<a href="javascript:">休闲裤</a>
								<a href="javascript:">运动裤</a>
								<a href="javascript:">西裤</a>
								<a href="javascript:">羽绒服／棉服</a>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
						</div>
					</div>
				</div>
				<div id="header_nav_left_new">
					<a href="javascript:">饰品.其他</a>
					<div class="header_nav_left_new">
						<div class="elastic_no">
							<div class="header_nav_left_new_one_text">
								<a href="javascript:">帽衫／卫衣</a>
								<a href="javascript:">衬衫</a>
								<a href="javascript:">毛衣／针织衫</a>
								<a href="javascript:">T恤</a>
								<a href="javascript:">大衣／风衣</a>
								<a href="javascript:">夹克</a>
								<a href="javascript:">便服</a>
								<a href="javascript:">牛仔</a>
								<a href="javascript:">西装</a>
								<a href="javascript:">皮衣</a>
								<a href="javascript:">连衣裙</a>
								<a href="javascript:">半身裙</a>
								<a href="javascript:">休闲裤</a>
								<a href="javascript:">运动裤</a>
								<a href="javascript:">西裤</a>
								<a href="javascript:">羽绒服／棉服</a>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
							<div class="header_nav_left_new_one">
								<img src="./uploads/wimg_450700745_2945817.jpg" alt="">
								<span class="font_sm">LOOKAST</span>
								<span class="font">翻领短袖开叉连衣裙_黄色</span>
								<span class="money">¥ 715</span>
							</div>
						</div>
					</div>
				</div>
				<div>
					<a href="javascript:">博主控</a>
				</div>
			</div>
			<div class="header_nav_right right">
				<div class="header_nav_right_one">
					<a href="javascript:">潮流推荐</a>
					<div id="header_nav_right_recommended">
						<div>
							<h3>促销</h3>
							<img src="./uploads/170612_newweb_03.jpg" alt="">
						</div>
						<div>
							<h3>穿搭</h3>
							<img src="./uploads/170612_newweb_03.jpg" alt="">
						</div>
						<div>
							<h3>设计师</h3>
							<img src="./uploads/170612_newweb_03.jpg" alt="">
						</div>
						<div>
							<h3>明星同款</h3>
							<img src="./uploads/170612_newweb_03.jpg" alt="">
						</div>
						<div>
							<h3>最新韩流</h3>
							<img src="./uploads/170612_newweb_03.jpg" alt="">
						</div>
					</div>
				</div>
				<div class="header_nav_right_two ">
					<a href="javascript:">活动专区</a>
					<div id="header_nav_right_area">
						<div>
							<h3><a href="">热门话题</a></h3>
							<img src="./uploads/topicBanner.png" alt="">
						</div>
						<div>
							<h3><a href="">最新活动</a></h3>
							<img src="./uploads/kv.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- 内容 -->
	<main>
	    <!-- breadcrumbs start-->
	    <div class="breadcrumbs comWidth">
	        <ul>
	            <li><a href="javascript:;">首页</a><span>&gt;</span></li>
	            <li><a href="javascript:;">个人中心</a><span>&gt;</span></li>
	            <li><a href="javascript:;">已取消订单</a></li>
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
	                <dd class="on"><a href="javascript:;">已取消订单</a></dd>
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
	                <li><a href="javascript:;">已付款订单</a></li>
	                <li class="on"><a href="javascript:;">已取消订单</a></li>
	                <li><a href="javascript:;">退款／退货订单</a></li>
	            </ul>

	            <!-- 已取消订单 -->
	            <div class="personal_tab">
	                <div class="tab_paid">
	                    <div class="empty-box">
	                        <span class="icn-empty-order"></span>
	                        <span>没有符合条件的订单，请尝试其他搜索条件。</span>
	                    </div>
	                </div>
	            </div>
	            <!-- 已取消订单 -->
	        </div>

	    </div>
	    <!-- personal_center end-->
	</main>

	<!-- 尾部 -->
	<div class="footer left">
		<div class="footer_top">
			<a href="javascript:">
				<img src="./uploads/memberLevel.png" alt="">
				<span>会员等级</span>
			</a>
			<a href="javascript:"><img src="./uploads/userManual.png" alt=""><span>用户手册</span></a>
			<a href="javascript:"><img src="./uploads/down_app.png" alt=""><span>下载APP</span></a>
			<a href="javascript:"><img src="./uploads/shang.png" alt=""><span>隐私条款</span></a>
			<a href="javascript:"><img src="./uploads/normalProblem.png" alt=""><span>常见问题</span></a>
		</div>
		<div class="footer_bottom">
			<p>上海森画电子商务有限公司 版权所有<a href="javascript:">沪ICP备 15045419号－1</a></p>

		</div>
	</div>
	<!--购物车    固定右边-->
	<div class="shoppingcar">
		<div class="cart">
			<a href="">
				<i></i>
				<p>购物车</p>
				<b>0</b>
			</a>
		</div>
		<!--回到顶部-->
		<div id="scrolltop">
			<img src="./uploads/go_to_top.png" alt="" / >
		</div>
	</div>
</div>
	<script src="./js/dynamic.js"></script>

</body>
</html>
>>>>>>> origin/dasuan
