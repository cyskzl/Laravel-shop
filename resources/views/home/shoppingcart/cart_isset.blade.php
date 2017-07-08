@extends('home.layouts.layout_two')

@section('title','购物车')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/cart.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/iconfont2/iconfont.css')}}">
	<script src="{{asset('/templates/home/js/jquery-1.7.2.min.js')}}"></script>
	<script src="{{asset('/templates/home/js/header.js')}}"></script>
	<!-- <script src="{{asset('/templates/home/js/dynamic.js')}}"></script> -->
	<script src="{{asset('/templates/admin/lib/layui/layui.js')}}"></script>
	<script src="{{asset('/templates/home/js/shopCart.js')}}"></script>

	<style media="screen">
		.m0a {
	    	margin: 0 auto;
		}

		.w1100 {
		    width: 1100px;
		}
		.emptyShoppingcar img {
			display: block;
			width: 87px;
			height: 86px;
			margin: 60px auto;
		}
		.emptyShoppingcar p {
		    font-size: 18px;
		    color: #7a7a7a;
		    text-align: center;
		    margin-bottom: 60px;
		}
		.emptyShoppingcar>a {
		    display: block;
		    width: 140px;
		    height: 50px;
		    line-height: 50px;
		    background-color: #2d2d2d;
		    color: #fff;
		    text-align: center;
		    font-size: 16px;
		}
	</style>
@endsection

@section('main')
	<!-- 内容 -->
	@if (!empty( $cart_data ))
	    <form action="shopOrders" method="post">
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
				{{--{{$_SESSION['goods_shop']}}--}}
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					@foreach($cart_data as $goods)
		                <tr>
							<input type="hidden" name="goods_id" value="{{ $goods['goods_id']}}">
		                    <td align="center" width="60">
		                        <input name="subBox" type="checkbox" value="{{ $goods['session_id'] }}" />
		                    </td>
		                    <td align="center">
		                        <img class="cart_img" src="{{ asset(''.$goods['img'].'') }}" alt="{{ $goods['goods_name']  }}"/>
		                        <a href="{{ url('home/goodsDetail/').'/'.$goods['goods_id'] }}" target="_blank">{{ $goods['goods_name'] }}</a>
		                        <div class="operationInfo">
		                            <div class="operationInfoWrap flex">
										@foreach( $goods['spec'] as $spec)
										<p class="spec">{{ $spec }}</p>
										@endforeach
										<input type="hidden" name="key1" value="{{ $goods['key1'] }}">
										<input type="hidden" name="key2" value="{{ $goods['key2'] }}">

		                            </div>
		                        </div>

		                    </td>
		                    <td align="center">
		                        <span class="qx">￥<span class="uniPrice">{{ $goods['price'] }}</span>
								</span>
		                    </td>
		                    <td align="center" class="quentIpt">
		                        <a class="reduce" href="javascript:;">-</a>
		                        <input class="num" type="text" value="{{ $goods['num'] }}" disabled>
		                        <a class="plus" href="javascript:;">+</a>
		                    </td>
		                    <td align="center" class="totalMoney"><span>￥<span id="subtotal">{{ number_format($goods['num'] * ltrim($goods['price'], '￥'), 2, '.','') }}</span></span></td>
		                    <td align="center"><span class="delGoods iconfont icon-shanchu1 del"></span></td>
		                </tr>
					@endforeach
	            </tbody>
	            <tfoot>
	                <tr>
	                    <th colspan="4" class="allMoney-th">总计：<span class="allMoney myf">￥<span id="allMoney" class="allMoney">00.00</span></span></th>
	                    <th colspan="2"><span class="settlement">去结算</span></th>
	                </tr>
	            </tfoot>

	        </table>
	    </form>
	    <div class="cart-notice">
	        <img src="{{ asset('templates/home/uploads/icon_notice.png') }}" alt=""/>
	        多选产品时我们可能会给您分开发货
	    </div>
		@else
		<div class="emptyShoppingcar w1100 m0a">
			<img src="{{ asset('templates/home/images/emptyShoppingcar.png') }}">
			<p>您的购物车里还没有任何商品，快去逛逛吧…</p>
			<a class="m0a mb20" href="{{ url('home') }}">去逛逛</a>
		</div>
		@endif
<script src="{{asset('/templates/home/js/shopCar.js')}}"></script>
@endsection
