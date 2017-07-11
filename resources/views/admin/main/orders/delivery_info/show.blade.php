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
<table class="layui-table" lay-even="" lay-skin="nob">
    <colgroup>
        <col width="200">
        <col width="200">
        <col width="200">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <td>
            <strong>基本信息</strong>
        </td>
    </tr>
    <tr>

        <td>订单编号:{{$ordergoods->order_sn}}</td>
        <td>下单时间:{{$ordergoods->belongsToOrders->created_at}}</td>
        <td>配送费用:{{$ordergoods->shipping_price}}</td>
    </tr>
    <tr>
        <td>配送方式:{{$ordergoods->shipping_name}}</td>
        <td colspan="2">
            配送单号:
            <input type="text" name="invoice_no" value="{{$ordergoods->invoice_no}}">
        </td>
    </tr>
    </tbody>
</table>

<table class="layui-table" lay-even="" lay-skin="nob">
    <colgroup>
        <col width="200">
        <col width="200">
        <col width="200">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <td>
            <strong>收货信息</strong>
        </td>
    </tr>
    <tr>
        <td>收货人:{{$ordergoods->consignee}}</td>
        <td>电子邮件:{{$ordergoods->belongsToOrders->email}}</td>

    </tr>
    <tr>
        <td colspan="2">
            收货地址:{{$region.$ordergoods->belongsToOrders->address}}
        </td>

    </tr>
    <tr>
        <td>联系方式:{{$ordergoods->mobile}}</td>
        <td>邮编:{{$ordergoods->zipcode}}</td>
    </tr>
    <tr>
        <td>发票抬头:{{$ordergoods->belongsToOrders->invoice_title}}</td>
    </tr>
    <tr>
        <td colspan="3">用户备注:{{$ordergoods->belongsToOrders->user_note}}</td>
    </tr>
    </tbody>
</table>

<table class="table">
    <tr class="info">
        <td>商品</td>
        <td>规格属性</td>
        <td>购买数量</td>
        <td>商品单价</td>
    </tr>
    @foreach($ordergoods->belongsToOrdersDetalis as $value)
        <?php $goodsdata = json_decode($value->goods_name,true)?>
        <tr>
            <td>{{$goodsdata['goods_name']}}</td>
            <td>{{$value->goods_sn}}</td>
            <td>{{$value->goods_price}}</td>
            <td>{{$value->goods_num}}</td>
        </tr>
    @endforeach

</table>


<table class="layui-table" lay-even="" lay-skin="nob">
    <colgroup>
        <col width="110">
        <col width="300">
    </colgroup>
    <tbody>
    <tr>
        <td>
            <strong>发货备注</strong>
        </td>
    </tr>
    <tr>
        <td>操作备注:</td>
        <td><textarea style="resize: none;width: 420px;height: 90px;" id="note">{{$ordergoods->note}}</textarea></td>
    </tr>
    <tr>
        <td>可执行操作</td>
        <td>
            @if($ordergoods->invoice_no == "")
                <a href="javascript:;" class="layui-btn layui-btn-normal" onclick="level_update(this,'{{$ordergoods->id}}',1)">确认发货</a>
            @else
                <a href="javascript:;" class="layui-btn layui-btn-normal" onclick="level_update(this,'{{$ordergoods->id}}',2)">修改</a>
                <a href="javascript:;" class="layui-btn layui-btn-normal" onclick="level_update(this,'{{$ordergoods->id}}',3)">取消发货</a>

            @endif
        </td>
    </tr>
    </tbody>
</table>

<div  style="height: 50px;">

</div>


<script src="{{ asset('templates/admin/lib/layui/layui.js') }}" charset="utf-8"></script>
<script src="{{ asset('templates/admin/js/x-layui.js') }}" charset="utf-8"></script>
<script>
    layui.use(['element','layer'], function(){
        $ = layui.jquery;//jquery
        lement = layui.element();//面包导航
        layer = layui.layer;//弹出层


    })


    //批量删除提交
    function delAll () {
        layer.confirm('确认要删除吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
        });
    }
    // 等级-增加
    function level_add (title,url,id,w,h) {
        x_admin_show(title,url,w,h);
    }
    // 等级-编辑
    function level_edit (title,url,id,w,h) {
        x_admin_show(title,url,w,h);
    }

    /*等级-删除*/
    function level_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $(obj).parents("tr").remove();
            layer.msg('已删除!',{icon:1,time:1000});
        });
    }

    /*订单状态修改*/
    function level_update(obj,id,mode){
        layer.confirm('确认要提交吗？',function(index){
            //发异步修改数据
            var invoice_no = $('input[name=invoice_no]').val();

            var note = $('#note').val();

            $.ajax({
                type:"PUT",
                url:'./' + id,
                data:{'_token':'{{csrf_token()}}','_method':'PUT',"note":note,"invoice_no":invoice_no,"mode":mode},
                success:function (data) {
                    switch (data){
                        case '0':
                            layer.msg('修改成功!',{icon:1,time:1000});
                            break;
                        case '1':
                            layer.msg('发货单不可是空',{icon:2,time:1000});
                            return false;
                            break;
                        case '2':
                            layer.msg('快递单号不可为空',{icon:2,time:1000});
                            return false;
                            break;
                        case '3':
                            layer.msg('修改失败',{icon:2,time:1000});
                            return false;
                            break;
                    }

                    self.location.reload();
                }
            });


        });
    }
</script>
</body>
</html>