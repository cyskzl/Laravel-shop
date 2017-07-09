@extends('admin.layouts.layout')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('org/ajax/ajax.css')}}">
    <script src="{{asset('org/ajax/ajax.js')}}" type="text/javascript"></script>
@endsection
@section('x-nav')
    <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>轮播图列表</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
@endsection

@section('x-body')
    <form class="layui-form " action="{{url('admin/carousel')}}" style="width:800px">
        <div class="layui-form-pane" style="margin-top: 15px;">
            <div class="layui-form-item">
                <label class="layui-form-label">搜索</label>
                <div class="layui-input-inline">
                    <input type="text" name="keyword" value="{{$request->input('keyword')}}" placeholder="标题" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-input-inline" style="width:80px">
                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                </div>
            </div>
        </div>
    </form>
    <xblock><button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button><button class="layui-btn" onclick="banner_add('添加轮播图','{{ url('admin/carousel/create') }}','600','500')"><i class="layui-icon">&#xe608;</i>添加</button><span class="x-right" style="line-height:40px">共有数据：{{$carousel->total()}} 条</span></xblock>
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
                {{getCateNameByCateId($car->cate_id)}}
            </td>
            <td>
                <form class="layui-form" action="" id="orderid">
                    <input onkeyup="this.value=this.value.replace(/[^\d]/g,'')" type="text"  name="orderby" onchange="changeTableVal('orderby','carousels','{{$car->id}}','{{url('/admin/ajax')}}',this)" value="{{$car->orderby}}"  size="1">
                </form>
            </td>
            <td class="td-status">
                <div style="text-align: center; width: 50px;">
                     <span class="@if($car->status == '1') no @else yes @endif" id="status"  onclick="changeTableVal('status' , 'carousels', '{{$car->id}}' ,'{{url('/admin/ajax')}}',this)">
                     @if($car->status == '1')<i class=" Wrong">✘</i>否 @else  <i class="fanyes">✔</i>是 @endif
                     </span>
                </div>
            </td>
            <td class="td-manage">
                {{--<a style="text-decoration:none" onclick="banner_stop(this,'{{$car->id}}')" href="javascript:;" title="显示">--}}
                    {{--<i class="layui-icon">&#xe609;</i>--}}
                {{--</a>--}}
                <a title="编辑" href="javascript:;" onclick="banner_edit('编辑','{{ url('admin/carousel/'.$car->id.'/edit') }}','{{$car->id}}','','510')"
                   class="ml-5" style="text-decoration:none">
                    <i class="layui-icon">&#xe642;</i>
                </a>
                <a title="删除" href="javascript:;" onclick="banner_del(this,'{{$car->id}}')"
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

        // 编辑
        function banner_edit (title,url,id,w,h) {
            x_admin_show(title,url,w,h);
        }
        /*删除*/
        function banner_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                //发异步删除数据
                $.ajax({
                    type:'DELETE',
                    url:'{{url('admin/carousel')}}/'+id,
                    dateType:'json',
                    data: { '_token':'{{csrf_token()}}', '_method': 'DELETE'},
                    success:function (data){
//                        console.log(data);return false;
                        if(data == 1){
                            location.href = location.href;
                            $(obj).parents("tr").remove();
                            layer.msg('已删除!',{icon:6,time:1000});
                            return false;
                        } else {
                            layer.msg('删除失败啦!请重试', {icon: 5,time:1000});
                        }
                    }
                });
            });
        }
    </script>
@endsection