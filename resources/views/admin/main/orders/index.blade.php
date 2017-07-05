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
    <link rel="stylesheet" href="{{asset('templates/admin/css/x-admin.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('templates/admin/lib/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('templates/admin/lib/layui/css/layui.css')}}">
    <script src="{{asset('templates/admin/js/jquery.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('templates/admin/lib/bootstrap/js/bootstrap.js')}}" charset="utf-8"></script>
</head>
<body>
<div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>订单列表</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <form class="layui-form x-center" action="" style="width:800px">
        <div class="layui-form-pane" style="margin-top: 15px;">
            <div class="layui-form-item">
                <label class="layui-form-label">日期范围</label>

                <div class="layui-input-inline">
                    <input class="layui-input" placeholder="开始时间" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                </div>

                <div class="layui-input-inline">
                    <input class="layui-input" placeholder="截止时间" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                </div>
                <div class="layui-input-inline">
                    <div class="layui-input-block">
                        <select name="interest" lay-filter="aihao">
                            <option value=""></option>
                            <option value="0">写作</option>
                            <option value="1" selected="">阅读</option>
                            <option value="2">游戏</option>
                            <option value="3">音乐</option>
                            <option value="4">旅行</option>
                        </select>
                    </div>
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="username"  placeholder="标题" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-input-inline" style="width:80px">
                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                </div>
            </div>
        </div>
    </form>
    <xblock><button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button><button class="layui-btn" onclick="question_add('添加订单','{{ url('orders/create') }}','800','500')"><i class="layui-icon">&#xe608;</i>添加</button><span class="x-right" style="line-height:40px">共有数据：88 条</span></xblock>

    <!-- 订单管理table -->

    <table class="table table-bordered table-hover">
        <thead >
        <tr class="active">
            <th>订单编号</th>
            <th>收货人</th>
            <th>总金额</th>
            <th>应付金额</th>
            <th>订单状态</th>
            <th>支付状态</th>
            <th>发货状态</th>
            <th>支付方式</th>
            <th>配送方式</th>
            <th>下单时间</th>
            <th>操作</th>
        </tr>
        <tr style="height: 10px;">
        </tr>
        </thead>
        @foreach($ordersList as $value)
        <tbody>
        <tr>
            <th scope="row">{{$value->sn}}</th>
            <td>{{$value->consignee}}</td>
            <td>{{$value->goods_price}}</td>
            <td>{{$value->order_amount}}</td>
            <td>{{$order_status[$value->order_status]}}</td>
            <td>{{$pay_status[$value->pay_status]}}</td>
            <td>{{$shipping_status[$value->shipping_status]}}</td>
            <td>{{$value->pay_name}}</td>
            <td>{{$value->shipping_name}}</td>
            <td>{{$value->created_at}}</td>
            <td style="width: 160px;">
                <a class="btn btn-primary btn-xs" role="button" href="javascript:;" onclick="question_detaile('查看订单','{{ url('admin/orders/').'/'.$value->id}}','1','','800')">查看</a>
                <a class="btn btn-success btn-xs" role="button" href="javascript:;" onclick="question_edit('编辑订单','{{ url('admin/orders/').'/'.$value->id.'/edit'}}','1','','800')">编辑</a>
                <a class="btn btn-danger btn-xs" role="button" href="javascript:;" >关闭订单</a>
            </td>
        </tr>
        </tbody>
        @endforeach

    </table>



    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
{{--                {{$ordersList->links()}}--}}
            </div>
        </div>
    </div>
</div>
<script src="{{asset('templates/admin/lib/layui/layui.js')}}" charset="utf-8"></script>
<script src="{{asset('templates/admin/js/x-layui.js')}}" charset="utf-8"></script>
<script>
    layui.use(['form','layer','laydate'], function(){
        var laydate = layui.laydate;

        var start = {
            min: laydate.now()
            ,max: '2099-06-16 23:59:59'
            ,istoday: false
            ,choose: function(datas){
                end.min = datas; //开始日选好后，重置结束日的最小日期
                end.start = datas //将结束日的初始值设定为开始日
            }
        };

        var end = {
            min: laydate.now()
            ,max: '2099-06-16 23:59:59'
            ,istoday: false
            ,choose: function(datas){
                start.max = datas; //结束日选好后，重置开始日的最大日期
            }
        };

        document.getElementById('LAY_demorange_s').onclick = function(){
            start.elem = this;
            laydate(start);
        }
        document.getElementById('LAY_demorange_e').onclick = function(){
            end.elem = this
            laydate(end);
        }

    });

    //批量删除提交
    function delAll () {
        layer.confirm('确认要删除吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
        });
    }

    function question_show (argument) {
        layer.msg('可以跳到前台具体问题页面',{icon:1,time:1000});
    }
    /*添加*/
    function question_add(title,url,w,h){
        x_admin_show(title,url,w,h);
    }
    //编辑
    function question_edit (title,url,id,w,h) {
        x_admin_show(title,url,w,h);
    }

    //查看详情
    function question_detaile (title,url,id,w,h) {
        x_admin_show(title,url,w,h);
    }

    /*删除*/
    function question_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $(obj).parents("tr").remove();
            layer.msg('已删除!',{icon:1,time:1000});
        });
    }


        $(".form_datetime").datetimepicker({
            format: "yyyy-mm-dd hh:ii:ss",
            autoclose: true,
            todayBtn: true,
            todayHighlight: true,
            showMeridian: true,
            pickerPosition: "bottom-left",
            timePicker12Hour: false,
            language: 'zh-CN',//中文，需要引用zh-CN.js包
            startView: 2,//月视图
            minView: 0//日期时间选择器所能够提供的最精确的时间选择视图
        });


</script>
</body>
</html>