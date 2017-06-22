@extends('admin.layouts.layout')
@section('x-nav')
    <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>商品分类管理</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
@endsection
@section('x-body')
    <form class="layui-form " action="{{url('admin/goodscategory')}}" style="width:800px">
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
    <xblock>

        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button>
        <a href="{{url('admin/goodscategory/create')}}"><button class="layui-btn" ><i class="layui-icon">&#xe608;</i>增加</button></a>
        <span class="x-right" style="line-height:40px">共有数据：{{ $cates->total()}}  条</span></xblock>
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
                分类描述
            </th>
            <th>
                操作
            </th>
        </tr>
        </thead>
        <center id="x-link">
                @foreach($cates as $v)
            <tr>
                <td>
                    <input type="checkbox" value="1" name="">
                </td>
                <td>
                    {{ $v->id }}
                </td>
                <td>
                    {{--自定义函数app/Common/function.php--}}
                    {{getCateNameByCateId($v->pid)}}
                </td>
                <td>
                    {{ $v->name }}
                </td>
                <td>
                   {{$v->describe =  $v->describe?:"无描述"}}
                </td>
                <td class="td-manage">
                    <a title="编辑" href="javascript:;" onclick="cate_edit('编辑','/admin/goodscategory/{{$v->id}}/edit','{{$v->id}}','','510')"
                       class="ml-5" style="text-decoration:none">
                        <i class="layui-icon">&#xe642;</i>
                    </a>
                    <a title="删除" href="javascript:;" onclick="cate_del(this,'{{$v->id}}')" style="text-decoration:none">
                    {{--<a title="删除" href="javascript:;" onclick="cate_del(this,'{{$v->id}}')" style="text-decoration:none">--}}
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
                {{--{{$cates->links()}}--}}
                {!! $cates->appends($request->only(['keyword']))->render() !!}
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
//            console.log(url);
            x_admin_show(title,url,w,h);
        }

        /*-删除*/
        function cate_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                //发异步删除数据
{{--                var url = {{url('/goodscategory/')}}+id;--}}
//                console.log(url);
                $.ajax({
                    type: 'DELETE',
                    url:  '{{url('/admin/goodscategory/')}}'+'/'+id,
                    dataType: 'json',
                    data: { '_token':'{{csrf_token()}}', '_method': 'DELETE', 'id': id },
                    success:function (data){
                       if(data == 1){
                           //有子类不能删除给提示
                           layer.msg('删除失败啦！检查有无子类', {icon: 5,time:1000});
                           return false;
                       } else {
                           location.href = location.href;
                           $(obj).parents("tr").remove();
                           layer.msg('已删除!',{icon:1,time:1000});
                       }
                    }
                });

            });
        }
    </script>
@endsection