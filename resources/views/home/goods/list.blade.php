@extends('home.layouts.layout')

@section('title','商品列表页')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/section.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('/templates/home/css/dress.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('/templates/home/css/main.css')}}">
	<script src="{{asset('/templates/home/js/page.js')}}"></script>
	<style>
		/*分页样式*/
		#pages{
			width: 948px;
			text-align: center;
			height: 20px;
			line-height: 20px;
			padding: 20px 0;
			border-top: 1px solid #d9d9d9;
		}
		#pages li {
			height: 20px;
			padding: 0 8px;
			margin: 0 10px;
			color: #626161;
			display: inline-block;
			cursor: pointer;

		}
		#pages li span{
			padding: 0 2px;
			border-radius: 2px;

		}
		#pages .active{
			background-color: #626161;
			color: #fff;
			padding: 3px 9px;
		}
	</style>
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
					@foreach($advertisement as $advertis)
						@if($advertis->name == '详情页面')
							<a href="home/goodsList/3?cate=3">
								<img src="{{rtrim($advertis->logo, ',')}}" alt="" style="width:140px;height:60px;padding-top:10px"/>
							</a>
						@endif
					@endforeach
				</div>

			</div>
			<!-- 商品图片列表 -->
			<div class="page_product_img">
				<div class="page_product_top">
					<a href="javascript:" id="NEW" >最新</a>
					<a href="javascript:" id="BEST">销量</a>
					<a href="javascript:" id="PRICE">价格
						<img src="{{asset('/templates/home/uploads/icon-pc-sort-price-up.png')}}" alt="">
						<img src="{{asset('/templates/home/uploads/icon-pc-sort-price-down.png')}}" alt="">
					</a>
				</div>
				<div class="page_product_bottom">
					@if($goods)
					@foreach($goods as $good)
						<a href="{{url('home/goodsDetail/'.$good->goods_id)}}">
					<span>
						<img style='width:220px;height:293px' src="{{rtrim($good->original_img,',')}}" alt="">
					</span>
							<p class="text">{{getBrand($good->brand_id)}}</p>
							<p class="text">{{$good->goods_name}}</p>
							<p class="text">¥ {{$good->shop_price}}</p>
						</a>
					@endforeach
						@endif
				</div>
			</div>
		</div>
	</div>

	<center>
		<div id="pages" style="margin-top:5px; text-align:center;   margin-left: 170px;">

			{{--@if($request->only(['cate']))--}}
				{!!$goods->appends($request->only(['cate']))->render()!!}
{{--{{dump($goods->links())}}--}}
				{{--{{dump($request->only(['order','dir','cate','page']))}}--}}
			{{--@if($request->get('order'))--}}
				{{--{!!$goods->appends($request->only(['cate','order ', 'dir', 'page']))->render()!!}--}}

			{{--@else--}}
				{{--{!!$goods->appends($request->only(['cate']))->render()!!}--}}
				{{--@endif--}}
{{--				{!!$goods->appends(['cate','order ', 'dir', 'page'])->render()!!}--}}
{{--				{!!$goods->appends($request->only(['order','dir','cate','page']))->links()!!}--}}
			{{--@endif--}}
		</div>
	</center>
@endsection

@section('shop')

@endsection

@section('js')
	<script src="{{asset('/templates/home/js/dynamic.js')}}"></script>
	<script>
		//获取url上的参数 直接传参数名称
		jQuery(document).ready(function(){
			function updateQueryStringParameter(uri, key, value) {
				var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
				var separator = uri.indexOf('?') !== -1 ? "&" : "?";
				if (uri.match(re)) {
					return uri.replace(re, '$1' + key + "=" + value + '$2');
				}
				else {
					return uri + separator + key + "=" + value;
				}
			}
			//最新
			jQuery('#NEW').on('click',function(){
				var url = updateQueryStringParameter(window.location.toString(), 'order', 'is_new');
				url = updateQueryStringParameter(url, 'dir', 'desc');
				url = updateQueryStringParameter(url, 'page', '1');
				window.location.href = url;

			});
			//销量
			jQuery('#BEST').on('click',function(){
				var url = updateQueryStringParameter(window.location.toString(), 'order', 'sales_sum');
				url = updateQueryStringParameter(url, 'dir', 'desc');
				url = updateQueryStringParameter(url, 'page', '1');
				window.location.href = url;
				return false;
			});
			//价格
			jQuery("#PRICE").on('click',function(){
				var price_id = jQuery(this).find('.price_on').prop('id');
				if(price_id){
					if( price_id == 'LOW_PRICE'){
						var url = updateQueryStringParameter(window.location.toString(), 'order', 'shop_price');
						url = updateQueryStringParameter(url, 'dir', 'desc');
						url = updateQueryStringParameter(url, 'page', '1');
						window.location.href = url;
						console.log(url);
					}
					else if( price_id == 'HIGH_PRICE'){
						var url = updateQueryStringParameter(window.location.toString(), 'order', 'shop_price');
						url = updateQueryStringParameter(url, 'dir', 'asc');
						url = updateQueryStringParameter(url, 'page', '1');
						window.location.href = url;
						console.log(url);
					}
				}else{
					var url = updateQueryStringParameter(window.location.toString(), 'order', 'shop_price');
					url = updateQueryStringParameter(url, 'dir', 'asc');
					url = updateQueryStringParameter(url, 'page', '1');
					window.location.href = url;
					console.log(url);
				}
			});




		});

	</script>
@endsection
