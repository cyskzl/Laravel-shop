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
					<a href="javascript:">女士频道</a>
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
					<dd id="page_all_a" class="page_all_a">
						<span><img src="./uploads/icon_tree_menu.png" alt=""></span>
						<a href="javascript:">上衣</a>
					</dd>
					<dd id="page_all_aone" class="page_all_none" style="display: block;">
						<a href="javascript:">全部上衣</a>
						<a href="javascript:">T恤</a>
						<a href="javascript:">衬衫</a>
						<a href="javascript:">帽衫/卫衣</a>
						<a href="javascript:">毛衣/针织衫</a>
						<a href="javascript:">羽绒服/棉服</a>
						<a href="javascript:">大衣</a>
						<a href="javascript:">夹克</a>
						<a href="javascript:">其他</a>
						<a href="javascript:">背心/吊带</a>
						<a href="javascript:">皮衣</a>
						<a href="javascript:">西装</a>
						<a href="javascript:">套装</a>
						<a href="javascript:">风衣</a>
					</dd>
					<dd id="page_all_b" class="page_all_a">
						<span>
							<img src="./uploads/icon_tree_menu.png" alt="">
						</span>
						<a href="javascript:">牛仔</a>
					</dd>
					<dd id="page_all_bone" class="page_all_none" style="display: none;">
						<a href="javascript:">全部上衣</a>
						<a href="javascript:">T恤</a>
						<a href="javascript:">衬衫</a>
						<a href="javascript:">帽衫/卫衣</a>
						<a href="javascript:">毛衣/针织衫</a>
						<a href="javascript:">羽绒服/棉服</a>
						<a href="javascript:">大衣</a>
						<a href="javascript:">夹克</a>
						<a href="javascript:">其他</a>
						<a href="javascript:">背心/吊带</a>
						<a href="javascript:">皮衣</a>
						<a href="javascript:">西装</a>
						<a href="javascript:">套装</a>
						<a href="javascript:">风衣</a>
					</dd>
					<dd id="page_all_c" class="page_all_a">
						<span><img src="./uploads/icon_tree_menu.png" alt=""></span>
						<a href="javascript:">裤装</a>
					</dd>
					<dd id="page_all_cone" class="page_all_none" style="display: none">
						<a href="javascript:">全部上衣</a>
						<a href="javascript:">T恤</a>
						<a href="javascript:">衬衫</a>
						<a href="javascript:">帽衫/卫衣</a>
						<a href="javascript:">毛衣/针织衫</a>
						<a href="javascript:">羽绒服/棉服</a>
						<a href="javascript:">大衣</a>
						<a href="javascript:">夹克</a>
						<a href="javascript:">其他</a>
						<a href="javascript:">背心/吊带</a>
						<a href="javascript:">皮衣</a>
						<a href="javascript:">西装</a>
						<a href="javascript:">套装</a>
						<a href="javascript:">风衣</a>
					</dd>
					<dd id="page_all_d" class="page_all_a">
						<span><img src="./uploads/icon_tree_menu.png" alt=""></span>
						<a href="javascript:">裙装</a>
					</dd>
					<dd id="page_all_done" class="page_all_none" style="display: none">
						<a href="javascript:">全部上衣</a>
						<a href="javascript:">T恤</a>
						<a href="javascript:">衬衫</a>
						<a href="javascript:">帽衫/卫衣</a>
						<a href="javascript:">毛衣/针织衫</a>
						<a href="javascript:">羽绒服/棉服</a>
						<a href="javascript:">大衣</a>
						<a href="javascript:">夹克</a>
						<a href="javascript:">其他</a>
						<a href="javascript:">背心/吊带</a>
						<a href="javascript:">皮衣</a>
						<a href="javascript:">西装</a>
						<a href="javascript:">套装</a>
						<a href="javascript:">风衣</a>
					</dd>
					<dd id="page_all_e" class="page_all_a">
						<span><img src="./uploads/icon_tree_menu.png" alt=""></span>
						<a href="javascript:">泳裤</a>
					</dd>
					<dd id="page_all_eone" class="page_all_none" style="display: none">
						<a href="javascript:">全部上衣</a>
						<a href="javascript:">T恤</a>
						<a href="javascript:">衬衫</a>
						<a href="javascript:">帽衫/卫衣</a>
						<a href="javascript:">毛衣/针织衫</a>
						<a href="javascript:">羽绒服/棉服</a>
						<a href="javascript:">大衣</a>
						<a href="javascript:">夹克</a>
						<a href="javascript:">其他</a>
						<a href="javascript:">背心/吊带</a>
						<a href="javascript:">皮衣</a>
						<a href="javascript:">西装</a>
						<a href="javascript:">套装</a>
						<a href="javascript:">风衣</a>
					</dd>
					<dd id="page_all_f" class="page_all_a">
						<span><img src="./uploads/icon_tree_menu.png" alt=""></span>
						<a href="javascript:">鞋类</a>
					</dd>
					<dd id="page_all_fone" class="page_all_none" style="display: none">
						<a href="javascript:">全部上衣</a>
						<a href="javascript:">T恤</a>
						<a href="javascript:">衬衫</a>
						<a href="javascript:">帽衫/卫衣</a>
						<a href="javascript:">毛衣/针织衫</a>
						<a href="javascript:">羽绒服/棉服</a>
						<a href="javascript:">大衣</a>
						<a href="javascript:">夹克</a>
						<a href="javascript:">其他</a>
						<a href="javascript:">背心/吊带</a>
						<a href="javascript:">皮衣</a>
						<a href="javascript:">西装</a>
						<a href="javascript:">套装</a>
						<a href="javascript:">风衣</a>
					</dd>
					<dd id="page_all_g" class="page_all_a">
						<span><img src="./uploads/icon_tree_menu.png" alt=""></span>
						<a href="javascript:">包类</a>
					</dd>
					<dd id="page_all_gone" class="page_all_none" style="display: none">
						<a href="javascript:">全部上衣</a>
						<a href="javascript:">T恤</a>
						<a href="javascript:">衬衫</a>
						<a href="javascript:">帽衫/卫衣</a>
						<a href="javascript:">毛衣/针织衫</a>
						<a href="javascript:">羽绒服/棉服</a>
						<a href="javascript:">大衣</a>
						<a href="javascript:">夹克</a>
						<a href="javascript:">其他</a>
						<a href="javascript:">背心/吊带</a>
						<a href="javascript:">皮衣</a>
						<a href="javascript:">西装</a>
						<a href="javascript:">套装</a>
						<a href="javascript:">风衣</a>
					</dd>
					<dd id="page_all_h" class="page_all_a">
						<span><img src="./uploads/icon_tree_menu.png" alt=""></span>
						<a href="javascript:">首饰/配件类</a>
					</dd>
					<dd id="page_all_hone" class="page_all_none" style="display: none">
						<a href="javascript:">全部上衣</a>
						<a href="javascript:">T恤</a>
						<a href="javascript:">衬衫</a>
						<a href="javascript:">帽衫/卫衣</a>
						<a href="javascript:">毛衣/针织衫</a>
						<a href="javascript:">羽绒服/棉服</a>
						<a href="javascript:">大衣</a>
						<a href="javascript:">夹克</a>
						<a href="javascript:">其他</a>
						<a href="javascript:">背心/吊带</a>
						<a href="javascript:">皮衣</a>
						<a href="javascript:">西装</a>
						<a href="javascript:">套装</a>
						<a href="javascript:">风衣</a>
					</dd>
				</dl>
				
				<!-- 商品文字列表底部img -->
				<div class="page_product_all_twoimg">
					<img src="./uploads/750x364.jpg" alt="">
					<img src="./uploads/MRK-banner-750x360.jpg" alt="">
				</div>
			</div>
			<!-- 商品图片列表 -->
			<div class="page_product_img">
				<div class="page_product_top">
					<a href="javascript:">最新</a>
					<a href="javascript:">销量</a>
					<a href="javascript:">价格
							<img src="./uploads/icon-pc-sort-price-up.png" alt="">
							<img src="./uploads/icon-pc-sort-price-down.png" alt="">
					</a>
				</div>
				<div class="page_product_bottom">
					<a href="javascript:">
						<span>
							<img src="{{asset('/templates/home/images/wimg_450704747_2979539.jpg')}}" alt="">
						</span>
						<p class="text">OUTSTANDINGORDINARY</p>
						<p class="text">字母点缀卷边裤脚短裤_白色</p>
						<p class="text">¥ 318</p>
					</a>
					<a href="javascript:">
						<span>
							<img src="./images/wimg_450704747_2979539.jpg" alt="">
						</span>
						<p class="text">OUTSTANDINGORDINARY</p>
						<p class="text">字母点缀卷边裤脚短裤_白色</p>
						<p class="text">¥ 318</p>
					</a>
					<a href="javascript:">
						<span>
							<img src="./images/wimg_450704747_2979539.jpg" alt="">
						</span>
						<p class="text">OUTSTANDINGORDINARY</p>
						<p class="text">字母点缀卷边裤脚短裤_白色</p>
						<p class="text">¥ 318</p>
					</a>
					<a href="javascript:">
						<span>
							<img src="./images/wimg_450704747_2979539.jpg" alt="">
						</span>
						<p class="text">OUTSTANDINGORDINARY</p>
						<p class="text">字母点缀卷边裤脚短裤_白色</p>
						<p class="text">¥ 318</p>
					</a>
					
				</div>
			</div>
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
@endsection



