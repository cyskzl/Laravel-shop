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
                </tr>

                @foreach($goodsAll as $good)
                    <tr>
                        <td>
                            <input type="checkbox" name="goods_id" value="{{$good->goods_id}}">
                        </td>
                        <td>
                            {{$good->goods_name}}
                        </td>
                        <td>{{$good->shop_price}}</td>
                        <td>{{$good->store_count}}</td>
                    </tr>
                @endforeach
            </table>

            <div class="container">
                <div class="row">
                    <div class="col-xs-9">
                        {!! $goodsAll->appends($request->only(['keyword']))->render() !!}
                    </div>
                    <div class="col-xs-3" style="margin-top:14px">
                        <button  class="layui-btn" id="submit">
                            立即添加
                        </button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

@endsection

@section('js')
    <script>
        layui.use(['layer'], function () {
            $ = layui.jquery;
            var layer = layui.layer
            $('#submit').click(function () {
                var goods_id = new Array();
                $('input[name="goods_id"]:checked').each(function () {
                    goods_id.push($(this).val());//向数组中添加元素
                });
                var goods_str = goods_id.join(',');
//            console.log(goods_str);return false;
                $.ajax({
                    type: "post",
                    url: '{{url('admin/goodsactivity/activity')}}',
                    data: {'goods_id': goods_str, 'id':{{$activity_id}}, '_token': '{{csrf_token()}}'},
                    dataType: 'json',
                    success: function (data) {
                        if (data.status==0) {
                            layer.alert(data.msg, {icon: 6}, function () {
                                // 获得frame索引
                                var index = parent.layer.getFrameIndex(window.name);
                                //关闭当前frame
                                parent.layer.close(index);
                            });
                        } else {
                            layer.alert(data.msg, {icon: 5});
                            return false;
                        }
                    }
                });
            });
        });
    </script>
@endsection
