@extends('admin.layouts.layout')
@section('x-nav')
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>商品分类管理</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
@endsection
@section('x-body')
    <xblock><button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button><span class="x-right" style="line-height:40px">共有数据：88 条</span></xblock>
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
                父类名称
            </th>
            <th>
                分类名称
            </th>
            <th>
                操作
            </th>
        </tr>
        </thead>
        <tbody id="x-link">
        @foreach($cates as $v)
            <tr>

                <td>
                    <input type="checkbox" value="1" name="">
                </td>
                <td>

                    {{ $v->id }}
                </td>
                <td>
                    {{ $v->pid }}
                </td>
                <td>
                    {{ $v->name }}
                </td>
                <td class="td-manage">
                    <a title="编辑" href="javascript:;" onclick="cate_edit('编辑','/category/{{$v->id}}/edit','4','','510')"
                       class="ml-5" style="text-decoration:none">
                        <i class="layui-icon">&#xe642;</i>
                    </a>
                    <a title="删除" href="javascript:;" onclick="cate_del(this,'{{$v->id}}')"
                       style="text-decoration:none">
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
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
            console.log(data);
            //发异步，把数据提交给php
            $.ajax({
                type: 'POST',
                url:  '{{url('/goodscategory')}}',
                dataType: 'json',
                data: {'pid': data.field.pid, 'name':data.field.name, '_token':'{{csrf_token()}}'},
                success:function (data){

                    var id = data.id;

                    $('#x-link').append('<tr><td><input type="checkbox"value="1"name=""></td><td>'+data.id+'</td><td>'+data.parent_id+'</td><td>'+data.cate_name+'</td><td class="td-manage"><a title="编辑"href="javascript:;"onclick="cate_edit(\'编辑\',\'cate-edit.html\',\'4\',\'\',\'510\')"class="ml-5"style="text-decoration:none"><i class="layui-icon">&#xe642;</i></a><a title="删除"href="javascript:;"onclick="cate_del(this,\'1\')"style="text-decoration:none"><i class="layui-icon">&#xe640;</i></a></td></tr>');

                }
            });
            layer.alert("增加成功", {icon: 6});
            $('#x-link').prepend('<tr><td><input type="checkbox"value="1"name=""></td><td>1</td><td>1</td><td>'+data.field.name+'</td><td class="td-manage"><a title="编辑"href="javascript:;"onclick="cate_edit(\'编辑\',\'cate-edit.html\',\'4\',\'\',\'510\')"class="ml-5"style="text-decoration:none"><i class="layui-icon">&#xe642;</i></a><a title="删除"href="javascript:;"onclick="cate_del(this,\'1\')"style="text-decoration:none"><i class="layui-icon">&#xe640;</i></a></td></tr>');
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
            $(obj).parents("tr").remove();
            layer.msg('已删除!',{icon:1,time:1000});
        });
    }
</script>
@endsection
