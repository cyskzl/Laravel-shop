@extends('admin.layouts.layout')

@section('style')
    <style type="text/css">
        .colborder{border-left: 1px solid #f1f1f1;border-right: 1px solid #f1f1f1;}
        .labelspan{float: left; width: 84px;}
        .info-rcol{float: left; width: 140px;margin-bottom: 7px;}
    </style>
@endsection

@section('x-nav')
    <span>
        {{--{{dd($act_goods[0]->goods[0]['goods_name'])}}--}}
        共有{{count($act_goods)}}件商品
    </span>
@endsection

@section('x-body')
    <div class="container">
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <th width="70%">商品名称</th>
                    <th>活动价格</th>
                    <th>库存</th>
                </tr>
                @foreach($act_goods as $good)
                    <tr>
                        <td>{{$good->goods[0]['goods_name']}}</td>
                        <td>{{$good->promotion_price}}</td>
                        <td>{{$good->number}}</td>
                    </tr>
                @endforeach
            </table>
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