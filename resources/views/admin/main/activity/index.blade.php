@extends('admin.layouts.layout')

@section('title','活动浏览')

@section('x-nav')
    <span class="layui-breadcrumb">
      <a><cite>首页</cite></a>
      <a><cite>活动列表</cite></a>
    </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
@endsection

@section('x-body')
    <form class="layui-form x-center" action="{{url('admin/activity')}}" style="width:800px">
        <div class="layui-form-pane" style="margin-top: 15px;">
            <div class="layui-form-item">
                <label class="layui-form-label">活动名称</label>
                <div class="layui-input-inline">
                    <input type="text" name="keyword"  placeholder="请输入活动名称" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-input-inline" style="width:80px">
                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                </div>
            </div>
        </div>
    </form>
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button>
        <a href="{{url('admin/activity/create')}}"><button class="layui-btn" ><i class="layui-icon">&#xe608;</i>增加</button></a>
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        <span class="x-right" style="line-height:40px">共有数据：{{$activities->total()}} 条</span></xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <input type="checkbox" name="" value="">
            </th>
            <th>ID</th>
            <th>活动名称</th>
            <th>活动类型</th>
            <th>优惠力度</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>查看商品</th>
            <th>添加商品</th>
            <th>开启活动</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($activities as $activity)
        <tr>
            <td>
                <input type="checkbox" value="1" name="">
            </td>
            <td>
                {{$activity->id}}
            </td>
            <td>
                <u style="cursor:pointer" onclick="question_show('活动商品展示','{{'./activity/'.$activity->id }}','800','800')">
                    {{$activity->name}}
                </u>
            </td>
            <td >
                {{$type[$activity->type]}}
            </td>
            <td >
                {{$activity->act_range}}
            </td>
            <td >
                {{$activity->start_time}}
            </td>
            <td >
                {{$activity->end_time}}
            </td>
            <td ><a href="javascript:;" onclick="question_show('活动商品展示','{{'./activity/'.$activity->id }}','800','800')" class="layui-btn layui-btn-mini">查看商品</a></td>
            <td>
                <a title="添加" href="javascript:;" onclick="question_add('添加','{{ url('admin/goodsactivity/activity/?activity_id='.$activity->id) }}','','510')"
                   class="layui-btn layui-btn-mini" style="text-decoration:none">添加商品
                </a>
            </td>
            <td>
                @if ($activity->is_over == 0)
                    <button id="act_ready" value="{{$activity->id}}" class="layui-btn layui-btn-mini ">点击开始</button>
                @elseif ($activity->is_over == 1)
                    <span id="act_start" class="layui-btn layui-btn-mini layui-btn-warm">已开始</span>
                @else
                    <span id="act_end" class="layui-btn layui-btn-smal  layui-btn-danger">点击开始</span>
                @endif
            </td>
            <td class="td-manage">

                <a title="编辑" href="javascript:;" onclick="question_edit('编辑','{{ url('admin/activity/'.$activity->id.'/edit') }}','{{$activity->id}}','','510')"
                   class="ml-5" style="text-decoration:none">
                    <i class="layui-icon">&#xe642;</i>
                </a>
                <a title="删除" href="javascript:;" onclick="question_del(this,'{{$activity->id}}')"
                   style="text-decoration:none">
                    <i class="layui-icon">&#xe640;</i>
                </a>
            </td>
        </tr>
        </tbody>
        @endforeach
    </table>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
                {!! $activities->appends($request->only(['keyword']))->render() !!}
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        layui.use(['laydate','element','laypage','layer'], function(){
            $ = layui.jquery;//jquery
            lement = layui.element();//面包导航
            laypage = layui.laypage;//分页
            layer = layui.layer;//弹出层

        });

        // 修改活动 状态（开始）
        $('#act_ready').click(function (){
            var status = 1;
            var id = $(this).val();
            $.ajax({
                type:'PUT',
                url:"./activity/"+id,
                dataType:'json',
                data:{'status':status,'_method':'PUT','_token':"{{csrf_token()}}"},
                success: function(data){
                    if(data){
                        location.href = location.href;
                        layer.msg('活动已开始!',{icon:6,time:1000});
                    }
                }
            });
        });

        //批量删除提交
        function delAll () {
            layer.confirm('确认要删除吗？',function(index){
                //捉到所有被选中的，发异步进行删除
                layer.msg('删除成功', {icon: 1});
            });
        }

        function question_show (title,url,id,w,h) {
            x_admin_show(title,url,w,h);
        }
        /*添加*/
        function question_add(title,url,w,h){
            x_admin_show(title,url,w,h);
        }
        //编辑
        function question_edit (title,url,id,w,h) {
            x_admin_show(title,url,w,h);
        }

        /*删除*/
        function question_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                //发异步删除数据
                $.ajax({
                    type:'DELETE',
                    url:'{{url('admin/activity')}}/'+id,
                    dateType:'json',
                    data: { '_token':'{{csrf_token()}}', '_method': 'DELETE', 'id': id },
                    success:function (data){
//                        console.log(data);
                        if(data == 1){
                            //已开始或结束的活动不能删提示
                            layer.msg('删除失败啦！活动已开启或已结束', {icon: 5,time:1000});
                            return false;
                        } else {
                            location.href = location.href;
                            $(obj).parents("tr").remove();
                            layer.msg('已删除!',{icon:6,time:1000});
                        }
                    }
                });
            });
        }
    </script>
@endsection
