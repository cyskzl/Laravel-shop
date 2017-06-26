@extends('admin.layouts.layout')
@section('x-body')
    <form class="layui-form layui-form-pane">
        <div class="layui-form-item">
            <label class="layui-form-label" style="width: 100px">属性名称</label>
            <div class="layui-input-block">
                <input type="text" name="attr_name" required="" lay-verify="required" placeholder="请输入属性名称" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label" style="width: 100px">所属类型</label>
            <div class="layui-input-block">
                <select name="type_id" lay-verify="required">
                    <option value="">--请选择--</option>
                    @foreach($typeinfos as $typeinfo)
                        <option value="{{$typeinfo->id}}">{{$typeinfo->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 100px">进行检索</label>
                <div class="layui-input-block">
                    <input type="radio" name="attr_index" value="0" title="不需要检索" checked="">
                    <input type="radio" name="attr_index" value="1" title="关键字检索">

                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 100px">录入方式</label>
                <div class="layui-input-block">
                    <input type="radio" name="attr_input_type" value="0" title="手工录入" checked="">
                    <input type="radio" name="attr_input_type" value="1" title="从下面的列表中选择（一行代表一个可选值）">
                    <input type="radio" name="attr_input_type" value="2" title="多行文本框">
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">可选值列表：</label>
                <div class="layui-input-block">
                    <textarea placeholder="录入方式为手工或者多行文本时，此输入框不需填写。" class="layui-textarea" name="attr_values"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <button class="layui-btn" lay-filter="add" lay-submit>立即发布</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
    </form>
@endsection

@section('js')
    <script>
        layui.use(['form','layer','layedit'], function(){
            $ = layui.jquery;
            var form = layui.form()
                ,layer = layui.layer
                ,layedit = layui.layedit;


            layedit.set({
                uploadImage: {
                    url: "./upimg.json" //接口url
                    ,type: 'post' //默认post
                }
            })

            //监听提交
            form.on('submit(add)', function(data){

//                console.log(data);
                //发异步，把数据提交给php
                $.ajax({
                    type: 'post',
                    url:  '/admin/goodsattr',
                    dataType: 'json',
                    data: { '_token':'{{csrf_token()}}',  'json': JSON.stringify(data.field) },
                    success:function (data){
                        //失败
                        if(data.status == 1){
                            layer.msg(data.msg, {icon: 5,time:1000});
                         //所属不能为空
                        } else if(data.status == 2){
                            layer.msg(data.msg, {icon: 5,time:1000});
                            //属性名称不能为空
                        }else if(data.status == 3){
                            layer.msg(data.msg, {icon: 5,time:1000});
                        } else if (data.status == 0){
                            //成功
                            layer.alert(data.msg, {icon: 6},function () {
                                //获得frame索引
                                var index = parent.layer.getFrameIndex(window.name);
                                //关闭当前frame
                                parent.layer.close(index);
                            });
                        }
                    }
                });

                return false;
            });


        });
    </script>

@endsection