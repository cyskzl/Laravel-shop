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
            <p>订单号：  {{$status['sn']}}    |     付款金额（元）：  <b>{{number_format($status['order_amount'],2,".",'')}}</b> 元</p>
            <p>请您在  <b>{{$status['data']}}</b> 完成支付，否则订单将自动取消</p>
        </div>
    </div>
    <!--订单提交成功 end -->

    <!--订单详情 start -->
    <div class="details">
        <a href="javascript:;" class="details_btn">订单详情</a>
    </div>
    <!--订单详情 end -->

    <!-- 支付方式 start-->
    <form action="./paymethodsubmit" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="payWay">
        <h4>选择支付方式</h4>
        <div>
            <ul class="payList flex">
                @foreach($paymethod as $value)

                    @if($value->id ==1)
                        <li>
                            <div class="payment_area clearfix">
                                <input class="fl vam" type="radio" name="pay_name" value="{{$value->id}}"/>
                                <label class="fl" for=""><img src="{{asset('/templates/home/uploads/zfb.jpg')}}" alt=""/></label>
                            </div>
                        </li>
                    @elseif($value->id ==2)
                        <li>
                            <div class="payment_area clearfix">
                                <input class="fl vam" type="radio" name="pay_name" value="{{$value->id}}"/>
                                <label class="fl" for=""><img src="{{asset('/templates/home/uploads/hdfk.jpg')}}" alt=""/></label>
                            </div>
                        </li>
                    @elseif($value->id ==3)
                        <li>
                            <div class="payment_area clearfix">
                                <input class="fl vam" type="radio" name="pay_name" value="{{$value->id}}"/>
                                <label class="fl" for=""><img src="{{asset('/templates/home/uploads/wx.jpg')}}" alt=""/></label>
                            </div>
                        </li>
                    @elseif($value->id ==4)
                        <li>
                            <div class="payment_area clearfix">
                                <input class="fl vam" type="radio" name="pay_name" value="{{$value->id}}"/>
                                <label class="fl" for=""><img src="{{asset('/templates/home/uploads/zxzf.jpg')}}" alt=""/></label>
                            </div>
                        </li>
                    @elseif($value->id ==5)
                        <li>
                            <div class="payment_area clearfix">
                                <input class="fl vam" type="radio" name="pay_name" value="{{$value->id}}"/>
                                <label class="fl" for=""><img src="{{asset('/templates/home/uploads/cft.jpg')}}" alt=""/></label>
                            </div>
                        </li>
                    @endif

                @endforeach

            </ul>
        </div>
    </div>
    <!-- 支付方式 end-->

    <!-- 确认支付方式 start-->
    <div class="confirm_pay">
        <button type="submit">确认支付方式</button>
    </div>
    <!-- 确认支付方式 end-->
    </form>
@endsection
