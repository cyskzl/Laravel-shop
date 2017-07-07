@extends('admin.layouts.layout')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('org/ajax/ajax.css')}}">
    <script src="{{asset('org/ajax/ajax.js')}}" type="text/javascript"></script>
@endsection
@section('x-nav')
    <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>商品标签管理</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
@endsection
@section('x-body')
    <form class="layui-form " action="{{url('admin/goodstabcate')}}" style="width:800px">
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
        {{--<a href="{{url('admin/goodscategory/create')}}"><button class="layui-btn" ><i class="layui-icon">&#xe608;</i>增加</button></a>--}}
        <button class="layui-btn" onclick="question_add('添加商品','{{ url('admin/goodstabcate/create') }}','800','500')"><i
                    class="layui-icon">&#xe608;</i>添加
        </button>
        <span class="x-right" style="line-height:40px">共有数据：  条</span></xblock>

    <xblock>

        <table class="layui-table">
            <thead>
            <tr>
                <th><input type="checkbox" name="" value=""></th>
                <th>ID</th>
                <th>选项卡名称</th>
                <th>所属分类名称</th>
                <th>热卖</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="x-link">
            @if(count($goodstabcate) > 0)
                @foreach($goodstabcate as $tabcate)
                    <tr>
                        <td>
                            <input type="checkbox" value="{{ $tabcate->id }}" name="id">
                        </td>
                        <td>{{ $tabcate->id }}</td>
                        <td>{{ $tabcate->name }}</td>
                        <td>{{ $tabcate->cat_id }}</td>
                        <td>

                            <div style="text-align: center; width: 50px;">
                             <span class="@if($tabcate->is_display == '0') no @else yes @endif" id="is_display"  onclick="changeTableVal('is_display' , 'goods_tab_cate', '{{$tabcate->id}}' ,'{{url('/admin/ajax')}}',this)">
                             @if($tabcate->is_display == '0')<i class=" Wrong">✘</i>否 @else  <i class="fanyes">✔</i>是 @endif
                             </span>
                            </div>
                        </td>
                        <td class="td-manage">
                            <a title="编辑" href="javascript:;" onclick="rule_edit('编辑','{{ url('admin/goodstabcate/'.$tabcate->id.'/edit') }}','{{ $tabcate->id }}','','510')"
                               class="ml-5" style="text-decoration:none">
                                <i class="layui-icon">&#xe642;</i>
                            </a>
                            <a title="删除" href="javascript:;" onclick="rule_del(this,{{ $tabcate->id }})"
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
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-4">
                    {{--{{$specs->links()}}--}}
                    {!! $goodstabcate->appends($request->only(['keyword']))->render() !!}
                </div>
            </div>
        </div>

        @endsection
        @section('js')
            <script src="{{ asset('templates/admin/lib/layui/layui.js') }}" charset="utf-8"></script>
            <script src="{{ asset('templates/admin/js/x-layui.js') }}" charset="utf-8"></script>
            <script>
                layui.use(['element', 'laypage', 'layer', 'form'], function () {
                    $ = layui.jquery;//jquery
                    lement = layui.element();//面包导航
                    laypage = layui.laypage;//分页
                    layer = layui.layer;//弹出层
                    form = layui.form();//弹出层

                });

                //以上模块根据需要引入

                //批量删除提交
                function delAll() {
                    layer.confirm('确认要删除吗？', function (index) {
                        //捉到所有被选中的，发异步进行删除
                        layer.msg('删除成功', {icon: 1});
                    });
                }

                /*添加*/
                function question_add(title, url, w, h) {
                    x_admin_show(title, url, w, h);
                }

                //-编辑
                function rule_edit(title, url, id, w, h) {
                    x_admin_show(title, url, w, h);
                }

                /*删除*/
                function rule_del(obj, id) {
                    layer.confirm('确认要删除吗？', function (index) {
                        //发异步删除数据
                        $.ajax({
                            url:'{{ url('admin/goodstabcate') }}' + '/' + id,
                            type:'delete',
                            datatype:'json',
                            data:{'_token':"{{ csrf_token() }}"},
                            success:function (data) {
                                if(data.status == 1){
                                    layer.msg(data.msg,{icon:5,time:1000});
                                }  else if(data.status == 0) {
                                    location.href = location.href;
                                    $(obj).parents("tr").remove();
                                    layer.msg(data.msg ,{icon:1,time:1000});
                                }
                            }
                        });

                    });
                }
            </script>
@endsection