@extends('home.layouts.layout')

@section('title','商品列表页')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/section.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('/templates/home/css/dress.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('/templates/home/css/main.css')}}">
	<script src="{{asset('/templates/home/js/page.js')}}"></script>
@endsection

@section('main')
	<!-- 商品页中间 -->
	<div class="page">
		<div class="page_channel">
			<ul class="display_a">
				<li>
					<a href="javascript:">@if($cateId == 1)女士@else男士@endif频道</a>
					<span>></span>
				</li>
				<li>
					<a href="javascript:">新品</a>
					<span>></span>
				</li>
				<li>上衣</li>
			</ul>
		</div>
		<div class="page_product elastic_top">
			<!-- 商品文字列表 -->
			<div class="page_product_all">
				<dl>
					<dt>全部产品</dt>
						{{--男女士标签加规格--}}
						@foreach($tags as $k=>$tag)
						<dd id="page_all_a" class="page_all_a">
							<span><img src="{{asset('\templates\home\uploads\icon_tree_menu.png')}}" alt=""></span>
							<a href="javascript:">{{$tag->tag_name}}</a>
						</dd>
						<dd id="page_all_aone" data-value=" {{$tag->goodcatename}}" class="page_all_none goodcatename" style="display: block;">
							{{--<a href="javascript:">全部上衣</a>--}}
							@foreach($goodsCatName[$k] as $key=>$v)
									<a href="{{url('/home/goodsList/'.$goodsCatId[$k][$key])}}">{{ $v }}</a>
							@endforeach
						</dd>
						@endforeach
					</dl>
				<!-- 商品文字列表底部img -->
				<div class="page_product_all_twoimg">
					<img src="{{asset('\templates\home\uploads\750x364.jpg')}}" alt="">
					<img src="{{asset('\templates\home\uploads\MRK-banner-750x360.jpg')}}" alt="">
				</div>
			</div>
			<!-- 商品图片列表 -->
			<div class="page_product_img">
				<div class="page_product_top">
					<a href="javascript:">最新</a>
					<a href="javascript:">销量</a>
					<a href="javascript:">价格
							<img src="{{asset('/templates/home/uploads/icon-pc-sort-price-up.png')}}" alt="">
							<img src="{{asset('/templates/home/uploads/icon-pc-sort-price-down.png')}}" alt="">
					</a>
				</div>
				<div class="page_product_bottom">
				@foreach($goods as $good)
					<a href="javascript:">
						<span>
							<img style='width:220px;height:293px' src="{{rtrim($good->original_img,',')}}" alt="">
						</span>
						<p class="text">{{$good->brand_id}}</p>
						<p class="text">{{$good->goods_name}}</p>
						<p class="text">¥ {{$good->shop_price}}</p>
					</a>

				@endforeach
				</div>
			</div>
		</div>
	</div>
	<center>
	<div id="pages" style=""></div>
		</center>
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
		layui.use(['laypage', 'layer'], function(){
			var laypage = layui.laypage
					,layer = layui.layer;

			laypage({
				cont: 'pages'
				,skin: '#626161'
				,pages: 12
				,skip: true
			});

		});
	</script>
@endsection



