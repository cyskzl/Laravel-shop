<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>尤为</title>
	<link rel="stylesheet" href="{{asset('/templates/home/css/headert.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('/templates/home/css/footer.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('/templates/home/css/public.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/home/css/check.css')}}"/>
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
			<div class="header_logo left">
				<img src="./uploads/logo (1).png" alt="">
			</div>
		</div>
	</div>

	<!-- 内容 -->
	<main class="comWidth">

	        <div class="checkList">
	            <div class="listMsg">
	                <p>填写并核对订单信息</p>
	                <div class="listInfo">
	                    <h4 class="fl">收货人信息</h4>
	                    <a class="fr" href="javascript:;">新增收货地址</a>
	                </div>
	                <div class="noAddress">
	                    <p>暂时无收货人信息</p>
	                    <a href="javascript:;">添加收货地址</a>
	                </div>
	            </div>
	        </div>

	        <!-- 商品信息 start-->
	        <div class="goodsInfo">
	            <h4>商品信息</h4>
	            <table class="cart-cont comWidth">
	                <thead>
	                    <tr><td>韩国仓库</td></tr>
	                </thead>
	                <tbody>
	                    <tr>
	                        <td>
	                            <img src="./images/wimg_450690305_2889998.jpg" alt="商品一"/>
	                            <a href="#">［朴寒星原款］狐狸毛绒包吊坠_柠檬黄</a>
	                            <div class="operationInfo">
	                                <div class="operationInfoWrap flex">
	                                    <p>颜色: <b>天海蓝</b></p>
	                                    <p>尺码: <b>M</b></p>
	                                    <p class="total_price">￥481</p>
	                                </div>
	                            </div>
	                        </td>
	                    </tr>
	                    <tr>
	                        <td>
	                            <img src="./images/wimg_450690305_2889998.jpg" alt="商品一"/>
	                            <a href="#">［朴寒星原款］狐狸毛绒包吊坠_柠檬黄</a>
	                            <div class="operationInfo">
	                                <div class="operationInfoWrap flex">
	                                    <p>颜色: <b>天海蓝</b></p>
	                                    <p>尺码: <b>M</b></p>
	                                    <p class="total_price">￥481</p>
	                                </div>
	                            </div>
	                        </td>
	                    </tr>
	                </tbody>
	            </table>
	        </div>
	        <!-- 商品信息 end-->

	        <!-- 优惠 start-->
	        <div class="integralInfo">
	            <h4>优惠劵</h4>
	            <div class="copt">
	                <div class="copt_text">九折优惠券</div>
	                <div></div>
	            </div>
	        </div>
	        <!-- 优惠 end-->

	        <!-- 积分 start-->
	        <div class="integralInfo">
	            <h4>积分</h4>
	            <div class="wpoint">
	                <p>
	                    <a href="javascript:;"><input class="integral_btn" type="checkbox"/></a>
	                    可用积分: <span id="my-wpoint">0</span>
	                </p>
	            </div>
	        </div>
	        <!-- 积分 end-->

	        <!-- 开具发票 start-->
	        <div class="invoiceInfo">
	            <h4>开具发票</h4>
	            <p>海外仓发货商品不开具发票，具体情况请联系客服</p>
	        </div>
	        <!-- 开具发票 end-->

	        <!-- 交易信息 start-->
	        <div class="checkoutInfo">
	            <h4>交易信息</h4>
	            <div class="tradeInfo">
	                <p>商品总金额：¥ 481.00</p>
	                <p>运费：¥ 0.00</p>
	                <p>优惠券折扣：¥ 0.00</p>
	                <p>积分折扣：-0P(¥ 0.00)</p>
	            </div>
	        </div>
	        <!-- 交易信息 end-->

	        <div class="submit_order clearfix">
	        	<p class="left">总计: 
	        		<span>¥ 194.71</span>
	        	</p>
	            <span class="submit_btn right">提交订单</span>
	        </div>
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
	
</div>

</body>
</html>