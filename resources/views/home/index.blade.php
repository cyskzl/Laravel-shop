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
				<a href=""><img name="car_img" src="{{asset('/templates/home/uploads/sider-3.jpg')}}" alt="" /></a>
                    <!--第一张图片-->
				<a href=""><img name="car_img" src="{{asset('/templates/home/uploads/silder-1.jpg')}}" alt="" /></a>
				<a href=""><img name="car_img" src="{{asset('/templates/home/uploads/sider-2.jpg')}}" alt="" /></a>
					<!--最后一张图片-->
				<a href=""><img name="car_img" src="{{asset('/templates/home/uploads/sider-3.jpg')}}" alt="" /></a>
					<!--第一张图片-->
				<a href=""><img name="car_img" src="{{asset('/templates/home/uploads/silder-1.jpg')}}" alt="" /></a>
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
		<div class="putaway width">
			<!--标题-->
			<div class="title">
				<h2>最新上架</h2>
				<a href="javascript:">MORE</a>
			</div>
			<!--可视页面-->
			<div class="putaway-over width">
				<!--整个div-->
				<!--按钮-->
				<div class="button">
					<div class="left">
						<img src="{{asset('/templates/home/uploads/zuo.png')}}" alt="" />
					</div>
					<div class="right">
						<img src="{{asset('/templates/home/uploads/you.png')}}" alt="" />
					</div>
				</div>
				<div class="putaway-around clear">
				<!--按钮-->
					<!--点击切换每张-->
					<!--第一张-->
					<div class="putshow">
						<a href="javascript:">
							<img src="" alt="" />
							<span class="brand color">NUMBERING</span>
							<span class="name color">不对称水晶钻圆环耳钉_金色</span>
							<span class="price">¥&nbsp;627</span>
						</a>
					</div>
					<!--第二张-->
					<div class="putshow">
						<a href="javascript:">
							<img src="" alt="" />
							<span class="brand color">NUMBERING</span>
							<span class="name color">不对称水晶钻圆环耳钉_金色</span>
							<span class="price">¥&nbsp;627</span>
						</a>
					</div>
					<!--第三张-->
					<div class="putshow">
						<a href="javascript:">
							<img src="" alt="" />
							<span class="brand color">NUMBERING</span>
							<span class="name color">不对称水晶钻圆环耳钉_金色</span>
							<span class="price">¥&nbsp;627</span>
						</a>
					</div>
					<!--第四张-->
					<div class="putshow">
						<a href="javascript:">
							<img src="" alt="" />
							<span class="brand color">NUMBERING</span>
							<span class="name color">不对称水晶钻圆环耳钉_金色</span>
							<span class="price">¥&nbsp;627</span>
						</a>
					</div>
					<!--第五张  开始设置隐藏-->
					<div class="putshow">
						<a href="javascript:">
							<img src="" alt="" />
							<span class="brand color">NUMBERING</span>
							<span class="name color">不对称水晶钻圆环耳钉_金色</span>
							<span class="price">¥&nbsp;627</span>
						</a>
					</div>
					<div class="putshow">
						<a href="javascript:">
							<img src="" alt="" />
							<span class="brand color">NUMBERING</span>
							<span class="name color">不对称水晶钻圆环耳钉_金色</span>
							<span class="price">¥&nbsp;627</span>
						</a>
					</div>
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
				<h2>热门品类</h2>
			</div>
			<!--商品分类-->
			<div class="category-list">
				<ul class="clear">
					<li><a href="javascript:">衬衫</a></li>
					<li><a href="javascript:">T恤</a></li>
					<li><a href="javascript:">裙装</a></li>
					<li><a href="javascript:">牛仔</a></li>
					<li><a href="javascript:">泳装</a></li>
					<li><a href="javascript:">裤装</a></li>
					<li><a href="javascript:">凉鞋/凉拖</a></li>
					<li><a href="javascript:">包类</a></li>
				</ul>
			</div>
			<!--全部展示的商品-->
			<div class="category-around width">
				<!--第一列-->
				<div class="category-show width cen ">
					<div class="cateshow ">
							<a href="javascript:">
								<img src="{{asset('/templates/home/uploads/1.jpg')}}" alt="" class="img">
								<span class="brand color">NUMBERING</span>
								<span class="name color">不对称水晶钻圆环耳钉_金色</span>
								<span class="price">¥&nbsp;627</span>
							</a>
					</div>
					<div class="cateshow">
							<a href="javascript:" >
								<img src="" alt=""  class="img">
								<span class="brand color">NUMBERING</span>
								<span class="name color">不对称水晶钻圆环耳钉_金色</span>
								<span class="price">¥&nbsp;627</span>
							</a>
					</div>
					<div class="cateshow">
							<a href="javascript:" >
								<img src="" alt=""  class="img">
								<span class="brand color">NUMBERING</span>
								<span class="name color">不对称水晶钻圆环耳钉_金色</span>
								<span class="price">¥&nbsp;627</span>
							</a>
					</div>
					<div class="cateshow">
							<a href="javascript:" >
								<img src="" alt=""  class="img">
								<span class="brand color">NUMBERING</span>
								<span class="name color">不对称水晶钻圆环耳钉_金色</span>
								<span class="price">¥&nbsp;627</span>
							</a>
					</div>

				</div>
				<!--第二列-->
				<div class="category-show width cen">
						<div class="cateshow ">
								<a href="javascript:">
									<img src="{{asset('/templates/home/uploads/2.jpg')}}" alt=""  class="img">
									<span class="brand color">NUMBERING</span>
									<span class="name color">不对称水晶钻圆环耳钉_金色</span>
									<span class="price">¥&nbsp;627</span>
								</a>
						</div>
						<div class="cateshow">
								<a href="javascript:" >
									<img src="" alt=""  class="img">
									<span class="brand color">NUMBERING</span>
									<span class="name color">不对称水晶钻圆环耳钉_金色</span>
									<span class="price">¥&nbsp;627</span>
								</a>
						</div>
						<div class="cateshow">
								<a href="javascript:" >
									<img src="" alt=""  class="img">
									<span class="brand color">NUMBERING</span>
									<span class="name color">不对称水晶钻圆环耳钉_金色</span>
									<span class="price">¥&nbsp;627</span>
								</a>
						</div>
						<div class="cateshow">
								<a href="javascript:" >
									<img src="" alt=""  class="img">
									<span class="brand color">NUMBERING</span>
									<span class="name color">不对称水晶钻圆环耳钉_金色</span>
									<span class="price">¥&nbsp;627</span>
								</a>
						</div>
				</div>
				<!--第三列-->
				<div class="category-show width cen">
					<div class="cateshow ">
							<a href="javascript:">
								<img src="{{asset('/templates/home/uploads/1.jpg')}}" alt=""  class="img">
								<span class="brand color">NUMBERING</span>
								<span class="name color">不对称水晶钻圆环耳钉_金色</span>
								<span class="price">¥&nbsp;627</span>
							</a>
					</div>
					<div class="cateshow">
							<a href="javascript:" >
								<img src="" alt=""  class="img">
								<span class="brand color">NUMBERING</span>
								<span class="name color">不对称水晶钻圆环耳钉_金色</span>
								<span class="price">¥&nbsp;627</span>
							</a>
					</div>
					<div class="cateshow">
							<a href="javascript:" >
								<img src="" alt=""  class="img">
								<span class="brand color">NUMBERING</span>
								<span class="name color">不对称水晶钻圆环耳钉_金色</span>
								<span class="price">¥&nbsp;627</span>
							</a>
					</div>
					<div class="cateshow">
							<a href="javascript:" >
								<img src="" alt=""  class="img">
								<span class="brand color">NUMBERING</span>
								<span class="name color">不对称水晶钻圆环耳钉_金色</span>
								<span class="price">¥&nbsp;627</span>
							</a>
					</div>

				</div>
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
				<!--第一件商品-->
				<div class="hotProduct-show">
					<a href="javascript:">
						<img src=""  alt=""  class="img">
						<span class="brand color">NUMBERING</span>
						<span class="name color nowrap">不对称水晶钻圆环耳钉_金色发大方的说法</span>
						<span class="price">¥&nbsp;627</span>
					</a>
				</div>
				<!--第二件商品-->
				<div class="hotProduct-show">
					<a href="javascript:">
						<img src=""  alt=""  class="img">
						<span class="brand color">NUMBERING</span>
						<span class="name color nowrap">不对称水晶钻圆环耳钉_金色大方的说法</span>
						<span class="price">¥&nbsp;627</span>
					</a>
				</div>
			</div>
			<div class="more">
				<a href="javascript:">查看更多</a>
			</div>
		</div>
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
	<script src="{{asset('/templates/home/js/carousel.js')}}"></script>
	<script type="text/javascript">
		$(function(){
			if (!$.session.get("currentCategoryId")){

				$('.header_top_bottom_people a')[0].setAttribute('class','women');
				$('.header_top_bottom_people a')[0].style='color:#fff';

			} else {

				var id = $.session.get("currentCategoryId");
				var img = $.session.get("currentCategoryImg");
				$('.header_top_bottom_people a')[id].setAttribute('class',''+ img +'');
				$('.header_top_bottom_people a')[id].style='color:#fff';

			}

		});

	    // 女士，男士，创意生活切换
	    $(".header_top_bottom_people a").click(function(){

			//导航背景色随频道颜色改变
			var currentId = $(this).data("currentcategoryid"),navBg;

			var img = imgClass(currentId);
	        $(this).addClass(''+ img +'').css('color','#fff').siblings("a").removeClass().css('color','#626161');
			// 女士，男士，创意生活切换

			$.session.set('currentCategoryId', currentId);
			$.session.set('currentCategoryImg',''+ img +'');
            window.location.href=''+ $(this).attr('href') +'';
            return false;
	    });

		function imgClass(currentId){

 		   var img = '';
 		//    console.log(currentId );
 			   if(currentId == 0){
 				//    navBg = "#f54b73";
 				img = 'women';
			}else if(currentId == 1){
 				//    navBg = "#505c82";
 				img = 'men';
			}else if(currentId == 2){
 				//    navBg = "#a4d7d8";
 				img = 'design';
 		   }
		   return img;
		}

	</script>

@endsection
