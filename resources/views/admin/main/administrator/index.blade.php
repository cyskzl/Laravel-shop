<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>管理员列表</title>
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
              <a><cite>管理员管理</cite></a>
              <a><cite>管理员列表</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">
            <form class="layui-form x-center" action="{{url('admin/adminlist')}}" style="width:100%">
                <div class="layui-form-pane" style="margin-top: 15px;">
                  <div class="layui-form-item">
                    <div class="layui-input-inline">
                      <input type="text" name="keyword"  placeholder="请输入登录名" autocomplete="off" class="layui-input" value="{{$request->input('keyword')}}">
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                    </div>
                  </div>
                </div>
            </form>
            <xblock><button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button><button class="layui-btn" onclick="admin_add('添加管理员','{{ url('admin/adminlist/create') }}','600','500')"><i class="layui-icon">&#xe608;</i>添加</button><span class="x-right" style="line-height:40px">共有数据：{{ count($search) }}条</span></xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="" value=""></th>
                        <th>ID</th>
                        <th>头像</th>
                        <th>登录名</th>
                        <th>邮箱</th>
                        <th>加入时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                @if(count($search) > 0)
                    @foreach($search as $row)

                        @if( $row->id == 1)
                            <tr id = "admin">
                                {{--{{dd($admin_user)}}--}}
                                <td>
                                    <input type="checkbox" value="{{ $row->id }}" name="id">
                                </td>

                                <td>{{ $row->id }}</td>
                                <td style="width: 80px;">
                                    <img src="{{ asset(rtrim($row->pic, ',')) }}" alt="{{ $row->nickname }}" width="60" height="60" style="border: 2px solid #A9B7B7;border-radius: 100%;">
                                </td>

                                <td>{{ $row->nickname }}</td>

                                <td >{{ $row->email }}</td>

                                <td>{{ $row->created_at }}</td>
                                <td class="td-status">
                                    @if($row->status == '1')
                                        <span class="layui-btn layui-btn-normal layui-btn-mini">
                                            已启用
                                        </span>
                                    @else
                                        <span class="layui-btn layui-btn-normal layui-btn-mini">
                                        已禁用
                                        </span>
                                    @endif
                                </td>
                                <td class="td-manage"></td>
                            </tr>
                        @continue
                        @endif
                        <tr>
                            {{--{{dd($admin_user)}}--}}
                            <td>
                                <input type="checkbox" value="{{ $row->id }}" name="id">
                            </td>

                            <td>{{ $row->id }}</td>

                            <td style="width: 80px;">
                                <img src="{{ asset(rtrim($row->pic, ',')) }}" alt="{{ $row->nickname }}" width="60" height="60" style="border: 2px solid #A9B7B7;border-radius: 100%;">
                            </td>

                            <td>{{ $row->nickname }}</td>

                            <td >{{ $row->email }}</td>

                            <td>{{ $row->created_at }}</td>

                            <td class="td-status">
                                @if($row->status == '1')
                                    <span class="layui-btn layui-btn-normal layui-btn-mini">
                                        已启用
                                    </span>
                                @else
                                    <span class="layui-btn layui-btn-normal layui-btn-mini">
                                    已禁用
                                    </span>
                                @endif
                            </td>
                            <td class="td-manage">
                                @if($row->status == '1')
                                    <a style="text-decoration:none" onclick="admin_stop(this,{{ $row->id }})" href="javascript:;" title="停用">
                                        <i class="layui-icon">&#xe601;</i>
                                    </a>
                                @else
                                    <a style="text-decoration:none" onclick="admin_start(this,{{ $row->id }})" href="javascript:;" title="启用">
                                        <i class="layui-icon">&#xe62f;</i>
                                    </a>
                                @endif
                                <a title="编辑" href="javascript:;" onclick="admin_edit('编辑','{{ url('admin/adminlist/'.$row->id.'/edit') }}',{{ $row->id }},'','510')"
                                class="ml-5" style="text-decoration:none">
                                    <i class="layui-icon">&#xe642;</i>
                                </a>
                                <a title="删除" href="javascript:;" onclick="admin_del(this, {{ $row->id }})"
                                style="text-decoration:none">
                                    <i class="layui-icon">&#xe640;</i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="5" ><h3 style="text-align: center">暂无信息</h3></td>
                </tr>
                @endif
                </tbody>
            </table>

            {!! $search->appends($request->only(['keyword']))->render() !!}
        </div>
        <script src="{{ asset('templates/admin/lib/layui/layui.js') }}" charset="utf-8"></script>
        <script src="{{ asset('templates/admin/js/x-layui.js') }}" charset="utf-8"></script>
        <script>

            var tr = document.getElementById('admin');
            tr.onmouseover = function(){
                tr.style.cursor = 'not-allowed';
            };
            layui.use(['laydate','element','laypage','layer'], function(){
                $ = layui.jquery;//jquery
              laydate = layui.laydate;//日期插件
              lement = layui.element();//面包导航
              laypage = layui.laypage;//分页
              layer = layui.layer;//弹出层

              //以上模块根据需要引入

              laypage({
                cont: 'page'
                ,pages: 100
                ,first: 1
                ,last: 100
                ,prev: '<em><</em>'
                ,next: '<em>></em>'
              });

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

             /*添加*/
            function admin_add(title,url,w,h){
                x_admin_show(title,url,w,h);
            }

             /*停用*/
            function admin_stop(obj,id){
                layer.confirm('确认要停用吗？',function(index){
                    //发异步把用户状态进行更改
                    var url = '{{ url('/admin/adminlist/') }}'+ '/' + id;
                    var obj = {
                        'id':id,
                        'status':'0',
                    }

                    var data = admin_ajax(url, 'PUT', JSON.stringify(obj));
//                    console.log(data);
                    res = JSON.parse(data);
                    if (res.success == '1') {
                        var str = '<a style="text-decoration:none" onClick="admin_start(this,id)" href="javascript:;" title="启用"><i class="layui-icon">&#xe62f;</i></a>';

                        $(obj).parents("tr").find(".td-manage").prepend(str);

                        $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-disabled layui-btn-mini">已停用</span>');

                        $(obj).remove();
                        layer.msg(res.info,{icon: 5,time:1000});
                        location.href = location.href;

                    } else {
                        layer.msg(res.info,{icon: 5,time:1000});
                        location.href = location.href;
                    }

                });
            }

            /*启用*/
            function admin_start(obj,id){
                layer.confirm('确认要启用吗？',function(index){
                    //发异步把用户状态进行更改
                    var url = '{{ url('/admin/adminlist/') }}'+ '/' + id;
                    var obj = {
                        'id':id,
                        'status':'1',
                    }

                    var data = admin_ajax(url, 'PUT', JSON.stringify(obj));
                    res = JSON.parse(data);
                    if (res.success == '1') {

                        var str = '<a style="text-decoration:none" onClick="admin_stop(this,id)" href="javascript:;" title="停用"><i class="layui-icon">&#xe601;</i></a>';

                        $(obj).parents("tr").find(".td-manage").prepend(str);

                        $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>');

                        $(obj).remove();

                        layer.msg(res.info,{icon: 6,time:1000});
                        location.href = location.href;

                    } else {

                        layer.msg(res.info,{icon: 5,time:1000});
                        location.href = location.href;
                    }

                });
            }

            //编辑
            function admin_edit (title,url,id,w,h) {
                x_admin_show(title,url,w,h);
            }

            /*删除*/
            function admin_del(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    //发异步删除数据
                    var url = '{{ url('/admin/adminlist/') }}'+ '/' + id;
                    var obj = {'id':id}

                    var data = admin_ajax(url, 'delete', JSON.stringify(obj));
                    res = JSON.parse(data);
                    if (res.success == '1') {
                        $(obj).parents("tr").remove();
                        layer.msg(res.info,{icon:1,time:1000});
                        location.href = location.href;
                    } else{
                        layer.msg(res.info,{icon:5,time:1000});
                        location.href = location.href;

                    }
                });
            }


            function admin_ajax(url, type, json){
                var data = '';
                $.ajax({
                    url:url,
                    type:type,
                    datatype:'json',
                    async: false,
                    data:{json,'_token':"{{ csrf_token() }}"},
                    success:function (res) {
                        data = res;
                    }

                });

                return data;

            }


            </script>
    </body>
</html>
