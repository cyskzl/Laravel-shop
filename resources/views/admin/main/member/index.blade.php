@extends('admin.layouts.layout')
@section('x-nav')
    <span class="layui-breadcrumb">
      <a><cite>首页</cite></a>
      <a><cite>会员管理</cite></a>
      <a><cite>会员列表</cite></a>
    </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
@endsection
@section('x-body')
    <form class="layui-form x-center" action="{{url('admin/member')}}" method="get" style="width:800px">
        <div class="layui-form-pane" style="margin-top: 15px;">
            <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-inline">
                    <input type="text" name="keyword"  placeholder="请输入邮箱" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-input-inline" style="width:80px">
                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                </div>
            </div>
        </div>
    </form>
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button>
        <button class="layui-btn" onclick="question_add('添加订单','{{ url('admin/member/create') }}','800','500')"><i class="layui-icon">&#xe608;</i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：{{$userData->total()}} 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
            <tr>
                <th>
                    <input type="checkbox" name="" value="">
                </th>
                <th>ID</th>
                <th>电话</th>
                <th>邮箱</th>
                <th>第三方ID</th>
                <th>注册IP</th>
                <th>加入时间</th>
                <th>注册状态</th>
                <th>收货地址</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach($userData as $v)
            <tr>
                <td>
                    <input type="checkbox" value="1" name="">
                </td>
                <td>
                    {{$v->id}}
                </td>
                <td>
                    <u style="cursor:pointer" onclick="member_show('{{$v->id}}','{{ url('admin/member').'/'.$v->id }}','500','500')">
                        {{$v->tel}}
                    </u>
                </td>
                <td >{{$v->email}}</td>
                <td >{{$v->third_party_id}}</td>
                <td >{{$v->register_ip}}</td>
                <td >{{$v->created_at}}</td>
                <td >{{$type[$v->status]}}</td>
                <td ><a href="javascript:;" onclick="member_show('{{$v->id}}','{{'./address'.'?id='.$v->id }}','800','800')" class="layui-btn layui-btn-mini">收货地址</a></td>
                <td class="td-manage">
                    <a title="编辑" href="javascript:;" onclick="member_edit('编辑','{{url('admin/member/'.$v->id.'/edit')}}','{{$v->id}}','','510')"
                       class="ml-5" style="text-decoration:none">
                        <i class="layui-icon">&#xe642;</i>
                    </a>
                    <a title="删除" href="javascript:;" onclick="member_del(this,'{{$v->id}}')"
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
                {!! $userData->appends($request->only(['keyword']))->render() !!}
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    layui.use(['laydate','element','layer'], function(){
        $ = layui.jquery;//jquery
        laydate = layui.laydate;//日期插件
        lement = layui.element();//面包导航
        layer = layui.layer;//弹出层

    });

    //批量删除提交
    function delAll () {
        layer.confirm('确认要删除吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
        });
    }

    /*用户-查看*/
    function member_show(title,url,id,w,h){
        x_admin_show(title,url,w,h);
    }

    /*添加*/
    function question_add(title,url,w,h){
        x_admin_show(title,url,w,h);
    }

    // 用户-编辑
    function member_edit (title,url,id,w,h) {
        x_admin_show(title,url,w,h);
    }
    /*密码-修改*/
    function member_password(title,url,id,w,h){
        x_admin_show(title,url,w,h);
    }
    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
//            console.log(id);
            $.ajax({
                type: "DELETE",
                url: "member/"+id,
                data: { '_token':'{{csrf_token()}}', '_method': 'DELETE', 'id': id },
                dataType:'json',
                success: function(data){
//                    console.log(data);
                    if(data == 1){
                        location.href = location.href;
                        $(obj).parents("tr").remove();
                        layer.msg('删除成功', {icon: 6,time:1000});
                    } else {
                        layer.msg('删除失败', {icon: 5,time:1000});
                    }
                }
            });

        });
    }
</script>
@endsection