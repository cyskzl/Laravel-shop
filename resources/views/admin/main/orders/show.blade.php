<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>订单列表</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('templates/admin/css/x-admin.css')}}" media="all">
        <link rel="stylesheet" href="{{asset('templates/admin/lib/bootstrap/css/bootstrap.css')}}">
        <style type="text/css">
            .colborder{border-left: 1px solid #f1f1f1;border-right: 1px solid #f1f1f1;}
            .labelspan{float: left; width: 84px;}
            .info-rcol{float: left; width: 140px;margin-bottom: 7px;}
        </style>
    </head>
    <body>
    {{--{{dump($orderdata)}}--}}
        {{--{{dump($detaildata)}}--}}
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


        @foreach($ordergoods[0]['ordergood'] as $value)
        <tr>
            <td>{{$value->goods_name}}</td>
            <td>{{$value->goods_sn}}</td>
            <td>{{$value->goods_price}}</td>
            <td>{{$value->goods_num}}</td>
            <td>{{($value->goods_price * $value->goods_num)}}</td>
        </tr>
            @endforeach
    </table>

    <div  style="float: right;padding-right: 30px;">
        <button type="button" class="btn btn-success">发货</button>
        <button type="button" class="btn btn-danger">关闭订单</button>

    </div>
    </body>
</html>