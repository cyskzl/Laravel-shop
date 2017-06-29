@extends('admin.layouts.layout')

@section('title','轮播图管理')

@section('x-nav')
    <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>轮播图列表</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
@endsection

@section('x-body')
    <xblock><button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button><button class="layui-btn" onclick="banner_add('添加轮播图','{{ url('admin/carousel/create') }}','600','500')"><i class="layui-icon">&#xe608;</i>添加</button><span class="x-right" style="line-height:40px">共有数据：88 条</span></xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <input type="checkbox" name="" value="">
            </th>
            <th>ID</th>
            <th>缩略图</th>
            <th>链接</th>
            <th>描述</th>
            <th>展示位置</th>
            <th>排序</th>
            <th>显示状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody id="x-img">
        @foreach($carousel as $car)
        <tr>
            <td>
                <input type="checkbox" value="1" name="">
            </td>
            <td>
                {{$car->id}}
            </td>
            <td>
                <img  src="{{asset(trim($car->img,','))}}" width="200" alt="">点击图片试试
            </td>
            <td >
                {{$car->link}}
            </td>
            <td >
                {{$car->desc}}
            </td>
            <td>
                {{$type[$car->type_id]}}
            </td>
            <td>
                <input type="text" name="orderby" onchange="changeOrder(this,'{{$car->id}}')" value={{$car->orderby}} size="1">
            </td>
            <td class="td-status">
                <div id="car_status" class="layui-unselect layui-form-checkbox {{$car->status==0?'layui-form-checked':''}}" onclick="changeStatus('{{$car->id}}','{{$car->status}}')" lay-skin="">
                    <span>显示</span><i class="layui-icon"></i>
                </div>
            </td>
            <td class="td-manage">
                <a style="text-decoration:none" onclick="banner_stop(this,'{{$car->id}}')" href="javascript:;" title="显示">
                    <i class="layui-icon">&#xe609;</i>
                </a>
                <a title="编辑" href="javascript:;" onclick="banner_edit('编辑','{{ url('admin/carousel/'.$car->id.'/edit') }}','{{$car->id}}','','510')"
                   class="ml-5" style="text-decoration:none">
                    <i class="layui-icon">&#xe642;</i>
                </a>
                <a title="删除" href="javascript:;" onclick="banner_del(this,'1')"
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
                {!! $carousel->appends($request->only(['keyword']))->render() !!}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function changeOrder(obj,id){
            var orderby = $(obj).val();
            $.ajax({
                type:'POST',
                url:'{{url('admin/carousel/orderby')}}',
                dataType: 'json',
                data:{'_token':'{{csrf_token()}}','orderby':orderby,'id':id},
                success: function (data){
                    if(data==1){
                        location.href = location.href;
                        layer.msg('排序成功', {icon: 6,time:1000});
                    }else{
                        layer.msg('排序失败', {icon: 5,time:1000});
                    }
                }
            });
        }

        function changeStatus(id,status){
            if(status==0){
                status=1;
            }else{
                status=0;
            }
            $.ajax({
                type:'POST',
                url:'{{url('admin/carousel/status')}}',
                dataType: 'json',
                data:{'_token':'{{csrf_token()}}','id':id,'status':status},
                success: function (data){
                    if(data==1){
                        layer.msg('修改成功', {icon: 6,time:3000});
                        location.href = location.href;
                    }else{
                        layer.msg('修改失败', {icon: 5,time:3000});
                    }
                }
            });
        }
    </script>
    <script>
        layui.use(['laydate','element','laypage','layer'], function(){
            $ = layui.jquery;//jquery
            laydate = layui.laydate;//日期插件
            lement = layui.element();//面包导航
            laypage = layui.laypage;//分页
            layer = layui.layer;//弹出层

            //以上模块根据需要引入

            layer.ready(function(){ //为了layer.ext.js加载完毕再执行
                layer.photos({
                    photos: '#x-img'
                    //,shift: 5 //0-6的选择，指定弹出图片动画类型，默认随机
                });
            });

        });

        //批量删除提交
        function delAll () {
            layer.confirm('确认要删除吗？',function(index){
                //捉到所有被选中的，发异步进行删除
                layer.msg('删除成功', {icon: 1});
            });
        }
        /*添加*/
        function banner_add(title,url,w,h){
            x_admin_show(title,url,w,h);
        }
        /*停用*/
        function banner_stop(obj,id){
            layer.confirm('确认不显示吗？',function(index){
                //发异步把用户状态进行更改
                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="banner_start(this,id)" href="javascript:;" title="显示"><i class="layui-icon">&#xe62f;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-disabled layui-btn-mini">不显示</span>');
                $(obj).remove();
                layer.msg('不显示!',{icon: 5,time:1000});
            });
        }

        /*启用*/
        function banner_start(obj,id){
            layer.confirm('确认要显示吗？',function(index){
                //发异步把用户状态进行更改
                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="banner_stop(this,id)" href="javascript:;" title="不显示"><i class="layui-icon">&#xe601;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-normal layui-btn-mini">已显示</span>');
                $(obj).remove();
                layer.msg('已显示!',{icon: 6,time:1000});
            });
        }
        // 编辑
        function banner_edit (title,url,id,w,h) {
            x_admin_show(title,url,w,h);
        }
        /*删除*/
        function banner_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                //发异步删除数据
                $(obj).parents("tr").remove();
                layer.msg('已删除!',{icon:1,time:1000});
            });
        }
    </script>
@endsection