@extends('home.layouts.layout')

@section('title','搜索')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/section.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('/templates/home/css/product.css')}}" type="text/css">
	<script src="{{asset('/templates/home/js/jquery-1.images7.2.min.js')}}"></script>
	<script src="{{asset('/templates/home/js/page.js')}}"></script>
	<style>
		.page_product_bottom a{
			display: block;
			float:left;
			margin:20px;
		}
	</style>
@endsection

@section('main')
			<div class="page_product_top">
				<p style="color:#626161;font-size:25px;">{{$tip['tip']}}</p>
			</div>
			<!-- 商品图片列表 -->
			<div class="page_product_img" style="width:1100px; left:50%;margin-left:148px;">
				<div class="page_product_bottom" style="float:left;">
					@foreach($goods as $v)
					<a href="{{url('home/goodsDetail/'.$v->goods_id)}}">
						<span>
							<img src="{{asset(trim($v->original_img,','))}}" alt="">
						</span>
						<p class="text">{{$v->goods_name}}</p>
						<p class="text">¥ {{$v->shop_price}}</p>
					</a>
					@endforeach
				</div>
			</div>



@endsection








