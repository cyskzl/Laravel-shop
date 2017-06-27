<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>退货管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="{{ asset('templates/admin/css/x-admin.css') }}" media="all">
    <link rel="stylesheet" href="{{asset('templates/admin/lib/bootstrap/css/bootstrap.css')}}">

</head>
<body>
    <div class="x-nav">
                <span class="layui-breadcrumb">
                  <a><cite>首页</cite></a>
                  <a><cite>订单管理</cite></a>
                  <a><cite>退货管理</cite></a>
                </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
        <xblock>
            <span style="line-height:40px">共有数据：88 条</span>
            <form class="form-inline x-right" action="./returninfo" method="get">
                <div class="form-group ">
                    <select name="status" class="form-control">
                        <option value="">处理状态</option>
                        <option value="-2">已取消</option>
                        <option value="-1">审核未通过</option>
                        <option value="0">待审核</option>
                        <option value="1">审核通过</option>
                        <option value="2">已发货</option>
                        <option value="3">完成</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="sr-only" for="ordersn">订单编号</label>
                    <input type="text" class="form-control" name="ordersn" placeholder="订单编号">
                </div>
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>

        </xblock>
        <table class="layui-table">
            <thead>
            <tr>
                <th>
                    订单编号
                </th>
                <th>
                    商品名称
                </th>
                <th>
                    类型
                </th>
                <th>
                    申请日期
                </th>
                <th>
                    状态
                </th>
                <th>
                    操作
                </th>
            </tr>
            </thead>
            @foreach($ordersReturnList as $value)
            <tbody>
            <tr>
                <td>
                    {{$value->order_sn}}
                </td>
                <td>
                    {{$value->goods_id}}
                </td>
                <td>
                    {{$type[$value->type]}}
                </td>
                <td >
                    {{$value->addtime}}
                </td>
                <td >
                    {{$ostatus[$value->status]}}
                </td>
                <td class="td-manage">
                    <a title="编辑" href="javascript:;" onclick="role_edit('编辑','{{ url("admin/returninfo/$value->id/edit") }}','4','','710')"
                       class="ml-5 layui-btn layui-btn-small layui-btn-radius layui-btn-normal">查看
                    </a>
                    <a title="删除" href="javascript:;" onclick="role_del(this,'1')"
                       style="text-decoration:none">
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
            </tr>
            </tbody>

                @endforeach
        </table>

        <div id="page"></div>
    </div>
    <script src="{{ asset('templates/admin/lib/layui/layui.js') }}" charset="utf-8"></script>
    <script src="{{ asset('templates/admin/js/x-layui.js') }}" charset="utf-8"></script>
    <script>
        layui.use(['laydate','element','laypage','layer'], function(){
            $ = layui.jquery;//jquery
            laydate = layui.laydate;//日期插件
            lement = layui.element();//面包导航
            laypage = layui.laypage;//分页
            layer = layui.layer;//弹出层

            //以上模块根据需要引入
        });

        //批量删除提交
        function delAll () {
            layer.confirm('确认要删除吗？',function(index){
                //捉到所有被选中的，发异步进行删除
                layer.msg('删除成功', {icon: 1});
            });
        }
        /*添加*/
        function role_add(title,url,w,h){
            x_admin_show(title,url,w,h);
        }


        //编辑
        function role_edit (title,url,id,w,h) {
            x_admin_show(title,url,w,h);
        }
        /*删除*/
        function role_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                //发异步删除数据
                $(obj).parents("tr").remove();
                layer.msg('已删除!',{icon:1,time:1000});
            });
        }
    </script>

</body>
</html>