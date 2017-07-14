@if(count($orderData) <1)
    <script>window.location.href='http://{{ $_SERVER["HTTP_HOST"].'/home/waitorder' }}'</script>
    {{dd()}}
@endif

@extends('home.layouts.layout')

@section('title','待付款订单')

@section('style')
    <link rel="stylesheet" href="{{asset('/templates/home/css/123/1.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/home/css/123/2.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/home/css/personal.css')}}"/>
    <style>
        .order_submit_btn {
            float: right;
            width: 180px;
            line-height: 38px;
            background-color: #626161;
            font-size: 14px;
            text-align: center;
            color: #ffffff;
            margin: 0 100px auto;
        }
    </style>
@endsection

@section('main')
    <!--主体-->
    <!-- breadcrumbs start-->
    <div class="breadcrumbs comWidth">
        <ul>
            <li><a href="javascript:;">首页</a><span>&gt;</span></li>
            <li><a href="javascript:;">个人中心</a><span>&gt;</span></li>
            <li><a href="javascript:;">订单详情</a></li>
            <li style="margin-left: 15px;"><a href="javascript:;">订单编号:{{$orderData->sn}}</a></li>
        </ul>
    </div>
    <!-- breadcrumbs end-->
    <!-- personal_center start-->


    <div id="container">
        <div class="w">
            <div class="main">
                <!--变量-->
                <!-- <span id="pay-button-order" style="display:none"></span> -->

                <!-- 订单跟踪及安装跟踪 -->
                <!--  /widget/order-track/order-track.tpl -->

                <!--/ /widget/order-track/order-track.tpl -->
                <!--订单信息-->
                <!--  /widget/order-info/order-info.tpl -->
                <div class="m order-info-mod">
                    <div class="order-info mc">
                        <div style="width: 100%;height: 20px;border-bottom: 1px #CCCCCC solid;font-size: 18px; line-height: 10px;">
                            <span style="margin-left: 20px">订单状态：</span>
                            <span style="color:crimson "><b>待发货</b></span>
                        </div>
                        <div class="ui-switchable-body">
                            <div class="ui-switchable-panel-main">
                                <div class="ui-switchable-panel">
                                    <!-- 收货人信息 -->
                                    <div class="dl">
                                        <div class="dt">
                                            <h4>收货人信息 </h4>
                                        </div>
                                        <div class="dd">
                                            <div class="item">
                                                <span class="label"> 收货人： </span>
                                                <div class="info-rcol">
                                                    {{$orderData->consignee}}
                                                </div>
                                            </div>
                                            <div class="item">
                                                <span class="label"> 地址： </span>
                                                <div class="info-rcol">
                                                    {{$address.$orderData->address}}
                                                </div>
                                            </div>
                                            <div class="item">
                                                <span class="label"> 手机号码： </span>
                                                <div class="info-rcol">
                                                    {{$orderData->mobile}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 配送信息 -->
                                    <div class="dl">
                                        <div class="dt">
                                            <h4>配送信息</h4>
                                        </div>
                                        <div class="dd">
                                            <div class="item">
                                                <span class="label"> 配送方式： </span>
                                                <div class="info-rcol">
                                                    {{$orderData->shipping_name}}
                                                </div>
                                            </div>
                                            <div class="item">
                                                <span class="label"> 运费： </span>
                                                <div class="info-rcol">
                                                    <span class="" > &yen;{{$orderData->shipping_price}} </span>
                                                </div>
                                            </div>
                                            @if(count($orderData->orderDeliveryDoc)>0)
                                                <div class="item">
                                                    <span class="label"> 运单号 </span>
                                                    <div class="info-rcol">
                                                        <span class="" > {{$orderData->orderDeliveryDoc[0]->invoice_no}} </span>
                                                    </div>
                                                </div>
                                                @endif
                                            <!--                                        <div class="item">-->
                                            <!--                                            <span class="label"> 送货日期： </span>-->
                                            <!--                                            <div class="info-rcol">-->
                                            <!--                                                2013-10-29-->
                                            <!--                                            </div>-->
                                            <!--                                        </div>-->
                                            <!--                                        <div class="item">-->
                                            <!--                                            <span class="label"> 配送时间： </span>-->
                                            <!--                                            <div class="info-rcol">-->
                                            <!--                                                19:00-22:00-->
                                            <!--                                            </div>-->
                                            <!--                                        </div>-->
                                        </div>
                                    </div>
                                    <!-- 付款信息 -->
                                    <div class="dl" id="pay-info">
                                        <div class="dt">
                                            <h4>付款信息</h4>
                                        </div>
                                        <div class="dd">
                                            <div class="item">
                                                <span class="label"> 付款方式： </span>
                                                <div class="info-rcol">
                                                    {{$orderData->pay_name or  "未付款"}}
                                                </div>
                                            </div>
                                            <div class="item">
                                                <span class="label"> 商品总额： </span>
                                                <div class="info-rcol">
                                                    <span class="f-price"> &yen;{{$orderData->goods_price}} </span>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <span class="label"> 应支付金额： </span>
                                                <div class="info-rcol">
                                                    <span class="f-price"> &yen;{{$orderData->order_amount}} </span>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <span class="label"> 运费金额： </span>
                                                <div class="info-rcol">
                                                    <span class="f-price"> &yen;{{$orderData->shipping_price}} </span>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <span class="label"> 优惠券： </span>
                                                <div class="info-rcol">
                                                    <span class="f-price"> &yen;0.00 </span>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <span class="label"> 返现： </span>
                                                <div class="info-rcol">
                                                    <span class="f-price"> &yen;0.00 </span>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <span class="label"> 礼品卡： </span>
                                                <div class="info-rcol">
                                                    <span class="f-price"> &yen;0.00 </span>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <span class="label"> 订单优惠： </span>
                                                <div class="info-rcol">
                                                    <span class="f-price"> &yen;0.00 </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 续重运费    -->
                                    </div>
                                    <!-- 发票信息 -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--进度条预计功能使用-->
                <input type="hidden" id="orderStatus" value="18"/>
                <input type="hidden" id="orderType" value="0"/>
                <input type="hidden" id="orderStoreId" value="0"/>
                <input type="hidden" id="pickDate" value="1382976000238"/>
                <!--/ /widget/order-info/order-info.tpl -->
                <!--商品 及 金额 -->
                <!--  /widget/order-goods/order-goods.tpl -->
                <input id="venderId" value="0" style="display:none;"/>
                <div class="order-goods m">
                    <div class="mc">
                        <div class="goods-list ">
                            <input type="hidden" id="venderIdListStr" value=""/>
                            <table class="tb-void tb-order">
                                <colgroup>
                                    <col class="grap"/>
                                    <col class="col-goods"/>
                                    <col class="col-number"/>
                                    <col class="col-price"/>
                                    <col class="col-amount"/>
                                    <col class="col-bean"/>
                                    <col class="col-ops"/>
                                    <col class="grap"/>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th class="grap">
                                    </th>
                                    <th>
                                        商品
                                    </th>
                                    <th>
                                        商品编号
                                    </th>
                                    <th>
                                        总价
                                    </th>
                                    <th>
                                        商品数量
                                    </th>
                                    <th>
                                        操作
                                    </th>
                                    <th class="grap">
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- 获取礼品卡sku对应的贺卡寄语  -->

                                    @foreach($orderData->orderDetails as $vaule)
                                        <?php $goodsinfo = json_decode($vaule->goods_info,true)?>
                                    <tr>
                                        <td class="grap"></td>
                                        <td>
                                            <div class="p-item">
                                                <div class="p-img">
                                                    <a href="" target="_blank">
                                                        <img src='{{$goodsinfo['original_img']}}' data-lazy-img="done" width="60" height="60"/></a>
                                                </div>
                                                <div class="p-info">
                                                    <div class="p-name\">
                                                        <a href="" class="a-link" target="_blank">{{$goodsinfo['goods_name']}}</a>
                                                    </div>
                                                    <div class="clr"></div>
                                                    <div class="fl"></div>
                                                    <div class="p-extra">
                                                        <span class="txt"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>111</td>
                                        <td>
                                            <span class="f-price"> &yen;{{$vaule->goods_price}} </span>
                                        </td>
                                        <td>{{$vaule->num}}</td>
                                        <td>
                                            <div class="p-btns">
                                                <a href="#" target="_blank" class="link-btn mt10">商品评价</a>
                                                <br/>
                                            </div>
                                        </td>
                                        <td class="grap"></td>
                                    </tr>
                                @endforeach



                                <!--                            <tr class="first-tr product-609752"><td class="grap"></td><td><div class="p-item"><div class="p-img">-->
                                <!--                                            <a href="//item.jd.com/609752.html" target="_blank"><img class="" src="picture/549cd8c6ndf612881_1.jpg" data-lazy-img="done" width="60" height="60"/></a></div>-->
                                <!--                                        <div class="p-info"><div class="p-name"><a href="//item.jd.com/609752.html" class="a-link" target="_blank">乐歌 I-CB18 HTC 三星等Micro接口 手机数据线 黑色</a></div>-->
                                <!--                                            <div class="clr"></div><div class="fl"></div><div class="p-extra"><span class="txt"></span></div></div></div></td>-->
                                <!--                                <td>609752</td><td><span class="f-price"> &yen;9.90 </span></td><td>1</td><td><div class="p-btns">-->
                                <!--                                        <a href="//myjd.jd.com/repair/ordersearchlist.action?searchString=817668761" target="_blank" class="link-btn mt10">申请售后</a><br/></div></td><td class="grap"></td></tr>-->
                                <!---->
                                <!--                            <tr class="product-824289">-->
                                <!--                                <td class="grap">-->
                                <!--                                </td>-->
                                <!--                                <td>-->
                                <!--                                    <div class="p-item">-->
                                <!--                                        <div class="p-img">-->
                                <!--                                            <a href="//item.jd.com/824289.html" target="_blank"><img class="" src="picture/57748217n6ecf2199_1.jpg" title="824289" data-lazy-img="done" width="60" height="60"/></a>-->
                                <!--                                        </div>-->
                                <!--                                        <div class="p-info">-->
                                <!--                                            <div class="p-name">-->
                                <!--                                                <a href="//item.jd.com/824289.html" class="a-link" target="_blank" title="迅捷（FAST） FW300R 300M无线路由器（白色）">迅捷（FAST） FW300R 300M无线路由器（白色）</a>-->
                                <!--                                            </div>-->
                                <!--                                            <div class="clr">-->
                                <!--                                            </div>-->
                                <!--                                            <div id="coupon_824289" class="fl">-->
                                <!--                                            </div>-->
                                <!--                                            <div class="p-extra">-->
                                <!--                                                <span class="txt"></span>-->
                                <!--                                            </div>-->
                                <!--                                        </div>-->
                                <!--                                    </div>-->
                                <!--                                </td>-->
                                <!--                                <td>-->
                                <!--                                    824289-->
                                <!--                                </td>-->
                                <!--                                <td>-->
                                <!--                                    <span class="f-price"> &yen;59.00 </span>-->
                                <!--                                </td>-->
                                <!--                                <td>-->
                                <!--                                    1-->
                                <!--                                </td>-->
                                <!--                                <td>-->
                                <!--                                    <div class="p-btns">-->
                                <!--                                        <!-- 根据订单类型屏蔽pop延保商品操作,只显示评价 -->
                                <!--                                        <a href="//myjd.jd.com/repair/ordersearchlist.action?searchString=817668761" target="_blank" class="link-btn mt10" >申请售后</a>-->
                                <!--                                    </div>-->
                                <!--                                </td>-->
                                <!--                                <td class="grap">-->
                                <!--                                </td>-->
                                <!--                            </tr>-->


                                </tbody>
                            </table>
                        </div>
                        <!-- 金额 -->
                        <div class="goods-total">
                            <ul>
                                <li><span class="label">商品总额：</span><span class="txt">&yen;{{$orderData->goods_price}}</span></li>
                                <li><span class="label">返　　现：</span><span class="txt">-&yen;0.00</span></li>
                                <li><span class="label">运　　费：</span><span class="txt"> &yen;{{$orderData->shipping_price}} </span></li>
                                <li class="ftx-01"><span class="label">应付总额：</span><span class="txt count">&yen;{{$orderData->order_amount}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($orderData->order_status == 0 && $orderData->pay_status == 0)
        <a href="/home/paymethodsubmit/{{$orderData->sn}}" class="order_submit_btn">点击付款</a>
        @elseif($orderData->order_status == 1 && $orderData->pay_status == 1||$orderData->pay_status == 0 ||$orderData->order_status == 0)
            <button class="order_submit_btn">取消订单</button>
            @elseif($orderData->shipping_status >0 && $orderData->order_status >0 && $orderData->order_status > 0)
        <button class="order_submit_btn">点击退货</button>
            @endif
    </div>

@endsection

@section('shop')

@endsection
@section('js')
    <script src="{{asset('/templates/home/js/dynamic.js')}}"></script>
    <script src="{{asset('/templates/home/js/left_memu.js')}}"></script>
@endsection
