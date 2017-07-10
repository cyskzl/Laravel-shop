@extends('home.layouts.layout')

@section('title','尤为首页')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/main.css')}}">
	<style>
		span {
			display: block;
		}
	</style>
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

		@foreach($advertisement as $advertis)
			@if($cateId == 1)
				@if($advertis->name =='首页')
					<a href="home/goodsList/3?cate=3">
						<img src="{{rtrim($advertis->logo, ',')}}" alt="" />
					</a>
				@endif
			@else
				@if($advertis->name =='男士首页')
					<a href="home/goodsList/3?cate=3">
						<img src="{{rtrim($advertis->logo, ',')}}" alt="" />
					</a>
				@endif
			@endif
		@endforeach

	</div>
	<!--最新上架-->
	<div class="putaway width clear">
		<!--标题-->
		<div class="title">
			<h2>最新上架</h2>
			<a href="http://www.project.com/home/goodsList/3?cate=3">MORE</a>
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
						<a href="{{url('/home/goodsDetail/'.$newgoods->goods_id)}}">
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
				@foreach($goodstabcate as $k=>$tabcate)
					@if($k==0)
						<li cate_id = '{{$tabcate->cat_id}}' exists="1">{{$tabcate->name}}</li>
					@else
						<li cate_id = '{{$tabcate->cat_id}}'>{{$tabcate->name}}</li>
					@endif

				@endforeach
				{{--<li class="borl">T恤</li>--}}
			</ul>
		</div>
		<!--全部展示的商品-->
		<div class="category-around width" id="category-around">
			<div class="category-show width cen ">
				@foreach($goodsTabOneCate as $tabonecate)
					<div class="cateshow">
						<a href="{{url('/home/goodsDetail/'.$tabonecate->goods_id)}}">
							<img src="{{rtrim($tabonecate->original_img,',')}}"   class="img">
							<span class="brand color">{{getBrand($tabonecate->brand_id)}}</span>
							<span class="name color">{{$tabonecate->goods_name}}</span>
							<span class="price">¥&nbsp;{{$tabonecate->shop_price }}</span>
						</a>
					</div>
				@endforeach
			</div>
			@for($i=2;$i<=count($goodstabcate);$i++)
				<div class="category-show width cen " id="{{$i}}">
				</div>
			@endfor
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
				@foreach($brands as $brand)
					<li>
						<a href="{{$brand->url}}">
							<img src="{{rtrim($brand->logo,',')}}">
							<span class="color">{{$brand->name}}</span>
						</a>
					</li>
				@endforeach


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
	@foreach($trendpromotion as $key => $trend)
	<div class="design width">
		<!--标题-->
		<div class="title ">
			<h2>{{$trend->name}}</h2>
			<a href="javascript:">MORE</a>
		</div>
		<div class="design-banner space-between">

			@foreach($trends[$key] as $k=>$value)
			<img src="{{$value}}"  alt="" />
{{--			<img src="{{$trends[1]}}"  alt="" />--}}
				@endforeach
		</div>
		<!--全部商品-->
		<div class="design-list space-between">
			<!--每列商品-->
			<!--第一列商品-->

			@foreach($goodstren as $goodstrens)
				@if($goodstrens->trendpro_id == $trend->id)
			<div class="design-show ">
				<a href="{{url('home/goodsDetail/')}}/{{$goodstrens->goods_id}}">
					<img src="{{rtrim($goodstrens->original_img,',')}}" alt=""  class="img">
					<span class="brand color">{{getBrand($goodstrens->brand_id)}}</span>
					<span class="name color nowrap">{{$goodstrens->goods_name}}</span>
					<span class="price">¥&nbsp;{{$goodstrens->shop_price}}</span>
				</a>
			</div>
				@endif
		@endforeach

		</div>
	</div>
	@endforeach
	<!--促销-->


	<!--热销商品-->
	<div class="hotProduct width ">
		<!--标题-->
		<div class="title">
			<h2>热销商品</h2>
			<a href="javascript:">MORE</a>
		</div>
		<!--全部商品-->
		<div class="hotProduct-list clear" id="flow">
			<!--第一件商品,完成-->
			@foreach($sales_sum as $sum)
				<div class="hotProduct-show">
					<a href="{{url('home/goodsDetail/')}}/{{$sum->goods_id}}">
						<img src="{{rtrim($sum->original_img,',')}}"  alt=""  class="img">
						<span class="brand color">{{getBrand($sum->brand_id)}}</span>
						<span class="name color nowrap">{{$sum->goods_name}}</span>
						<span class="price">¥&nbsp;{{$sum->shop_price}}</span>
					</a>
				</div>
			@endforeach
		</div>

		{{--<div class="more">--}}
		{{--<a href="javascript:">查看更多</a>--}}
		{{--</div>--}}
	</div>
