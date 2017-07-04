@extends('admin.layouts.layout')

@section('title','添加活动商品')

@section('x-nav')
    <span>
        商品列表（共{{count($goodsAll)}}记录）
    </span>
@endsection

@section('x-body')
    <div class="container">
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <th>
                        <input type="checkbox"  onclick="$('input[name*=\'goods_id\']').prop('checked', this.checked);">
                    </th>
                    <th width="70%">商品名称</th>
                    <th>价格</th>
                    <th>库存</th>
                    <th>折扣（例：0.95）</th>
                    <th>活动价</th>
                    <th>活动数量</th>
                </tr>
                @foreach($goodsAll as $good)
                    <tr>
                        <td>
                            <input type="checkbox" name="goods_id" value="{{$good->goods_id}}">
                        </td>
                        {{--{{dd($good['specGoodsPrice'][0]->id)}}--}}
                        <td>{{$good->goods_name}}</td>
                        <td>{{$good->shop_price}}</td>
                        <td>{{$good->store_count}}</td>
                        <td>
                            <input type="text" name="rebate" size="1" value="1">
                        </td>
                        <td>
                            <input type="text" name="promotion_price" size="1" value="">
                        </td>
                        <td>
                            <input type="text" name="number" size="1">
                        </td>
                    </tr>
                @endforeach
            </table>

            <div class="container">
                <div class="row">
                    <div class="col-xs-9">
                        {!! $goodsAll->appends($request->only(['keyword']))->render() !!}
                    </div>
                    <div class="col-xs-3" style="margin-top:14px">
                        <button id="submit" class="layui-btn">确认提交</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>

        $('input[name=rebate]').change(function (){
            var rebate = $(this).val();
            conosole.log();
            {{--$('input[name=promotion_price]').val() = rebate*{{$good->shop_price}};--}}
        });

        $('#submit').click(function (){
            var chk_value = '';
            $('input[name="goods_id"]:checked').each(function(){
                chk_value += $(this).val()+',';
            });
//            console.log(chk_value);
            $.ajax({
                type:'POST',
                url:"./",
                dataType:'json',
                data:{'chk_value':chk_value,'_token':"{{csrf_token()}}"},
                success: function(data){
                    if(data){
                        console.log(data);return false;
                        location.href = location.href;
                        layer.msg('商品添加成功!',{icon:6,time:1000});
                    }
                }
            });
        });
    </script>
@endsection
