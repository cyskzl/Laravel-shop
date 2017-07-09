@extends('home.layouts.layout_two')

@section('title','提交订单')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/check.css')}}"/>
	<style>
		.setAddress{margin-bottom: 15px;border: 1px solid #9e9e9e;position: relative;padding: 9px 13px;list-style: none;}
		.setAddress input{margin-right: 15px;}
		.setAddress span{margin-right: 25px;}
		.setInfo {display: block; float: right;}
		.setInfo .info{color: #2B2E37}
		select {margin-right: 15px;}
	</style>

	<script src="{{asset('/templates/home/js/jquery-1.7.2.min.js')}}"></script>

@endsection

@section('main')

	<!-- 内容 -->
	<form action="./orders" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
	        <div class="checkList">
	            <div class="listMsg">
	                <p>填写并核对订单信息</p>
	                <div class="listInfo">
	                    <h4 class="fl">收货人信息</h4>
	                    <a class="fr" href="javascript:;">新增收货地址</a>
	                </div>
					@if($address)
						<div class="noAddress">
							<li class="setAddress">
								<input type="radio" checked="checked" name="address">

								<span>
									{{$address->consignee}}
								</span>
									<span>
										{{$province[$address->province].$city[$address->city].$district[$address->district].$twon[$address->twon].$address->detailed_address}}
									</span>
									<span>
										{{$address->mobile}}
									</span>
									<span>
										{{$address->email}}
									</span>
								<div class="setInfo">
									<a class="info" href="javascript:void(0);" id="customer_address">更换地址</a>
								</div>
							</li>
						</div>
						@else
						<div class="noAddress">
							<p>暂时无收货人信息</p>
							<a href="javascript:;" class="address">添加收货地址</a>
						</div>
						@endif
					<div class="noAddress" style="border-bottom: 1px dashed #9e9e9e;">
						<li class="setAddress">
							<span>请选择配送方式</span>
							<select name="shipping_code" id="" style="height: 20px;">
							@foreach($delvary as $value)
									<option value="{{$value->id}}">{{$value->name}}</option>
								@endforeach
							</select>
							<span class="span_price">邮费:¥{{$delvary[0]->price}}</span>
							<input type="hidden" name="price" value="{{$delvary[0]->price}}">
						</li>
					</div>
					<div class="noAddress">
						<h3 style="margin: 15px 0 12px 0;">备注信息</h3>

							<input class="setAddress" style="width: 400px;" type="text" placeholder="对本次交易的说明" name="user_note">

					</div>

	            </div>
	        </div>
	        <!-- 商品信息 start-->
	        <div class="goodsInfo">
	            <h4>商品信息</h4>
	            <table class="cart-cont comWidth">
	                <tbody>
					@foreach($goodsNewData as $v)
	                    <tr>
	                        <td>
	                            <img src="{{trim($v['original_img'],',')}}" alt="商品一"/>
	                            <a href="#">{{$v['goods_name']}}</a>
	                            <div class="operationInfo">
	                                <div class="operationInfoWrap flex">
										@foreach($v['item'] as $value)
	                                    	<p>{{$value['name']}}: <b>{{$value['item']}}</b></p>
	                                	@endforeach
										<p>数量: <b>{{$v['num']}}</b></p>
										<p class="total_price">{{$v['price']}}</p>
									</div>
	                            </div>
	                        </td>
	                    </tr>
						@endforeach
	                    {{--<tr>--}}
	                        {{--<td>--}}
	                            {{--<img src="./images/wimg_450690305_2889998.jpg" alt="商品一"/>--}}
	                            {{--<a href="#">［朴寒星原款］狐狸毛绒包吊坠_柠檬黄</a>--}}
	                            {{--<div class="operationInfo">--}}
	                                {{--<div class="operationInfoWrap flex">--}}
	                                    {{--<p>颜色: <b>天海蓝</b></p>--}}
	                                    {{--<p>尺码: <b>M</b></p>--}}
	                                    {{--<p class="total_price">￥481</p>--}}
	                                {{--</div>--}}
	                            {{--</div>--}}
	                        {{--</td>--}}
	                    {{--</tr>--}}
	                </tbody>
	            </table>
	        </div>
	        <!-- 商品信息 end-->

	        <!-- 优惠 start-->
	        {{--<div class="integralInfo">--}}
	            {{--<h4>优惠劵</h4>--}}
	            {{--<div class="copt">--}}
	                {{--<div class="copt_text">九折优惠券</div>--}}
	                {{--<div></div>--}}
	            {{--</div>--}}
	        {{--</div>--}}
	        <!-- 优惠 end-->

	        <!-- 积分 start-->
	        <div class="integralInfo">
	            <h4>积分</h4>
	            <div class="wpoint">
	                <p>
	                    <a href="javascript:;"><input class="integral_btn" type="checkbox"/></a>
	                    可用积分: <span id="my-wpoint">0</span>
	                </p>
	            </div>
	        </div>
	        <!-- 积分 end-->

	        <!-- 开具发票 start-->
	        {{--<div class="invoiceInfo">--}}
	            {{--<h4>开具发票</h4>--}}
	            {{--<p>海外仓发货商品不开具发票，具体情况请联系客服</p>--}}
	        {{--</div>--}}
	        <!-- 开具发票 end-->

	        <!-- 交易信息 start-->
	        <div class="checkoutInfo">
	            <h4>交易信息</h4>
	            <div class="tradeInfo">
	                <p>商品总金额：¥ {{number_format($sum,2,".",'')}}</p>
					<input type="hidden" class="sum" value="{{$sum}}">
	                <p class="trade_price">运费：¥ {{$delvary[0]->price}}</p>
	                <p>优惠券折扣：¥ 0.00</p>
	                <p>积分折扣：-0P(¥ 0.00)</p>
	            </div>
	        </div>
	        <!-- 交易信息 end-->

	        <div class="submit_order clearfix">
	        	<p class="left">总计: 
	        		<span class="order_sum">¥ {{number_format(($sum + $delvary[0]->price),2,".",'')}}</span>

	        	</p>
	            <button type="submit" class="submit_btn right">提交订单</button>
	        </div>
	</form>
@endsection
@section('js')
	<script src="{{asset('/templates/home/js/jquery-1.7.2.min.js')}}"></script>

	<script>
        $('select').on('change',function(){
			 var val = ($(this).val());
			 var than = $(this);
			 var sum = parseInt($('.sum').val());

			 $.ajax({
				 url:'./todelivery/' + val ,
				 type:'get',
				 success:function (data) {

					$('.span_price').html('邮费:¥'+ data);
					$('.trade_price').html('运费：¥ ' + data);

					sum += parseInt(data);

					 $('.order_sum').html('¥ ' + sum.toFixed(2));

                 }
			 })
        });
	</script>
@endsection
