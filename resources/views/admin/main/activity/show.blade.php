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
        共有{{count($goods_info)}}件商品
    </span>
@endsection

@section('x-body')
    <div class="container">
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <th width="70%">商品名称</th>
                    <th>商品单价</th>
                    <th>库存</th>
                </tr>
                @foreach($goods_info as $good)
                    <tr>
                        <td>{{$good->goods_name}}</td>
                        <td>{{$good->shop_price}}</td>
                        <td>{{$good->store_count}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection