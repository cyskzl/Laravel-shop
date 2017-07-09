<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>系统日志</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="{{ asset('templates/admin/css/x-admin.css') }}" media="all">
    </head>
    <body>
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>系统日志</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">
            <form class="layui-form x-center" action="" style="width:80%">
                <div class="layui-form-pane" style="margin-top: 15px;">
                  <div class="layui-form-item">

                    <div class="layui-input-inline">
                      <input type="text" name="keyword"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                    </div>
                  </div>
                </div> 
            </form>
            <span class="x-right layui-btn layui-btn-danger" style="line-height:40px">共有数据：{{ count($admin_log) }} 条</span>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="" value="">
                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            类型
                        </th>
                        <th>
                            内容
                        </th>
                        <th>
                            用户名
                        </th>
                        <th>
                            客户端IP
                        </th>
                        <th>
                            时间
                        </th>

                    </tr>
                </thead>
                <tbody>
                @foreach($admin_log as $log)
                    <tr>
                        <td>
                            <input type="checkbox" value="{{ $log->id }}" name="id">
                        </td>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->status }}</td>
                        <td>{{ $log->content }}</td>
                        <td>{{ $log->nickname }}</td>
                        <td >{{ $log->login_ip }}</td>
                        <td >{{ $log->login_time }}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {!! $admin_log->appends($request->only(['keyword']))->render() !!}
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
           
            /*-删除*/
            function log_del(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    //发异步删除数据
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                });
            }
            </script>

    </body>
</html>
