@extends('home.layouts.layout')

@section('title','商品详情页')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/details-header.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/css/details-main.css')}}"/>
	{{--<link rel="stylesheet" href="{{asset('/templates/home/css/details.css')}}" type="text/css">--}}
	<link rel="stylesheet" href="{{asset('/templates/home/css/section.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('/templates/home/css/dress.css')}}" type="text/css">
	<script src="{{asset('/templates/home/js/details-main.js')}}"></script>

@endsection


@section('main')
	<!--主体内容-->
	    <!-- 商品小字分类介绍-->
	    <div class="title">
	        <ul class="fl">
	            <li>创意生活</li>
	            <li></li>
	            <li> > </li>
	            <li>上衣</li>
	            <li> > </li>
	            <li>T恤</li>
	            <li> > </li>
	            <li>圆领短袖字母T恤_橙色</li>
	        </ul>
	    </div>

	    <!-- 商品购买框-->
	    <div class="buy rela">

	        <!-- 商品大图展示-->
	        <div class="bigimgShow fl rela">
	            <img src="{{asset(trim($goodinfo->original_img,','))}}">
	        </div>
			{{--<div class="imgShow psa" style="position:absolute;vertical-align:middle;width:448px;heigth:110px;display:inline-block;background-color:rgba(0, 0, 0, 0.25);box-sizing:border-box;">--}}
				{{--<div class="imgView">--}}
					{{--<div id="productImgBanner" class="owl-carousel2">--}}
						{{--<a class="item product_card" href="javascript:;">--}}
							{{--<img src="http://img01.wconceptimg.cn/media/catalog/product/w/i/wimg_450699648_2951840.jpg" alt="">--}}
						{{--</a>--}}
						{{--<a class="item product_card" href="javascript:;">--}}
							{{--<img src="http://img01.wconceptimg.cn/media/catalog/product/w/i/wimg_450699648_2936451.jpg" alt="">--}}
						{{--</a>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}
	        <!-- 商品条件筛选-->
	        <div class="productOption fr">

	            <!-- 商品标签-->
	            <div class="ware-title">
	                <span class="Black">{{$brand[0]}}</span><br>
	                <span class="B4d">{{$goodinfo->goods_name}}</span><br>
	                <span class="S3c">{{$goodinfo->goods_sn}}</span>
	            </div>

	            <!-- 条件筛选-->
	            <div class="term">
	                <ul>
	                    <!-- 商品价格-->
	                    <li><span>价格：</span><span class="B4d">￥{{$goodinfo->shop_price}}</span></li>
	                    {{--<li><span>含税价：</span><span>￥304.37</span></li>--}}
	                    <!-- 商品颜色-->
	                    <li>
	                        <span class="fl">{{$spec_name[0]}}：</span>
	                        <div class="color flex fl">
	                            @foreach($spec_item[0] as $k=>$one_item)
									<div class="key1" goods_id="{{$goodinfo->goods_id}}" key1= '{{$spec_id[0][$k]}}'>{{$one_item}}</div>
								@endforeach
	                        </div>
	                    </li>
	                    <!-- 商品尺寸-->
	                    <li>
	                        <span class="fl">{{$spec_name[1]}}：</span>
	                        <div class="size fl">
	                            <div>
	                                @foreach($spec_item[1] as $i=>$two_item)
										<div class="key2" goods_id="{{$goodinfo->goods_id}} "key2="{{$spec_id[1][$i]}}">{{$two_item}}</div>
									@endforeach
	                            </div>
	                            {{--<div class="none">--}}
	                                {{--<div>L</div>--}}
	                                {{--<div>XL</div>--}}
	                                {{--<div>XXL</div>--}}
	                            {{--</div>--}}
	                        </div>
	                    </li>
	                    <!-- 购买数量-->
	                    <li>
	                        <span class="fl">数量：</span>
	                        <div class="fl number">
	                            <button class="minus">-</button>
	                            <input id="number" type="text" readonly value="1"/>
	                            <button class="add">+</button>
	                        </div>
	                    </li>
	                </ul>
	            </div>

	            <!-- 购物车-->
	            <div class="car">
	                <a href="javascript:">加入购物车</a>
	            </div>

	            <!-- 发货方式&退换条款-->
	            <div class="way">
	                <ul>
	                    <li>
	                        <span>发货方式：</span>
	                        <span>韩国仓直发 包邮 6～14个工作日送达</span>
	                    </li>
	                    <li>
	                        <span>退换条款：</span>
	                        <span>
	                            <ul>
	                                <li>
	                                    <img src="{{asset('/templates/home/public/png/zheng.png')}}" alt="100%正品保障"/>
	                                    100%正品保障
	                                </li>
	                                <li>
	                                    <img src="{{asset('/templates/home/public/png/qian.png')}}" alt="货物签收说明"/>
	                                    货物签收说明
	                                </li>
	                                <li>
	                                    <img src="{{asset('/templates/home/public/png/shi.png')}}" alt="实名认证"/>
	                                    实名认证
	                                </li>
	                                <li>
	                                    <img src="{{asset('/templates/home/public/png/tui.png')}}" alt="七天省心退"/>
	                                    七天省心退
	                                </li>
	                                <li>
	                                    <img src="{{asset('/templates/home/public/png/shui.png')}}" alt="海外购额度说明"/>
	                                    海外购额度说明
	                                </li>
	                            </ul>
	                        </span>
	                    </li>
	                </ul>
	            </div>

	            <!-- 收藏-->
	            <div class="coll">
	                <a href="javascript:">
	                    <img src="{{asset('/templates/home/public/png/xin1.png')}}" alt=""/>
	                    收藏（0）
	                </a>
	            </div>
	        </div>

	        <!--查看条款 -->
	        <div id="clause" class="clause abso">
	            <a href="javascript:">查看条款</a>
	        </div>
	    </div>

	    <!-- 商品推荐&商品详情-->
	    <div class="main-footer clearfix">

	        <!-- 商品推荐-->
	        <div class="recomme fl">
	            <span class="recomme-title">商品推荐</span>
	            <ul>
	                <li>
	                    <a href="javascript:">
	                        <!--产品样式 -->
	                        <span class="cp-img"><img src="{{asset('/templates/home/public/img/1.jpg')}}" alt=""/></span>
	                        <!-- 产品牌子-->
	                        <span class="cp-brand">LUCKY PLANET</span>
	                        <!-- 产品名字-->
	                        <span class="cp-name">简约方形拉链运动风手包_朱黄色</span>
	                        <!-- 产品价格-->
	                        <span class="cp-price">￥297</span>
	                    </a>
	                </li>
	                <li>
	                    <a href="javascript:">
	                        <!--产品样式 -->
	                        <span class="cp-img"><img src="{{asset('/templates/home/public/img/1.jpg')}}" alt=""/></span>
	                        <!-- 产品牌子-->
	                        <span class="cp-brand">LUCKY PLANET</span>
	                        <!-- 产品名字-->
	                        <span class="cp-name">简约方形拉链运动风手包_朱黄色</span>
	                        <!-- 产品价格-->
	                        <span class="cp-price">￥1297</span>
	                    </a>
	                </li>
	                <li>
	                    <a href="javascript:">
	                        <!--产品样式 -->
	                        <span class="cp-img"><img src="{{asset('/templates/home/public/img/1.jpg')}}" alt=""/></span>
	                        <!-- 产品牌子-->
	                        <span class="cp-brand">LUCKY PLANET</span>
	                        <!-- 产品名字-->
	                        <span class="cp-name">简约方形拉链运动风手包_朱黄色</span>
	                        <!-- 产品价格-->
	                        <span class="cp-price">￥297</span>
	                    </a>
	                </li>
	            </ul>
	        </div>

	        <!-- 商品详情-->
	        <div class="details fr rela clearfix">

	            <!-- 商品详情选项-->
	            <ul class="details-title flex">
	                <li class="under">商品详情</li>
	                <li>购物须知</li>
	                <li>全部评论</li>
	                <li>标准尺码对照表</li>
	            </ul>

	            <!-- 商品详情-->
	            <div class="cp-details clearfix">
					{!! $goodinfo->goods_content !!}
	                <!-- 产品名称-->
	                {{--<div class="D1">--}}
	                    {{--<h3>产品详情</h3>--}}
	                    {{--<span>方形外观，侧拉链，logo细节，简约运动风手包。</span>--}}
	                {{--</div>--}}
	                {{--<!-- 产品参数-->--}}
	                {{--<div class="D2">--}}
	                    {{--<h3>产品参数</h3>--}}
	                    {{--<ul>--}}
	                        {{--<li>原产地:韩国</li>--}}
	                        {{--<li>面料/材质:锦纶100%</li>--}}
	                        {{--<li>性别:男士</li>--}}
	                        {{--<li>性别:男士</li>--}}
	                    {{--</ul>--}}
	                {{--</div>--}}
	                {{--<!-- 产品规格-->--}}
	                {{--<div class="D3 rela">--}}
	                    {{--<h3>尺码信息</h3>--}}
	                    {{--<p class="abso">参考尺寸(cm)</p>--}}
	                    {{--<table>--}}
	                        {{--<tbody>--}}
	                            {{--<tr>--}}
	                                {{--<td class="tit"></td>--}}
	                                {{--<td>OS</td>--}}
	                            {{--</tr>--}}
	                            {{--<tr>--}}
	                                {{--<td class="tit">长</td>--}}
	                                {{--<td>17</td>--}}
	                            {{--</tr>--}}
	                            {{--<tr>--}}
	                                {{--<td class="tit">短</td>--}}
	                                {{--<td>7</td>--}}
	                            {{--</tr>--}}
	                        {{--</tbody>--}}
	                    {{--</table>--}}
	                {{--</div>--}}
	                <!-- 产品样式-->
	                {{--<div class="D4 clearfix">--}}
	                    {{--<ul class="clearfix">--}}
	                        {{--<li><img src="{{asset('/templates/home/public/img/2.jpg')}}" alt=""/></li>--}}
	                        {{--<li><img src="{{asset('/templates/home/public/img/3.jpg')}}" alt=""/></li>--}}
	                        {{--<li><img src="{{asset('/templates/home/public/img/4.jpg')}}" alt=""/></li>--}}
	                        {{--<li><img src="./public/img/2.jpg" alt=""/></li>--}}
	                        {{--<li><img src="./public/img/3.jpg" alt=""/></li>--}}
	                        {{--<li><img src="./public/img/4.jpg" alt=""/></li>--}}
	                        {{--<img src="{{asset('/templates/home/public/img/8.jpg')}}" alt=""/>--}}
	                        {{--<span>--}}
	                            {{--THISISNEVERTHAT始创于2009年，主要突出韩系街头风格，--}}
	                            {{--同时越来越多地融入高街元素。--}}
	                            {{--扎扎实实地融合传统美式工装、街头、--}}
	                            {{--滑板元素等传统街头品牌根基的风格，--}}
	                            {{--独到地诠释品牌对美式休闲的见解。--}}
	                        {{--</span>--}}
	                    {{--</div>--}}
	                {{--</div>--}}
	            {{--</div>--}}

	            <!-- 购物须知-->
	            <div class=" question none">
	                <img src="{{asset('/templates/home/public/png/buy.png')}}" alt=""/>
	                <span>常见问题&解答</span>
	                <span>
	                    Q：退货条件<br>
	                    A：请务必保证吊牌完好未剪下，商品未过水保持原样，透明塑料外包装袋需要完整没损坏，
	                    即 不影响产品二次销售。如果是鞋子要保证鞋面无折痕、鞋底无脏污、无磨损（允许试穿），感谢您的理解及配合。<br>
	                    Q：退货流程<br>
	                    A：1、签收后7天内请先与客服联系；2、协商后确认退货，等待审核通过后获取退货地址；
	                    3、进入个人中心-已付款订单，选中退货订单和商品，点击“申请退货”；4、将退货商品寄回，并告知客服物流单号；5、收到包裹确认退货，办理退款。<br>
	                    Q：美国直购商品税费说明<br>
	                    A：部分美国直购​商品采用个人行邮方式进行海外发货，在商品运抵国内申报海关时，
	                    若在清关 期间产生税费，您将接到中国邮政公司发给您的征税通知。需要您携带个人身份证（及复印件），
	                    购物凭证，以及税费等其它通知所要带的材料，在工作日期间到您​当地的海关驻邮局办事处（简称海关驻邮办）或者上级海关进行完税办理。
	                    您先行承担的个人税费，可凭税单 及发票凭证在7个工作日内咨询客服进行相应退税补贴，补贴方式有两种可选：1、直接退予相应的税费现金，
	                    2、退予1.2倍税金的相应平台积分。<br>
	                    Q：有关购买直邮商品个人证件的说明<br>
	                    A：根据我国海关清关政策，个人购买跨境进口商品需使用大陆地区有效的居民身份证购买，
	                    不支持港澳台地区护照。同时，海外进口商品需以个人实名购买，请在购物前于支付宝/微信平台进行实名认证，
	                    并保证支付人信息与身份证信息一致。违者，商品包裹将会被海关退运/销毁，该责任由买家个人负责。<br>
	                    Q：我的订单信息写错了，我想修改订单地址/电话，能改吗？
	                    A：如您在订单支付后需要修改订单收货信息，请您及时联系客服予以处理。如您的的订单还未出库发货，
	                    可立即为您的订单进行修改（直邮商品如已推送至海外商家则不支持修改）；如您的订单已出库发货，
	                    我们会为您联系物流进行处理（直邮商品订单待到达国内口岸才可进行修改，请您谅解！）<br>
	                    Q：服饰类尺码如何预计？<br>
	                    A：因每个人的身高、体型、肌肉松紧程度都不同，穿着实际效果因人而异，建议您可测量下相关尺寸信息后再参考页面尺寸信息购买。<br>
	                    Q：鞋类尺码如何预计？<br>
	                    A：我们韩国的鞋类尺码比国内标准尺码偏小1码左右，
	                    由于每个人的脚型不同，穿着感上会有所不同，建议您如果脚型偏窄的话购买时可以参考页面尺寸信息选择比平时大一码，
	                    如果脚型偏宽的话选择比平时大两码。我们的建议仅供您参考！<br>
	                    Q：实物颜色与图片会有色差吗？<br>
	                    A：请放心，W concept平台内所有商品图片均为100%实物拍摄，且图片色调均经过处理，
	                    尽量做到还原产品真实色调；但由于拍摄灯光，照相机或个人显示器色彩差异原因，
	                    不排除买家收到的产品与图片有少许色差，请您以实物为准（色差不属于质量问题）。<br>
	                </span>
	            </div>

	            <!-- 全部评论-->
	            <div class="comment none">
	                <!-- 输入评论区-->
	                <div class="comment-text clearfix">
	                    <span class="fl">写评论</span>
	                    <textarea name="" id="text" cols="110" rows="8"></textarea>
	                    <a class="fl" href="javascript:">
	                        <img src="{{asset('/templates/home/public/png/image.png')}}" alt=""/>
	                        发送图片
	                    </a>
	                    <input type="submit" value="提交" class="fl" id="submit"/>
	                </div>

	                <!-- 评论区-->
	                <div class="comment-footer clearfix" id="comment-footer">
	                    <div class="clearfix">
	                        <ul>
	                            <li class="iD">梦幻般的眼神</li>
	                            <li class="time">2017-06-21 13:57:46</li>
	                            <li class="reply"><img src="{{asset('/templates/home/public/png/xinxi.png')}}" alt=""/></li>
	                        </ul>
	                        <span class="text">独特的个性</span>
	                    </div>
	                </div>
	            </div>

	            <!-- 标准尺码-->
	            <div class="sizechart none">
	                <img src="{{asset('/templates/home/public/img/sizechart.jpg')}}" alt=""/>
	            </div>
	        </div>
	    </div>
@endsection

@section('footer')
	<!--查看条框弹出框-->
	<div class="popup fix none" id="popup">
	    <div id="box" class="abso">
	        <h3>退换条款</h3>
	        <ul>
	            <li>
	                <h4><img src="{{asset('/templates/home/public/png/zheng.png')}}" alt="" />100%正品保障</h4>
	                <p>全球设计师品牌正品，品质有保障。</p>
	            </li>
	            <li>
	                <h4><img src="{{asset('/templates/home/public/png/qian.png')}}" alt=""/>货物签收说明</h4>
	                <p>货到时，无论本人还是他人代签，请务必先开箱检查商品，确认无误后签收。如有破损、漏发、错发等情况，请拍照后当场拒收并在24小时内联系客服。</p>
	            </li>
	            <li>
	                <h4><img src="{{asset('/templates/home/public/png/shi.png')}}" alt=""/>实名认证</h4>
	                <p>海外进口商品需以个人实名购买，请您购物前在支付宝/微信平台进行实名认证，同时支付人信息须与填报的身份证持有人信息一致。否则可能有退运风险，感谢您的配合。</p>
	            </li>
	            <li>
	                <h4><img src="{{asset('/templates/home/public/png/tui.png')}}" alt=""/>七天省心退</h4>
	                <p>平台大部分商品支持7天无理由退货（个别商品除外），请放心购买！海外商品如因个人主观原因发生退货，退款需扣除80元往返国际运费以及商品的相关税金。</p>
	            </li>
	            <li>
	                <h4><img src="{{asset('/templates/home/public/png/shui.png')}}" alt=""/>海外购额度说明</h4>
	                <p>根据2016.4.8颁布的海关新政，个人每年购买海外购商品总额度不可超过20000元，超额购买的商品将无法通过口岸申报而被退运。</p>
	            </li>
	        </ul>
	        <p>
	            <a href="javascript:">更多售后服务条款请点击“客服中心” ></a>
	        </p>
	        <div class="X abso">
	            <img src="{{asset('/templates/home/public/png/X.png')}}" alt=""/>
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
	<script src="{{asset('/templates/home/js/page.js')}}"></script>
	<script>
	$('.key1').click(function(){
		// console.log($(this).attr('spec_id'));
		var key1 =  $(this).attr('key1');
		var goods_id = $(this).attr('goods_id');
		var key2 = $('.key2');
		var key  = [];
		for(var i=0;i<key2.length;i++){
			key[i] = key2[i].getAttribute('key2');
		}
//		console.log(key);return false;
		$.ajax({
			type:'POST',
			url:'./ajaxdetail',
			dataType:'json',
			data:{'_token':'{{csrf_token()}}','goods_id':goods_id,'key1':key1},
			success: function(data){
//				console.log(data);return false;
				if(data){
					for(var i=0;i<data.length;i++){
					    if(key.indexOf(data[i]) > -1){
							key2[i].style.background = rgb(109, 109, 109);
						}
					}
				}
			}
		});
	});
	</script>
@endsection