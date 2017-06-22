@extends('admin.layouts.layout')
@section('x-nav')
    <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>商品类别管理</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
@endsection
@section('x-body')
    <form class="layui-form x-center" action="" method="post" style="width:50%">
        {{--{{csrf_token()}}--}}
        <div class="layui-form-pane" style="margin-top: 15px;">
            <div class="layui-form-item">
                <label class="layui-form-label" style="width:100px">类型名称</label>
                <div class="layui-input-inline">
                    <input type="text" name="name" required lay-verify="required" placeholder="类型名称" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-input-inline" style="width:80px">
                    <button class="layui-btn"  lay-submit="" lay-filter="add"><i class="layui-icon">&#xe608;</i>增加</button>
                </div>
            </div>
        </div>
    </form>
    <xblock><button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button><span class="x-right" style="line-height:40px">共有数据：{{$goodstypes->total()}} 条</span></xblock>
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
                类型名
            </th>
            <th>
                操作
            </th>
        </tr>
        </thead>
        <tbody id="x-link">
        @foreach($goodstypes as $goodstype)
            <tr>
                <td>
                    <input type="checkbox" value="1" name="">
                </td>
                <td>
                    {{$goodstype->id}}
                </td>
                <td>
                    {{$goodstype->name}}
                </td>
                <td class="td-manage">
                    <a title="编辑" href="javascript:;" onclick="cate_edit('编辑','/admin/type/{{$goodstype->id}}/edit','{{$goodstype->id}}','','510')"
                       class="ml-5" style="text-decoration:none">
                        <i class="layui-icon">&#xe642;</i>
                    </a>
                    <a title="删除" href="javascript:;" onclick="cate_del(this,'{{$goodstype->id}}')"
                       style="text-decoration:none">
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
                {{$goodstypes->links()}}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        layui.use(['element','layer','form'], function(){
            $ = layui.jquery;//jquery
            lement = layui.element();//面包导航
            layer = layui.layer;//弹出层
            form = layui.form();

            //监听提交
            form.on('submit(add)', function(data){
//                    console.log(data);
                //发异步，把数据提交给php
                $.ajax({
                    type: 'post',
                    url:  '/admin/type',
                    dataType: 'json',
                    data: { '_token':'{{csrf_token()}}',  'name': data.field.name },
                    success:function (data){
//                            console.log();
                        if(data.status == 1){
                            layer.msg(data.msg,{icon:1,time:1000});
                        }
                        layer.alert(data.msg, {icon: 6});
                        $('#x-link').prepend('<tr><td><input type="checkbox"value="1"name=""></td><td>'+data.id+'</td><td>'+data.name+'</td><td class="td-manage"><a title="编辑"href="javascript:;"onclick="cate_edit(\'编辑\',\'/admin/type/'+data.id+'/edit\',\'4\',\'\',\'510\')"class="ml-5"style="text-decoration:none"><i class="layui-icon">&#xe642;</i></a><a title="删除"href="javascript:;"onclick="cate_del(this,\''+data.id+'\')"style="text-decoration:none"><i class="layui-icon">&#xe640;</i></a></td></tr>');                        }
                });
                return false;
            });


        })




        //批量删除提交
        function delAll () {
            layer.confirm('确认要删除吗？',function(index){
                //捉到所有被选中的，发异步进行删除
                layer.msg('删除成功', {icon: 1});
            });
        }

        //-编辑
        function cate_edit (title,url,id,w,h) {
            x_admin_show(title,url,w,h);
        }

        /*-删除*/
        function cate_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                //发异步删除数据
                $.ajax({
                    type: 'DELETE',
                    url:  '{{url('/admin/type/')}}'+'/'+id,
                    dataType: 'json',
                    data: { '_token':'{{csrf_token()}}', '_method': 'DELETE', 'id': id },
                    success:function (data){
                        if(data.status == 0){
                            layer.msg(data.msg, {icon: 5,time:1000});
                        }
                        location.href = location.href;
                        $(obj).parents("tr").remove();
                        layer.msg(data.msg ,{icon:1,time:1000});
                    }
                });
            });
        }
    </script>

@endsection