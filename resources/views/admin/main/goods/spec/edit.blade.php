@extends('admin.layouts.layout')
@section('x-body')
    <form class="layui-form layui-form-pane">
        <input type="hidden" value="{{$info->id}}" name="id">
        <div class="layui-form-item">
            <label class="layui-form-label" style="width: 100px">规格名称</label>
            <div class="layui-input-block">
                <input type="text" name="name" required="" lay-verify="required" value="{{$info->name}}" placeholder="请输入规格名称" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label" style="width: 100px">所属类型</label>
            <div class="layui-input-block">
                <select name="type_id" lay-verify="required">
                    <option >--请选择--</option>
                    @foreach($typeinfos as $typeinfo)
                        <option value="{{$typeinfo->id}}" @if($typeinfo->id == $info->type_id) selected @endif>{{$typeinfo->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">规格项</label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入规格项,每项以逗号分隔" class="layui-textarea" name="item"> {{$info->specitem->item}}</textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 100px">排序</label>
                <div class="layui-input-block">
                    <input type="text" name="order" value="{{$info->order}}" required="" lay-verify="required" placeholder="请输入排序" autocomplete="off" class="layui-input">
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

                console.log(data);
                //发异步，把数据提交给php
                $.ajax({
                    type: 'post',
                    url:  "/admin/spec/"+data.field.id,
                    dataType: 'json',
                    data: {
                        '_token':'{{csrf_token()}}',
                        '_method': 'PUT',
                        'json': JSON.stringify(data.field)
                    },
                    success:function (data){
//                        console.log(data);
                        if(data.status == 0){
                            //失败
                            layer.msg(data.msg, {icon: 5});

                        }
                        //成功
                        layer.alert(data.msg, {icon: 6},function () {
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前frame
                            parent.layer.close(index);
                            layer.msg(data.msg, {icon: 5});
                        });

                    }});

                    return false;
                    }
                );


        });

    </script>

@endsection