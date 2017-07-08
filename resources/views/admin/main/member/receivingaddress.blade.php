@extends('admin.layouts.layout')

@section('x-body')
    @foreach($address as $v)
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>{{$v->consignee}}{{$v->is_default==0?'(默认地址)':''}}</legend>
    </fieldset>

    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
                <col width="10%">
                <col width="80%">
            </colgroup>
            <thead>
            <tr>
                <th>收货人：</th>
                <td>{{$v->consignee}}</td>
            </tr>
            <tr>
                <th>所在地区：</th>
                <td>{{$province[$v->province].$city[$v->city].$district[$v->district].$twon[$v->twon]}}</td>
            </tr>
            <tr>
                <th>详细地址：</th>
                <td>{{$v->detailed_address}}</td>
            </tr>
            <tr>
                <th>手机：</th>
                <td>{{$v->mobile}}</td>
            </tr>
            <tr>
                <th>电子邮箱：</th>
                <td>{{$v->email}}</td>
            </tr>
            <tr>
                <td id="edit" colspan="2">
                    @if($v->is_default == 1)
                        <a href="javascript:;" id="is_default" value="{{$v->id}}" onclick="ajax(this,'PUT',1)">设为默认</a>
                    @endif
                    <a href='{{url('home/address').'/'.$v->id.'/edit'}}' id="update" value="{{$v->id}}" >编辑</a>
                    <a href="javascript:;" id="del" value="{{$v->id}}" onclick="ajax(this,'DELETE',1)">删除</a>
                </td>
            </tr>
            </thead>
        </table>
    </div>
    @endforeach
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
                {!! $address->appends($request->only(['keyword']))->render() !!}
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
