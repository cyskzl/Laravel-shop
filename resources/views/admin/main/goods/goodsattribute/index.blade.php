@extends('admin.layouts.layout')
@section('x-nav')
    <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>商品规格管理</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
@endsection
@section('x-body')
    <form class="layui-form " action="{{url('admin/goodsattr')}}" style="width:800px">
        <div class="layui-form-pane" style="margin-top: 15px;">
            <div class="layui-form-item">
                <label class="layui-form-label">搜索</label>
                <div class="layui-input-inline">
                    <select name="typename" >
                        <option value="">--请选择--</option>
                        <option value="">所有模型</option>
                        @foreach($typeinfos as $typeinfo)
                        <option value="{{$typeinfo->id}}" @if($request->typename == $typeinfo->id) selected @endif>{{$typeinfo->name}}  </option>
                        @endforeach
                    </select>
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="keyword" value="{{$request->input('keyword')}}" placeholder="属性名称" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-input-inline" style="width:80px">
                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                </div>
            </div>
        </div>
    </form>
    <xblock><button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button>
        <button class="layui-btn" onclick="question_add('添加属性','{{ url('admin/goodsattr/create') }}','800','500')"><i
                    class="layui-icon">&#xe608;</i>添加
        </button>
        {{--<a href="{{url('admin/spec/create')}}"><button class="layui-btn" ><i class="layui-icon">&#xe608;</i>增加</button></a>--}}
        <span class="x-right" style="line-height:40px">共有数据：{{$goodsattrs->total()}} 条</span></xblock>
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
                属性名称
            </th>
            <th>
                所属模型
            </th>
            <th>
                属性值的输入方式
            </th>
            <th>
                可选值列表
            </th>
            <th>
                筛选
            </th>
            <th>
                排序
            </th>

            <th>
                操作
            </th>
        </tr>
        </thead>
        <tbody id="x-link">
        @foreach($goodsattrs as $goodsattr)
            <tr>
                <td>
                    <input type="checkbox" value="1" name="">
                </td>
                <td>
                    {{$goodsattr->attr_id}}
                </td>
                <td>
                    {{$goodsattr->attr_name}}
                </td>
                <td>
                    {{--自定义函数--}}
                    {{getSpecType($goodsattr->type_id)}}
                    {{--{{$spec->type_id}}--}}
                </td>
                <td>
                    {{$goodsattr->attr_input_type}}

                </td>
                <td>
                    {{$goodsattr->attr_values}}
                </td>
                <td>
                    <form class="layui-form" action="">
                        <input type="checkbox" lay-submit lay-filter="attr_index" name="{{$goodsattr->attr_id}}"  value="{{$goodsattr->attr_index}}" title="是" @if($goodsattr->attr_index == 1) checked @endif>
                    </form>
                </td>
                <td>
                    <form class="layui-form" action="" id="orderid">
                        <input type="text" id="order" name="order" value="{{$goodsattr->order}}" specid="{{$goodsattr->attr_id}}" size="1">
                    </form>

                </td>
                <td class="td-manage">
                    <a title="编辑" href="javascript:;" onclick="cate_edit('编辑','/admin/goodsattr/{{$goodsattr->attr_id}}/edit','{{$goodsattr->attr_id}}','','510')"
                       class="ml-5" style="text-decoration:none">
                        <i class="layui-icon">&#xe642;</i>
                    </a>
                    <a title="删除" href="javascript:;" onclick="cate_del(this,'{{$goodsattr->attr_id}}')"
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
                {{--{{$specs->links()}}--}}
                {!! $goodsattrs->appends($request->only(['keyword', 'typename']))->render() !!}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('templates/admin/js/jquery.min.js')}}" type="text/javascript"></script>
    <script>
        layui.use(['element','layer','form'], function(){
            $ = layui.jquery;//jquery
            lement = layui.element();//面包导航
            layer = layui.layer;//弹出层
            form = layui.form();
            //筛选
            form.on('checkbox(attr_index)', function(data){
//                console.log(data.elem); //得到checkbox原始DOM对象
//                console.log(data.elem.checked); //是否被选中，true或者false
//                console.log(data.elem.name); //复选框value值，也可以通过data.elem.value得到
//                console.log(data.othis); //得到美化后的DOM对象
                if(data.elem.checked == true){
                    data.elem.value = 1;
                } else {
                    data.elem.value = 0;
                }
                $.ajax({
                    type: 'post',
                    url:  '/admin/ajax/attr_index/goods_attribute',
                    dataType: 'json',
                    data: { '_token':'{{csrf_token()}}',  'id': data.elem.name, 'value':data.elem.value },
                    success:function (data){
//                           console.log(data);
                    }
                });
            })

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

        /*添加*/
        function question_add(title, url, w, h) {
            x_admin_show(title, url, w, h);
        }


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
                    type: 'post',
                    url:  '{{url('/admin/goodsattr/')}}'+'/'+id,
                    dataType: 'json',
                    data: { '_token':'{{csrf_token()}}', '_method': 'DELETE', 'id': id },
                    success:function (data){
                        if(data.status == 1){
                            layer.msg(data.msg, {icon: 5,time:1000});
                            return false;
                        }
                        location.href = location.href;
                        $(obj).parents("tr").remove();
                        layer.msg(data.msg ,{icon:1,time:1000});
                    }
                });
            });
        }

        //排序
        $('#order').on('change ', function(){

            var order = $(this).val();
            var id = $(this).attr('specid');
            console.log( 123);
            console.log(id);
            $.ajax({
                type: 'post',
                url:  '/admin/ajax/order/goods_attribute',
                dataType: 'json',
                data: { '_token':'{{csrf_token()}}',  'id': id, 'value':order },
                success:function (data){
                    if(data.status == 0){
                        layer.msg('更新失败', {icon: 5,time:1000});
                    }
                    layer.msg('更新成功' ,{icon:1,time:1000});
                }
            });
        })


    </script>

@endsection