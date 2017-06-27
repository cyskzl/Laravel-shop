<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>发货单管理</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="{{ asset('templates/admin/css/x-admin.css') }}" media="all">
        <link rel="stylesheet" href="//res.layui.com/layui/build/css/layui.css" media="all">
    </head>
    <body>

        <table class="layui-table" lay-even lay-skin="nob">
            <colgroup>
                <col width="150">
                <col width="200">
                <col>
            </colgroup>
            <tbody>
            <input type="hidden" name="returnid" value="{{$ordersReturn->id}}">
            <input type="hidden" name="returnstatus" value="{{$ordersReturn->status}}">
            <tr>
                <td>订单编号</td>
                <td>{{$ordersReturn->order_sn}}</td>
            </tr>
            <tr>
                <td>用户</td>
                <td>{{$ordersReturn->user_id}}</td>
            </tr>
            <tr>
                <td>申请日期</td>
                <td>{{$ordersReturn->addtime}}</td>
            </tr>
            <tr>
                <td>商品名称</td>
                <td>{{$ordersReturn->goods_id}}</td>
            </tr>
            <tr>
                <td>退换货</td>
                <td>
                    @if($ordersReturn->status == 0)
                    <select name="type" id="type">
                        <option value="0" {{($ordersReturn->type == 0)?"selected":""}}>退货</option>
                        <option value="1" {{($ordersReturn->type == 1)?"selected":""}}>换货</option>
                    </select>
                        @else
                        <input type="hidden" value="{{$ordersReturn->type}}" name="type">
                        {{($ordersReturn->type == 0)?"退货":"换货"}}
                        @endif
                </td>
            </tr>
            <tr>
                <td>退货描述</td>
                <td>{{$ordersReturn->reason}}</td>
            </tr>
            <tr>
                <td>用户上传照片</td>
                <td>
                    @foreach(explode(',',$ordersReturn->imgs) as $v)
                        {{$v}}
                    @endforeach
                </td>
            </tr>
             <tr>
                 <td>修改状态</td>
                 <td>
                     @if($ordersReturn->status == 0)
                         <select name="status" id="">
                             <option value="-1">审核不通过</option>
                             <option value="1" >审核通过</option>
                         </select>
                     @else
                        {{($ordersReturn->status == -1)?"审核不通过":"审核通过"}}
                     @endif
                 </td>
             </tr>
            <tr>
                <td>处理备注</td>
                <td>
                    @if($ordersReturn->status == 0)
                        <textarea name="remark" id="remark" style="width:300px; height:120px;" placeholder="退货描述" class="tarea"></textarea>
                    @else
                        {{$ordersReturn->remark}}
                    @endif
                </td>
            </tr>
            @if($ordersReturn->status == 1 && $ordersReturn->type == 1)
                <tr>
                    <td rowspan="2">换货物流信息</td>
                    <td>
                        <div class="layui-inline">
                            <label class="layui-form-label">快递公司</label>
                            <div class="layui-input-inline">
                                <input type="text" name="express_name" class="layui-input">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="layui-inline">
                            <label class="layui-form-label">快递单号</label>
                            <div class="layui-input-inline">
                                <input type="text" name="express_sn" class="layui-input">
                            </div>
                        </div>
                    </td>
                </tr>
            @endif
            @if($seller_delivery)
                <tr>
                    <td rowspan="3">换货物流信息</td>
                    <td>
                        快递公司: {{$seller_delivery['express_name']}}
                    </td>
                </tr>
                <tr>
                    <td>
                        快递单号: {{$seller_delivery['express_sn']}}
                    </td>
                </tr>
                <tr>
                    <td>
                        发货时间: {{$seller_delivery['express_time']}}
                    </td>
                </tr>
                @endif
            </tbody>
            @if($ordersReturn->status != -1 && $ordersReturn->status != 2 &&!($ordersReturn->type ==0 && $ordersReturn->ststus ==1))
            <tr>
                <td colspan="2" style="text-align: center">
                    <button type="submit" class="layui-btn layui-btn-radius" id="btn">确认提交</button>
                </td>
            </tr>
                @endif
        </table>
        <script src="{{ asset('templates/admin/lib/layui/layui.js') }}" charset="utf-8"></script>
        <script src="{{ asset('templates/admin/js/x-layui.js') }}" charset="utf-8"></script>
        <script src="{{ asset('templates/admin/js/jquery.min.js') }}" charset="utf-8"></script>


        <script>
            layui.use(['element','laypage','layer','form'], function(){
                $ = layui.jquery;//jquery
                lement = layui.element();//面包导航
                laypage = layui.laypage;//分页
                layer = layui.layer;//弹出层
                form = layui.form();//弹出层


            });

            $('#btn').on('click',function () {
                var id = $('input[name=returnid]').val();
                var returnstatus = $('input[name=returnstatus]').val();
                var type = $('input[name=type]').val();
                var token = "{{csrf_token()}}";



                if(returnstatus == 0){
                    var type = $('select[name=type]').val();
                    var status = $('select[name=status]').val();
                    var remark = $('#remark').val();
                    var data = {
                        "_token":token,
                        "returnstatus":returnstatus,
                        "status":status,
                        "type":type,
                        "remark":remark,
                        "_method":"PUT"
                    };
                }


                if(returnstatus == 1 && type==1){
                    var data = {
                        "_token":token,
                        "type":type,
                        "returnstatus":returnstatus,
                        "express_name":$('input[name=express_name]').val(),
                        "express_sn":$('input[name=express_sn]').val(),
                        "_method":"PUT"
                    }
                }


                $.ajax({
                    type:"PUT",
                    url:"./",
                    data:data,
                    success:function (data) {
                        if(data == 0){
                            layer.msg('提交成功', {icon: 1,time:1000});
                        }else{
                            layer.msg('提交失败', {icon: 2,time:1000});
                        }
                    }
                });

            })
        </script>
    </body>
</html>