@endsection

@section('shop')

@endsection
@section('js')
	<script src="{{asset('/templates/home/js/dynamic.js')}}"></script>
	<script src="{{asset('/templates/home/js/carousel.js')}}"></script>
	<script>

		layui.use('flow', function(){
			var $ = layui.jquery; //不用额外加载jQuery，flow模块本身是有依赖jQuery的，直接用即可。
			var flow = layui.flow;
			//			var layer = layui.layer;
//				flow.lazyimg();

			
			flow.load({
				elem: '#flow'
				//指定列表容器
				,isAuto: false
				,isLazyimg: true
				,scrollElem: '#flow'
				,done: function(page, next){ //到达临界点（默认滚动触发），触发下一页
					var lis = [];
					var pages;
					var str = '';
					//以jQuery的Ajax请求为例，请求下一页数据（注意：page是从2开始返回）
					$.ajax({
						type: 'post',
						url : '/home/flow?page='+page,
						data:{ 'currentIndex': page ,'_token':'{{csrf_token()}}'}
						,success: function (res){
							if(res.flow.data.length > 0){
								for(var i=0; i<res.flow.data.length;i++){
									var original_img = res.flow.data[i]['original_img'] ;
									original_img = original_img.substring(0,original_img.length-1);
									str += '<div class="hotProduct-show">';
									str += '<a href="home/goodsDetail/'+res.flow.data[i]['goods_id']+'">';
									str += '<img lay-src="'+original_img+'"   class="img">';
									str += '<span class="brand color">'+res.brand[i]+'</span>';
									str += '<span class="name color nowrap">'+res.flow.data[i]['goods_name']+'</span>';
									str += '<span class="price">¥&nbsp;'+res.flow.data[i]['shop_price']+'</span>';
									str += '</a> </div>';
								}
								lis.push(str);
							}
							//执行下一页渲染，第二参数为：满足“加载更多”的条件，即后面仍有分页
							//pages为Ajax返回的总页数，只有当前页小于总页数的情况下，才会继续出现加载更多
							pages = res.last_page;
							next(lis.join(''), page < 4);
						}
					});
				}

			});
		});


		//加载选项卡代码
		$('.clear li').mouseenter(function(){
			//判断是否有class  borl
			if($(this).hasClass('borl')){
				var that = $(this);
				var three_cate_id = that.attr('cate_id');
				//切分3级的id
				var arr = three_cate_id.split('_');
				var cate_id ={{$cateId}}
				bool = that.attr('exists') ;
				//获取时候等于undefined就请求，有自定义的属性值不请求
				if(!bool){
					//加载成功后在对应的li下加入自定义属性
					that.attr('exists', '1');
					var strs = '';
					$.ajax({
						type: "get",
						url: "/home/getAjaxTab",
						data: {'_token': '{{csrf_token()}}', 'three_cate_id': arr[2], 'cate_id': cate_id},
						success: function (data) {
							if(!data){
								that.removeattr('exists');
							}
							//遍历在视图
							for(var i=0;i<data.goods.length;i++){
								//清除最后一个字符
								var original_img = data.goods[i]['original_img'] ;
								original_img=original_img.substring(0,original_img.length-1);
								strs += '<div class="cateshow ">';
								strs += '<a href="/home/goodsDetail/'+data.goods[i]['goods_id']+'">';
								strs += '<img src='+original_img+' class="img">';
								strs += '<span class="brand color">'+data.brand[i]+'</span>';
								strs += '<span class="name color">'+data.goods[i]['goods_name']+'</span>';
								strs += '<span class="price">¥&nbsp;'+data.goods[i]['shop_price']+'</span> </a> </div>';

							}
							//和li对应索引
							$('#category-around .category-show').eq( that.index() ).html(strs);

						}
					})
				}
			}
		});


	</script>

@endsection
