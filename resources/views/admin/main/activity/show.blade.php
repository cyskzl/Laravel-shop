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


@endsection