@extends('home.layouts.layout')

@section('title','尤为首页')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/main.css')}}">
@endsection

@section('main')
		<!-- 主体内容 -->
		<!--广告 banner-->
		<div class="banner width" id="banner">
			<!--轮播图-->
			<div class="silder" id="silder-list" style="margin-left:-1100px;">
					<!--最后一张图片-->
				<a href=""><img name="car_img" src="{{rtrim($carousel[2]['img'],',')}}" ></a>
                    <!--第一张图片-->
				<a href=""><img name="car_img" src="{{rtrim($carousel[0]['img'],',')}}"></a>
				<a href=""><img name="car_img" src="{{rtrim($carousel[1]['img'],',')}}"></a>
					<!--最后一张图片-->
				<a href=""><img name="car_img" src="{{rtrim($carousel[2]['img'],',')}}" ></a>
					<!--第一张图片-->
				<a href=""><img name="car_img" src="{{rtrim($carousel[0]['img'],',')}}"></a>
			</div>
				<!--小圆点-->
			<div class="dot" id="round">
				   <i class="sel" index=1></i>
				   <i index=2></i>
				   <i index=3></i>
			</div>
			<!--箭头按钮-->
			<a href="javascript:" id="prev" class="arrow1 arrow"></a>
			<a href="javascript:" id="next" class="arrow2 arrow"></a>
		</div>
		<!--小广告  smallbanner-->
		<div class="smallbanner width clear">
			<a href="javascript:">
				<img src="{{asset('/templates/home/uploads/smallbanner-1.jpg')}}" alt="" />
			</a>
			<a href="javascript:">
				<img src="{{asset('/templates/home/uploads/smallbanner-2.jpg')}}" alt="" />
			</a>
		</div>
		<!--最新上架-->
		<div class="putaway width clear">
			<!--标题-->
			<div class="title">
				<h2>最新上架</h2>
				<a href="javascript:;">MORE</a>
			</div>
			<!--可视页面-->
			<div class="putaway-over width">
				<!--整个div-->
				<!--按钮-->
				<div class="button">
					<div class="left" id='left'>
						<img src="{{asset('/templates/home/uploads/zuo.png')}}" alt="" />
					</div>
					<div class="right" id='right'>
						<img src="{{asset('/templates/home/uploads/you.png')}}" alt="" />
					</div>
				</div>
				<div class="putaway-around clear" id="putaway" style="left: 0px;">
					<!--点击切换效果(总共八张图片)-->
					<!--第一张-->
					@foreach($newest as $newgoods)
					<div class="putshow ">
						<a href="{{asset('/home/goodsDetail/'.$newgoods->goods_id)}}">
							<img src="{{rtrim($newgoods->original_img, ',')}}"  />
							<span class="brand color">{{getBrand($newgoods->brand_id)}}</span>
							<span class="name color">{{$newgoods->goods_name}}</span>
							<span class="price">¥&nbsp;{{$newgoods->shop_price}}</span>
						</a>
					</div>
					@endforeach
				</div>
			</div>
		</div>

		<!--设计师-->
		<div class="designer width ">
			<div class="title ">
				<h2>设计师</h2>
				<a href="javascript:">MORE</a>
			</div>
			<div class="interview">
				<a href="">
					<img src="" alt="" />
				</a>
				<a href="javascript:">
					<img src="" alt="" />
				</a>
			</div>
		</div>

		<!--热门品类-->
		<div class="category width">
			<div class="title">
				<h2>热门推荐</h2>
			</div>
			<!--商品分类-->
			<div class="category-list">
				<ul class="clear">
					@foreach($goodstabcate as $tabcate)
					<li cate_id = '{{$tabcate->cat_id}}'>{{$tabcate->name}}</li>
					@endforeach
					{{--<li class="borl">T恤</li>--}}
				</ul>
			</div>
			<!--全部展示的商品-->
			<div class="category-around width">
				<!--第一列  衬衫 遍历-->
				{{--<div class="category-show width cen ">--}}

				{{--</div>--}}
				{{--@foreach($goodsTabOneCate as $tabonecate)--}}
					<div class="cateshow">
						<a href="javascript;" >
							<img src=""   class="img">
							<span class="brand color">NUMBERING</span>
							<span class="name color">{{$goodsTabOneCate->goods_name}}</span>
							<span class="price">¥&nbsp;{{$goodsTabOneCate->shop_price }}</span>
						</a>
					</div>
				{{--@endforeach--}}
				<!--第二列 T恤-->


			</div>
		</div>


		<!--热门品牌-->
		<div class="hot-brand width">
			<div class="title ">
				<h2>热门品牌</h2>
				<a href="javascript:">MORE</a>
			</div>
			<div class="hot-brand-list">
				<ul>
					<!--第一章图片-->
					<li>
						<a href="javascript:">
							<img src="{{asset('/templates/home/uploads/3.jpg')}}" alt="" />
							<span class="color">Yuul&nbsp;Yie</span>
						</a>
					</li>
					<!--第二张图片-->
					<li>
						<a href="javascript:">
							<img src="{{asset('/templates/home/uploads/3.jpg')}}" alt="" />
							<span class="color">Yuul&nbsp;Yie</span>
						</a>
					</li>
					<li>
						<a href="javascript:">
							<img src="{{asset('/templates/home/uploads/3.jpg')}}" alt="" />
							<span class="color">Yuul&nbsp;Yie</span>
						</a>
					</li>
					<li>
						<a href="javascript:">
							<img src="{{asset('/templates/home/uploads/3.jpg')}}" alt="" />
							<span class="color">Yuul&nbsp;Yie</span>
						</a>
					</li>
					<li>
						<a href="javascript:">
							<img src="{{asset('/templates/home/uploads/3.jpg')}}" alt="" />
							<span class="color">Yuul&nbsp;Yie</span>
						</a>
					</li>
				</ul>
			</div>
		</div>

		<!--博主控-->
		<div class="master width">
			<div class="title ">
				<h2>博主控</h2>
				<a href="javascript:">MORE</a>
			</div>
			<!--商品-->
			<div class="master-show width cen ">
					<!--第一列    共四列-->
					<div class="masthow ">
							<a href="javascript:">
							<div class="atcpic">
								<img src="{{asset('/templates/home/uploads/7.jpg')}}" alt=""  class="img">
								<!--关注人数-->
								<div class="attention clear">
									<div class="attention-left">
										<img src="{{asset('/templates/home/uploads/2.jpg')}}" alt="" />
										<span>阿布</span>
									</div>
									<div class="attention-right">
										<span>关注</span>
										<em>17</em>
									</div>
								</div>
							</div>
								<span class="brand color">NUMBERING</span>
								<span class="name color">不对称水晶钻圆环耳钉_金色</span>
								<span class="price">¥&nbsp;627</span>
							</a>
					</div>
					<!--第二列    共四列-->
					<div class="masthow ">
							<a href="javascript:">
							<div class="atcpic">
								<img src="{{asset('/templates/home/uploads/1.jpg')}}" alt=""  class="img">
								<!--关注人数-->
								<div class="attention clear">
									<div class="attention-left">
										<img src="{{asset('/templates/home/uploads/1.jpg')}}" alt="" />
										<span>阿布</span>
									</div>
									<div class="attention-right">
										<span>关注</span>
										<em>17</em>
									</div>
								</div>
							</div>
								<span class="brand color">NUMBERING</span>
								<span class="name color">不对称水晶钻圆环耳钉_金色</span>
								<span class="price">¥&nbsp;222</span>
							</a>
					</div>
					<!--第三列    共四列-->
					<div class="masthow ">
							<a href="javascript:">
							<div class="atcpic">
								<img src="{{asset('/templates/home/uploads/1.jpg')}}" alt=""  class="img">
								<!--关注人数-->
								<div class="attention clear">
									<div class="attention-left">
										<img src="{{asset('/templates/home/uploads/1.jpg')}}" alt="" />
										<span>阿布</span>
									</div>
									<div class="attention-right">
										<span>关注</span>
										<em>17</em>
									</div>
								</div>
							</div>
								<span class="brand color">NUMBERING</span>
								<span class="name color">不对称水晶钻圆环耳钉_金色</span>
								<span class="price">¥&nbsp;222</span>
							</a>
					</div>

				</div>
		</div>

		<!--潮流穿搭-->
		<div class="design width">
			<!--标题-->
			<div class="title ">
				<h2>潮流穿搭</h2>
				<a href="javascript:">MORE</a>
			</div>
			<div class="design-banner space-between">
				<img src=""  alt="" />
				<img src=""  alt="" />
			</div>
			<!--全部商品-->
			<div class="design-list space-between">
				<!--每列商品-->
				<!--第一列商品-->
				<div class="design-show ">
					<a href="javascript:">
						<img src="{{asset('/templates/home/uploads/8.jpg')}}" alt=""  class="img">
						<span class="brand color">NUMBERING</span>
						<span class="name color nowrap">不对称水晶钻圆环耳钉_金色</span>
						<span class="price">¥&nbsp;627</span>
					</a>
				</div>
					<!--每列商品-->
				<div class="design-show ">
					<a href="javascript:">
						<img src="{{asset('/templates/home/uploads/1.jpg')}}" alt=""  class="img">
						<span class="brand color">NUMBERING</span>
						<span class="name color">不对称水晶钻圆环耳钉_金色</span>
						<span class="price">¥&nbsp;627</span>
					</a>
				</div>
					<!--每列商品-->
				<div class="design-show ">
					<a href="javascript:">
						<img src="{{asset('/templates/home/uploads/1.jpg')}}" alt=""  class="img">
						<span class="brand color">NUMBERING</span>
						<span class="name color">不对称水晶钻圆环耳钉_金色</span>
						<span class="price">¥&nbsp;627</span>
					</a>
				</div>
					<!--每列商品-->
				<div class="design-show ">
					<a href="javascript:">
						<img src="{{asset('/templates/home/uploads/1.jpg')}}" alt=""  class="img">
						<span class="brand color">NUMBERING</span>
						<span class="name color">不对称水晶钻圆环耳钉_金色</span>
						<span class="price">¥&nbsp;627</span>
					</a>
				</div>
					<!--每列商品-->
				<div class="design-show ">
					<a href="javascript:">
						<img src="{{asset('/templates/home/uploads/1.jpg')}}" alt=""  class="img">
						<span class="brand color">NUMBERING</span>
						<span class="name color">不对称水晶钻圆环耳钉_金色</span>
						<span class="price">¥&nbsp;627</span>
					</a>
				</div>
					<!--每列商品-->
				<div class="design-show ">
					<a href="javascript:">
						<img src="{{asset('/templates/home/uploads/1.jpg')}}" alt=""  class="img">
						<span class="brand color">NUMBERING</span>
						<span class="name color">不对称水晶钻圆环耳钉_金色</span>
						<span class="price">¥&nbsp;627</span>
					</a>
				</div>
			</div>
		</div>

		<!--促销-->
		<div class="promotion width">
			<!--标题-->
			<div class="title ">
					<h2>促销</h2>
					<a href="javascript:">MORE</a>
				</div>
			<!--小广告-->
			<div class="promotion-banner space-between">
				<img src=""  alt="" />
				<img src=""  alt="" />
			</div>
			<!--全部商品-->
			<div class="promotion-list space-between">
					<!--每列商品-->
					<!--第一列商品-->
					<div class="promotion-show">
						<a href="javascript:">
							<img src="{{asset('/templates/home/images/123.jpg')}}" alt=""  class="img">
							<span class="brand color">NUMBERING</span>
							<span class="name color nowrap">不对称水晶钻圆环耳钉_金色</span>
							<span class="price">¥&nbsp;627</span>
						</a>
					</div>
					<!--第二列商品-->
					<div class="promotion-show">
						<a href="javascript:">
							<img src="{{asset('/templates/home/images/123.jpg')}}" alt=""  class="img">
							<span class="brand color">NUMBERING</span>
							<span class="name color nowrap">不对称水晶钻圆环耳钉_金色</span>
							<span class="price">¥&nbsp;627</span>
						</a>
					</div>
			</div>

			<!--最新-->
			<div class="newest">
				<!--最新韩流-->
				<div class="newly">
					<h3>最新潮流</h3>
					<img src=""  alt="" />
					<h4>Hot&nbsp;Crop夏日套装</h4>
					<p class="color">酷夏又是Crop Top盛行的季节</p>
					<a href="javascript:">MORE</a>
				</div>
				<!--热门话题-->
				<div class="newly">
					<h3>热门话题</h3>
					<img src=""  alt="" />
					<h4>Hot&nbsp;Crop夏日套装</h4>
					<p class="color">酷夏又是Crop Top盛行的季节</p>
					<a href="javascript:">MORE</a>
				</div>
				<!--最新活动-->
				<div class="newly">
					<h3>最新活动</h3>
					<img src=""  alt="" />
					<h4>Hot&nbsp;Crop夏日套装</h4>
					<p class="color">酷夏又是Crop Top盛行的季节</p>
					<a href="javascript:">MORE</a>
				</div>
			</div>
		</div>

		<!--热销商品-->
		<div class="hotProduct width ">
			<!--标题-->
			<div class="title">
				<h2>热销商品</h2>
				<a href="javascript:">MORE</a>
			</div>
			<!--全部商品-->
			<div class="hotProduct-list clear">
				<!--第一件商品,完成-->
				@foreach($sales_sum as $sum)
				<div class="hotProduct-show">
					<a href="{{url('home/goodsDetail/')}}/{{$sum->goods_id}}">
						<img src="{{rtrim($sum->original_img,',')}}"  alt=""  class="img">
						<span class="brand color">NUMBERING</span>
						<span class="name color nowrap">{{$sum->goods_name}}</span>
						<span class="price">¥&nbsp;{{$sum->shop_price}}</span>
					</a>
				</div>
				@endforeach
			</div>


			<div class="more">
				<a href="javascript:">查看更多</a>
			</div>
		</div>
@endsection

@section('shop')
	<div class="cart">
		<a href="{{ url('home/shoppingcart') }}">
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
	<script src="{{asset('/templates/home/js/carousel.js')}}"></script>
	<script>

		var cate_id ={{$cateId}}
		three_cate_id = $('.clear li').attr('cate_id');
		var arr = three_cate_id.split('_');
//		 alert($("div").siblings(".category-around").eq(0).find('.category-show'));
		//判断是否是第一个
		var str = '';
		{{--$('.clear li').each(function(){--}}
			{{--var that = $(this);--}}
				{{--var thatli = $(this).index();--}}
{{--//			alert(thatli)--}}
				{{--if(thatli == '0'){--}}
{{--//					$(this).parent().parent().next().find('.category-show').children().remove();--}}
					{{--$.ajax({--}}
						{{--type: "get",--}}
						{{--url: "/home/getAjaxTab",--}}
						{{--data: {'_token': '{{csrf_token()}}', 'three_cate_id': arr[2], 'cate_id': cate_id},--}}
						{{--success: function (data) {--}}
{{--//							alert(1)--}}
							{{--str += '<div class="category-show width cen ">';--}}
							{{--for(var i=0;i<data.goods.length;i++){--}}
								{{--var original_img = data.goods[i]['original_img'] ;--}}
								{{--original_img=original_img.substring(0,original_img.length-1);--}}

								{{--str += '<div class="cateshow ">';--}}
								{{--str += '<a href="javascript;">';--}}
								{{--str += '<img src='+original_img+'  class="img">';--}}
								{{--str += '<span class="brand color">'+data.brand[i]+'</span>';--}}
								{{--str += '<span class="name color">'+data.goods[i]['goods_name']+'</span>';--}}
								{{--str += '<span class="price">¥&nbsp;'+data.goods[i]['shop_price']+'</span> </a> </div>';--}}
							{{--}--}}
							{{--str += '</div>';--}}
							{{--$('.category-around').append(str);--}}
{{--//							that.parent().attr('exists', '1');--}}
						{{--}--}}

					{{--});--}}
				{{--}--}}
		{{--});--}}

		$('.clear li').mouseenter(function(){

//			if($(this).hasClass('borl')){

//				$(this).parent().parent().next().find('.category-show').children().remove();
//				console.log($(this).parent('.clear').parent('.category-list').siblings().find('.category-around'));
			var that = $(this);
			var three_cate_id = that.attr('cate_id');
			var arr = three_cate_id.split('_');
			var cate_id ={{$cateId}}
            bool = that.attr('exists') ;

			if(!bool){
//				$('.category-show').children().remove();

					$.ajax({
					type: "get",
					url: "/home/getAjaxTab",
					data: {'_token': '{{csrf_token()}}', 'three_cate_id': arr[2], 'cate_id': cate_id},
					success: function (data) {

						var strs = '';
						strs += '<div class="category-show width cen ">';
						for(var i=0;i<data.goods.length;i++){
							var original_img = data.goods[i]['original_img'] ;
							original_img=original_img.substring(0,original_img.length-1);
							strs = '<div class="cateshow ">';
							strs += '<a href="javascript;">';
							strs += '<img src='+original_img+' class="img">';
							strs += '<span class="brand color">'+data.brand[i]+'</span>';
							strs += '<span class="name color">'+data.goods[i]['goods_name']+'</span>';
							strs += '<span class="price">¥&nbsp;'+data.goods[i]['shop_price']+'</span> </a> </div>';
						}
						strs += '</div>';
						$('.category-around').append(strs);
//						$('.category-show').parent().attr('exists', '1');
						that.attr('exists', '1');
					}
				})
			}
//			}
		});










	</script>

@endsection
