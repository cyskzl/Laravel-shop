@extends('admin.layouts.layout')
@section('x-nav')
    <div>
        <span class="layui-btn layui-btn-small">收货地址</span>
        <span class="x-right" style="line-height:40px">共有数据：{{count($userAddress)}} 条</span>
    </div>
@endsection
@section('x-body')

    <table class="layui-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>收货人</th>
            <th>联系电话</th>
            <th>详细地址</th>
        </tr>
        </thead>
        <tbody>
        @foreach($userAddress as $v)
            <tr>
                <td>{{$v->id}}</td>
                <td>{{$v->consignee}}</td>
                <td>{{$v->tel}}</td>
                <td>{{$v->province.$v->city.$v->country.$v->detailed_address}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-4">

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


            });
        }
    </script>
@endsection
