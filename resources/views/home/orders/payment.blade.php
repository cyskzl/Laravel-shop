@extends('home.layouts.layout_two')

@section('title','付款方式')

@section('style')
    <link rel="stylesheet" href="{{asset('/templates/home/iconfont/iconfont.css')}}./"/>
    <link rel="stylesheet" href="{{asset('/templates/home/css/payment.css')}}"/>
@endsection

@section('main')
    <!-- 内容 -->

    <!--订单提交成功 start -->
    <div class="layout clearfix">
        <span class="iconfont icon-dagou dagou fl"></span>
        <div class="fl erhuh">
            <h3>订单提交成功，请您尽快付款！</h3>
            <p>订单号：  201706291457462774    |     付款金额（元）：  <b>5304.88</b> 元</p>
            <p>请您在  <b>2017-06-30</b> 完成支付，否则订单将自动取消</p>
        </div>
    </div>
    <!--订单提交成功 end -->

    <!--订单详情 start -->
    <div class="details">
        <a href="javascript:;" class="details_btn">订单详情</a>
    </div>
    <!--订单详情 end -->

    <!-- 支付方式 start-->
    <div class="payWay">
        <h4>选择支付方式</h4>
        <div>
            <ul class="payList flex">
                <li>
                    <div class="payment_area clearfix">
                        <input class="fl vam" type="radio"/>
                        <label class="fl" for=""><img src="./uploads/zfb.jpg" alt=""/></label>
                    </div>
                </li>
                <li>
                    <div class="payment_area clearfix">
                        <input class="fl vam" type="radio"/>
                        <label class="fl" for=""><img src="./uploads/hdfk.jpg" alt=""/></label>
                    </div>
                </li>
                <li>
                    <div class="payment_area clearfix">
                        <input class="fl vam" type="radio"/>
                        <label class="fl" for=""><img src="./uploads/wx.jpg" alt=""/></label>
                    </div>
                </li>
                <li>
                    <div class="payment_area clearfix">
                        <input class="fl vam" type="radio"/>
                        <label class="fl" for=""><img src="./uploads/zxzf.jpg" alt=""/></label>
                    </div>
                </li>
                <li>
                    <div class="payment_area clearfix">
                        <input class="fl vam" type="radio"/>
                        <label class="fl" for=""><img src="./uploads/cft.jpg" alt=""/></label>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- 支付方式 end-->

    <!-- 确认支付方式 start-->
    <div class="confirm_pay">
        <a href="javascript:;">确认支付方式</a>
    </div>
    <!-- 确认支付方式 end-->
@endsection
