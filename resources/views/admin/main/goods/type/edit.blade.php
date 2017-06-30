@extends('admin.layouts.layout')

@section('x-body')

    <form class="layui-form">
        <div class="layui-form-item">
            <label for="cname" class="layui-form-label">
                ID
            </label>
            <div class="layui-input-inline">
                <input type="text" id="id" name="id" required="" lay-verify="required"
                       autocomplete="off"  value="{{$info->id}}" disabled="" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="cname" class="layui-form-label">
                <span class="x-red">*</span>类型名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="name" value="{{$info->name}}" name="name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="save" lay-submit="">
                保存
            </button>
        </div>
    </form>
    @endsection

@section('js')

    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
            var form = layui.form()
                ,layer = layui.layer;


            //监听提交
            form.on('submit(save)', function(data){
                console.log(data);
                //发异步，把数据提交给php
                $.ajax({
                    type: 'post',
                    url:  "/admin/type/"+data.field.id,
                    dataType: 'json',
                    data: {
                        '_token':'{{csrf_token()}}',
                        '_method': 'PUT',
                        'name': data.field.name,
                        'id': data.field.id,
                    },
                    success:function (data){
                        if(data.status == 1){
                                layer.msg(data.msg, {icon: 5});
                        } else if(data.status == 3){
                            layer.msg(data.msg, {icon: 5});
                        } else if(data.status == 0){
                            layer.alert("保存成功", {icon: 6},function () {
                                // 获得frame索引
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