@extends('home.layouts.layout')

@section('title','待付款订单')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/personal.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/css/order.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/css/orders/order.css')}}"/>
@endsection

@section('main')
	<!--主体-->
	<!-- breadcrumbs start-->
	<div class="breadcrumbs comWidth">
		<ul>
			<li><a href="javascript:;">首页</a><span>&gt;</span></li>
			<li><a href="javascript:;">个人中心</a><span>&gt;</span></li>
			<li><a href="javascript:;">待付款订单</a></li>
		</ul>
	</div>
	<!-- breadcrumbs end-->
	<!-- personal_center start-->
	<div class="personal_center comWidth clearfix">

		@include('home.personal.left_memu')

		<div class="personal_main fr">
			<ul class="personal_tab_header clearfix">
				<li class="on"><a href="{{ url('home/waitorder') }}" data-memu="3">待付款订单</a></li>
				<li><a href="{{ url('home/alreadyorder') }}" data-memu="4">已付款订单</a></li>
				<li><a href="{{ url('home/cancelorder') }}" data-memu="5">已取消订单</a></li>
				<li><a href="{{ url('home/refundorder') }}" data-memu="6">退款／退货订单</a></li>
			</ul>

			<!-- 待付款订单 -->
			<div class="personal_tab">
				<div class="tab_paid">
					{{--<div class="empty-box">--}}
						{{--<span class="icn-empty-order"></span>--}}
						{{--<span>没有符合条件的订单，请尝试其他搜索条件。</span>--}}
					{{--</div>--}}

					@foreach($orderData as $vaule)
					<div class="order">
						<div class="order_top">
							<p>{{$vaule->created_at}}</p>
							<p>订单号:
								<span>{{$vaule->sn}}</span>
							</p>
						</div>

						<div class="order_bottom">
							<div class="order_bottom_style">
								@foreach($vaule->orderDetails as $v)
									<?php $goodsinfo = json_decode($v->goods_info,true) ?>
								<div class="yl">
									<div class="order_bottom_style_img">
										<img src="{{$goodsinfo['original_img']}}" alt="">
									</div>
									<div>
										<p><a href="http://al.com/home/goodsDetail/{{$v->goods_id}}">{{$goodsinfo['goods_name']}}</a></p>
									</div>
									<span>×{{$v->goods_num}}</span>
								</div>
								@endforeach
							</div>
							<div class="order_bottom_style_details">
								<div class="order_none">
									<p>{{$vaule->consignee}}</p>
								</div>
								<div>
									<div class="order_money">
										<p>总额¥{{$vaule->total_amount}}</p>
									</div>
								</div>
								<div>
									<div class="order_money_off">
										<p>{{$orderStatus[$vaule->order_status]}}</p>
										<a href="javascript:" class="colorsb">订单详情</a>
									</div>

								</div>
							</div>
						</div>
					</div>
					@endforeach



					{{--<div class="empty-box">--}}
					{{--<span class="icn-empty-order"></span>--}}
					{{--<span>没有符合条件的订单，请尝试其他搜索条件。</span>--}}
					{{--</div>--}}

			</div>
			</div>
			<!-- 待付款订单 -->
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
