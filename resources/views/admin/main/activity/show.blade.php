@extends('admin.layouts.layout')

@section('style')
    <style type="text/css">
        .colborder{border-left: 1px solid #f1f1f1;border-right: 1px solid #f1f1f1;}
        .labelspan{float: left; width: 84px;}
        .info-rcol{float: left; width: 140px;margin-bottom: 7px;}
    </style>
@endsection

@section('x-body')
    <div class="row" style="padding: 20px">
        <div class="col-xs-4">
            <h5>收货人信息</h5>
            <p>
                <span class="labelspan">姓名:</span>
                <span >嘻嘻嘻嘻</span>
            </p><p>
                <span class="labelspan">收货地址:</span>
                <span class="info-rcol">嘻嘻嘻嘻啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊</span>
            </p>
            <p>
                <span class="labelspan">手机号码:</span>
                <span class="info-rcol">手机号码:</span>
            </p>
        </div>
        <div class="col-xs-4 colborder">
            <h5>付款信息</h5>
            <p>
                <span class="labelspan">付款方式:</span>
                <span>嘻嘻嘻嘻</span>
            </p><p>
                <span class="labelspan">付款时间:</span>
                <span>大苏打</span>
            </p>
            <p>
                <span class="labelspan">商品总额:</span>
                <span class="">¥349.00</span>
            </p>
            <p>
                <span class="labelspan">应付金额:</span>
                <span class="">¥349.00</span>
            </p>
            <p>
                <span class="labelspan">积分抵现:</span>
                <span class="">¥0.00</span>
            </p>
            <p>
                <span class="labelspan">订单优惠:</span>
                <span class="">¥0.00</span>
            </p>
        </div>
        <div class="col-xs-3">
            <h5>配送信息</h5>
            <p>
                <span class="labelspan">配送方式:</span>
                <span>嘻嘻嘻嘻</span>
            </p><p>
                <span class="labelspan">快递单号:</span>
                <span >1451328514</span>
            </p>
            <p>
                <span class="labelspan">运费:</span>
                <span class="">¥0.00</span>
            </p>
        </div>
    </div>



    <table class="table">
        <tr class="active">
            <td>商品</td>
            <td>商品编号</td>
            <td>单价</td>
            <td>数量</td>
            <td>总价</td>
        </tr>

        {{--@foreach($detaildata as $value)--}}
            {{--<tr>--}}
                {{--<td>商品名称</td>--}}
                {{--<td>{{$value->order_guid}}</td>--}}
                {{--<td>{{$value->cargo_price}}</td>--}}
                {{--<td>{{$value->commodity_number}}</td>--}}
                {{--<td>{{($value->cargo_price * $value->commodity_number)}}</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
    </table>

    <div  style="float: right;padding-right: 30px;">
        <button type="button" class="btn btn-success">发货</button>
        <button type="button" class="btn btn-danger">关闭订单</button>

    </div>
@endsection