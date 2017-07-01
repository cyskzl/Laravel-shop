<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>尤为</title>
	<link rel="stylesheet" href="{{asset('/templates/home/css/headert.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('/templates/home/css/footer.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('/templates/home/css/public.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/home/css/cart.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/home/iconfont2/iconfont.css')}}">
	<script src="{{asset('/templates/home/js/jquery-1.7.2.min.js')}}"></script>
	<script src="{{asset('/templates/home/js/header.js')}}"></script>
	<script src="{{asset('/templates/home/js/dynamic.js')}}"></script>
	<script src="{{asset('/templates/home/js/shopCart.js')}}"></script>

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
	    <form action="">
	        <table id="car">
	            <thead>
	            <tr>
	                <th><label><input id="checkAll" type="checkbox"/> 全选</label></th>
	                <th>商品信息</th>
	                <th>单价</th>
	                <th>数量</th>
	                <th>小计</th>
	                <th>操作</th>
	            </tr>
	            </thead>
	            <tbody id="goodsBox">
	                <tr>
	                    <td align="center" width="60">
	                        <input name="subBox" type="checkbox"/>
	                    </td>
	                    <td align="center">
	                        <img src="./images/wimg_450677010_2817349.jpg" alt="商品一"/>
	                        <a href="#">［闵孝琳、朴寒星原款］狐狸毛绒包吊坠_柠檬黄</a>
	                        <div class="operationInfo">
	                            <div class="operationInfoWrap flex">
	                                <p>颜色: <span>天海蓝</span></p>
	                                <p>尺码: <span>M</span></p>
	                            </div>
	                        </div>
	                        <div class="modify">修改
	                            <div class="modify_box">
	                                <div class="modify_content clearfix">
	                                    <span class="fl">颜色 :</span>
	                                    <ul class="clearfix fl color_list">
	                                        <li>
	                                            <div>柠檬黄</div>
	                                        </li>
	                                        <li>
	                                            <div>柠檬白</div>
	                                        </li>
	                                    </ul>
	                                </div>
	                                <div class="modify_content clearfix">
	                                    <span class="fl">尺码 :</span>
	                                    <ul class="clearfix fl size_list">
	                                        <li>
	                                            <div>one size</div>
	                                        </li>
	                                        <li>
	                                            <div>M</div>
	                                        </li>
	                                        <li>
	                                            <div>L</div>
	                                        </li>
	                                    </ul>
	                                </div>
	                                <div class="modify_btn">
	                                    <div class="modifySave" href="javascript:;">确认</div>
	                                    <div class="modifyCancel" href="javascript:;">取消</div>
	                                </div>
	                            </div>
	                        </div>
	                    </td>
	                    <td align="center">
	                        <span class="qx">￥<span class="uniPrice">220</span></span>
	                    </td>
	                    <td align="center" class="quentIpt">
	                        <a class="reduce" href="javascript:;">-</a>
	                        <input class="num" type="text" value="1" disabled>
	                        <a class="plus" href="javascript:;">+</a>
	                    </td>
	                    <td align="center" class="totalMoney"><span>￥<span id="subtotal">220</span></span></td>
	                    <td align="center"><span class="delGoods iconfont icon-shanchu1 del"></span></td>
	                </tr>
	                <tr>
	                    <td align="center" width="60">
	                        <input name="subBox" type="checkbox"/>
	                    </td>
	                    <td align="center">
	                        <img src="./images/wimg_450677010_2817349.jpg" alt="商品一"/>
	                        <a href="#">［闵孝琳、朴寒星原款］狐狸毛绒包吊坠_柠檬黄</a>
	                        <div class="operationInfo">
	                            <div class="operationInfoWrap flex">
	                                <p>颜色: <span>天海蓝</span></p>
	                                <p>尺码: <span>M</span></p>
	                            </div>
	                        </div>
	                        <div class="modify">修改
	                            <div class="modify_box">
	                                <div class="modify_content clearfix">
	                                    <span class="fl">颜色 :</span>
	                                    <ul class="clearfix fl color_list">
	                                        <li>
	                                            <div>柠檬黄</div>
	                                        </li>
	                                        <li>
	                                            <div>柠檬白</div>
	                                        </li>
	                                    </ul>
	                                </div>
	                                <div class="modify_content clearfix">
	                                    <span class="fl">尺码 :</span>
	                                    <ul class="clearfix fl size_list">
	                                        <li>
	                                            <div>one size</div>
	                                        </li>
	                                        <li>
	                                            <div>M</div>
	                                        </li>
	                                        <li>
	                                            <div>L</div>
	                                        </li>
	                                    </ul>
	                                </div>
	                                <div class="modify_btn">
	                                    <div class="modifySave" href="javascript:;">确认</div>
	                                    <div class="modifyCancel" href="javascript:;">取消</div>
	                                </div>
	                            </div>
	                        </div>
	                    </td>
	                    <td align="center">
	                        <span class="qx">￥<span class="uniPrice">220</span></span>
	                    </td>
	                    <td align="center" class="quentIpt">
	                        <a class="reduce" href="javascript:;">-</a>
	                        <input class="num" type="text" value="1" disabled>
	                        <a class="plus" href="javascript:;">+</a>
	                    </td>
	                    <td align="center" class="totalMoney"><span>￥<span id="subtotal">220</span></span></td>
	                    <td align="center"><span class="delGoods iconfont icon-shanchu1 del"></span></td>
	                </tr>
	            </tbody>
	            <tfoot>
	                <tr>
	                    <th colspan="4" class="allMoney-th">商品总金额：<span class="allMoney myf">￥<span id="allMoney" class="allMoney">220</span></span></th>
	                    <th colspan="2"><span class="settlement">去结算</span></th>
	                </tr>
	            </tfoot>
	        </table>
	    </form>
	    <div class="cart-notice">
	        <img src="./uploads/icon_notice.png" alt=""/>
	        多选产品时我们可能会给您分开发货
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