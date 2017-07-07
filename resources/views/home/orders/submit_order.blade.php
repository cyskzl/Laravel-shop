@extends('home.layouts.layout_two')

@section('title','提交订单')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/check.css')}}"/>
@endsection

@section('main')
	<!-- 内容 -->
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
	        {{--<div class="integralInfo">--}}
	            {{--<h4>优惠劵</h4>--}}
	            {{--<div class="copt">--}}
	                {{--<div class="copt_text">九折优惠券</div>--}}
	                {{--<div></div>--}}
	            {{--</div>--}}
	        {{--</div>--}}
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
	        {{--<div class="invoiceInfo">--}}
	            {{--<h4>开具发票</h4>--}}
	            {{--<p>海外仓发货商品不开具发票，具体情况请联系客服</p>--}}
	        {{--</div>--}}
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
@endsection
