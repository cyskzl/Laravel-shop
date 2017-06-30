@extends('admin.layouts.layout')
@section('style')
    <script src="{{asset('templates/admin/js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('org/uploadify/uploadify.css')}}">
    <script src="{{asset('org/uploads/uploadsImg.js')}}" type="text/javascript"></script>
    <style>
        .uploadify{ display: inline-block;}
        .uploadify-button{border:none;border-radius:5px;margin-top:8px;}
        .type-file-button{
            border-color: rgb(215, 215, 215);
            border-radius:0px 5px 5px 0px;
            color: rgb(255, 255, 255);
            display: inline-block;
            border-style: solid;
            vertical-align: top;
            border-width: 1px;
            border:none;
            width: 99px;
            height: 38px;
            background-color: #009688;;
        }
        .backclose{
            background:url({{asset('org/uploadify/uploadify-cancel.png')}});display: inline-block;height: 15px;width: 15px; position:relative;left: 95px;top:-36px;
        }
    </style>
@endsection
@section('x-body')
    <form class="layui-form layui-form-pane">
        <input type="hidden" value="{{$brand->id}}" name="id">
        <div class="layui-form-item">
            <label class="layui-form-label" style="width: 100px">品牌名称</label>
            <div class="layui-input-block">
                <input type="text" value='{{$brand->name}} 'name="name" required="" lay-verify="required" placeholder="请输入品牌名称" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label" style="width: 100px">品牌url</label>
            <div class="layui-input-block">
                <input type="url" name="url" value='{{$brand->url}}'required="" lay-verify="required" placeholder="请输入品牌url" autocomplete="off" class="layui-input">
            </div>
        </div>
        {{--logo--}}
        <div class="layui-form-item" >
            <div id="queue"></div>
            <div class="layui-form-item" >
                <label class="layui-form-label" style="width: 100px">图片</label>
                <div class="layui-input-inline" style="margin-left:10px;">
                    <input type="text" name="logo" id="img" autocomplete="off" class="layui-input" placeholder="不修改，默认为空">
                </div>
                <input id="file_upload"  type="file" multiple="true">

            </div>
            <div class="layui-form-item" id = 'thumbnail'>
                <label class="layui-form-label" style="width: 100px">缩略图
                </label>
                <div id='layer-photos-demo' class='layer-photos-demo' style='width: 660px;'>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label" style="width: 100px">排序</label>
            <div class="layui-input-block">
                <input type="text" name="sort" value="{{$brand->sort}}" required="" lay-verify="required" placeholder="请输入排序" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">品牌描述</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入品牌描述" class="layui-textarea" name="desc">{{$brand->desc}}</textarea>
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
        //logo 图实例
        var token ='{{csrf_token()}}';
        var uploadPath = "{{url('admin/upload/Brand')}}"
        //实例化上传函数
        upload(uploadPath,token)
        //实例化删除函数
        delimg(uploadPath)



        layui.use(['form','layer','layedit'], function(){
            $ = layui.jquery;
            var form = layui.form()
                ,layer = layui.layer
                ,layedit = layui.layedit;

            //监听提交
            form.on('submit(add)', function(data){

                console.log(data);
                //发异步，把数据提交给php
                $.ajax({
                    type: 'post',
                    url:  '/admin/brand/'+data.field.id,
                    dataType: 'json',
                    data: { '_token':'{{csrf_token()}}','_method' : 'PUT', 'json': JSON.stringify(data.field) },
                    success:function (data){
                        //失败
                        if(data.status == 1){
                            layer.msg(data.msg, {icon: 5,time:1000});
                        }
                        //成功
                        layer.alert(data.msg, {icon: 6},function () {
                            //获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前frame
                            parent.layer.close(index);
                        });

                    }
                });

                return false;
            });


        });
    </script>

@endsection