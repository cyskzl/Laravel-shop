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
	<div id="pages" style="margin-top:5px; text-align:center;   margin-left: 170px;">
		{!!$goods->appends($request->only(['cate']))->render()!!}
	</div>
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
		//获取url上的参数 直接传参数名称
		function GetQueryString(name)
		{
			var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
			var r = window.location.search.substr(1).match(reg);
			if(r!=null)return  unescape(r[2]); return null;
		}
//		alert('cate')
		{{--layui.use(['laypage', 'layer'], function(){--}}
			{{--var laypage = layui.laypage--}}
					{{--,layer = layui.layer;--}}

			{{--function page()--}}
			{{--{--}}
				{{--//2级参数--}}
{{--//				if(GetQueryString("cate") !== null){--}}
{{--//					var url =  '/home/goodsTwo';--}}
{{--//				} else {--}}
{{--//					//3级参数--}}
{{--//					var url =  '/home/goodsTree';--}}
{{--//				}--}}
				{{--var curr ={{$goods->links()}}--}}
{{--//				laypage({--}}
{{--//					cont: 'pages',--}}
{{--//					skin: '#333', //加载内置皮肤，也可以直接赋值16进制颜色值，如:#c00--}}
{{--//					pages: 8, //可以叫服务端把总页数放在某一个隐藏域，再获取。假设我们获取到的是18--}}
{{--//					curr: function(){ //通过url获取当前页，也可以同上（pages）方式获取--}}
{{--//						var page = location.search.match(/page=(\d+)/);--}}
{{--//						return page ? page[1] : 1;--}}
{{--//					}(),--}}
{{--//					jump: function(e, first){ //触发分页后的回调--}}
{{--//						if(!first){ //一定要加此判断，否则初始时会无限刷新--}}
{{--//							location.href = '?page='+e.curr;--}}
{{--//--}}
{{--//						}--}}
{{--//					}--}}
{{--//				});--}}
{{--//			}--}}
{{--//			page()--}}
		{{--});--}}


	</script>
@endsection



