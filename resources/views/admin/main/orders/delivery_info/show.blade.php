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
        <td>订单ID:{{$ordergoods->id}}</td>
        <td>订单编号:{{$ordergoods->sn}}</td>
        <td>会员:{{$ordergoods->user_id}}</td>
    </tr>
    <tr>
        <td>E-MAIL:{{$ordergoods->email}}</td>
        <td>电话:{{$ordergoods->mobile}}</td>
        <td>应付金额:{{$ordergoods->order_amount}}</td>
    </tr>
    <tr>
        <td>订单状态:{{$ordergoods->status}}</td>
        <td>下单时间:{{$ordergoods->created_at}}</td>
        <td>支付时间:{{$ordergoods->pay_time}}</td>
    </tr>
    <tr>
        <td>支付方式:{{$ordergoods->pay_name}}</td>
        <td>发票抬头:{{$ordergoods->invoice_title}}</td>
        <td></td>
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
        <td>联系方式:{{$ordergoods->mobile}}</td>
        <td>配送方式:{{$ordergoods->shipping_name}}</td>
    </tr>
    <tr>
        <td colspan="2">
            收货地址:{{$region.$ordergoods->address}}
        </td>
        <td>邮编:{{$ordergoods->zipcode}}</td>
    </tr>
    <tr>
        <td colspan="3">留言:{{$ordergoods->user_note}}</td>
    </tr>
    </tbody>
</table>



<table class="table">
    <tr class="info">
        <td>商品</td>
        <td>商品编号</td>
        <td>单价</td>
        <td>数量</td>
        <td>单品小计</td>
    </tr>


    @foreach($ordergoods['ordergood'] as $value)
        <tr>
            <td>{{$value->goods_name}}</td>
            <td>{{$value->goods_sn}}</td>
            <td>{{$value->goods_price}}</td>
            <td>{{$value->goods_num}}</td>
            <td>{{($value->goods_price * $value->goods_num)}}</td>
        </tr>
    @endforeach
</table>
<h4 style="float: right;margin-right: 50px;">订单总额</h4>

<table class="layui-table" lay-even="" lay-skin="nob">
    <colgroup>
        <col width="200">
        <col width="200">
        <col width="200">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <td colspan="3">
            <strong>费用信息</strong>
            <span>修改费用</span>
        </td>
    </tr>
    <tr>
        <td>小计:{{$ordergoods->tota_amount}}</td>
        <td>运费:{{$ordergoods->shippiung_price}}</td>
        <td>积分:{{$ordergoods->integral}}</td>
    </tr>
    <tr>
        <td>余额抵扣:{{$ordergoods->user_money}}</td>
        <td>优惠券抵扣:{{$ordergoods->coupon_price}}</td>
        <td>价格调整:{{$ordergoods->discount}}</td>
    </tr>
    <tr>
        <td colspan="3">应付:{{$ordergoods->order_amount}}</td>
    </tr>
    </tbody>
</table>

<table class="layui-table" lay-even="" lay-skin="nob">
    <colgroup>
        <col width="110">
        <col width="300">
    </colgroup>
    <tbody>
    <tr>
        <td>
            <strong>操作信息</strong>
        </td>
    </tr>
    <tr>
        <td>操作备注:</td>
        <td><textarea style="resize: none;width: 420px;height: 90px;" name=""></textarea></td>
    </tr>
    <tr>
        <td colspan="3">
            @if($ordergoods->order_status <0)

                <a href="javascript:;" class="layui-btn layui-btn-normal" name="order_status" onclick="level_update(this,'{{$ordergoods->id}}','-1')">删除</a>

            @else

                @if($ordergoods->pay_status == 0)
                    <a href="javascript:;" class="layui-btn layui-btn-normal" name="pay_status" onclick="level_update(this,'{{$ordergoods->id}}','1')">付款</a>
                @endif

                @if($ordergoods->pay_status == 1 && $ordergoods->shipping_status != 1 )
                    <a href="javascript:;" class="layui-btn layui-btn-normal" name="pay_status" onclick="level_update(this,'{{$ordergoods->id}}','1')">设为未付款</a>
                @endif

                @if($ordergoods->shipping_status !=1)
                    <a href="javascript:;" class="layui-btn layui-btn-normal" name="shipping_status" onclick="level_update(this,'{{$ordergoods->id}}','2')">作废</a>

                @endif

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

            $.ajax({
                type:"PUT",
                url:'./' + id,
                data:{'_token':'{{csrf_token()}}','mode':mode,'_method':'PUT'},
                success:function (data) {

                    if(data == 0){
                        layer.msg('修改成功!',{icon:1,time:1000});
                    }else  if(data ==2){
                        layer.msg('已发货订单不可修改',{icon:2,time:1000});
                    }else if(data ==3){
                        layer.msg('删除成功!',{icon:3,time:1000});
                    }else {
                        layer.msg('操作失败!',{icon:2,time:1000});

                    }

                    self.location.reload();
                }
            });


        });
    }
</script>
</body>
</html>