@extends('admin.layouts.layout')

@section('title','添加轮播图')

@section('style')
    <script src="{{asset('templates/admin/js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('org/uploadify/uploadify.css')}}">
    <script src="{{asset('org/uploads/uploadsImg.js')}}" type="text/javascript"></script>
    <style>
        .uploadify {
            display: inline-block;
        }

        .uploadify-button {
            border: none;
            border-radius: 5px;
            margin-top: 8px;
        }

        .type-file-button {
            border-color: rgb(215, 215, 215);
            border-radius: 0px 5px 5px 0px;
            color: rgb(255, 255, 255);
            display: inline-block;
            border-style: solid;
            vertical-align: top;
            border-width: 1px;
            border: none;
            width: 99px;
            height: 38px;
            background-color: #009688;;
        }

        .backclose {
            background: url({{asset('org/uploadify/uploadify-cancel.png')}});
            display: inline-block;
            height: 15px;
            width: 15px;
            position: relative;
            left: 95px;
            top: -36px;
        }

        /*table.add_tab */
    </style>
@endsection

@section('x-nav')
    <span>
        上传轮播图请大于1100*460
    </span>
@endsection

@section('x-body')
    <form class="layui-form" action="{{url('admin/carousel')}}">
        {{csrf_field()}}
        <div class="layui-form-item" >
            <div id="queue"></div>
            <div class="layui-form-item" >
                <label class="layui-form-label">图片</label>
                <div class="layui-input-inline" style="margin-left:30px;">
                    <input type="text" name="img" id="img" autocomplete="off" class="layui-input" lay-verify="required">
                </div>
                <input id="file_upload"  type="file" multiple="true">

            </div>
            <div class="layui-form-item" id = 'thumbnail'>
                <label class="layui-form-label">缩略图
                </label>
                <div id='layer-photos-demo' class='layer-photos-demo' style='width: 660px;'>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">
                    类别
                </label>
                <div class="layui-input-block">
                    <select lay-verify="required" name="type_id">
                        <option>
                        <option value="0">女士</option>
                        <option value="1">男士</option>
                        <option value="2">创意生活</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="link" class="layui-form-label">
                <span class="x-red">*</span>链接
            </label>
            <div class="layui-input-inline">
                <input type="text" id="link" name="link" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="desc" class="layui-form-label">
                <span class="x-red">*</span>描述
            </label>
            <div class="layui-input-inline">
                <input type="text" id="desc" name="desc" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="desc" class="layui-form-label">
                <span class="x-red">*</span>排序
            </label>
            <div class="layui-input-inline">
                <input type="text" id="orderby" name="orderby" required="" lay-verify="required" autocomplete="off" class="layui-input" value="0">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="add" lay-submit="">
                增加
            </button>
        </div>
    </form>
@endsection

@section('js')
    <script>
        var token ='{{csrf_token()}}';
        var uploadPath = "{{url('admin/upload/carousel')}}";
        //实例化上传函数
        upload(uploadPath,token);
        //实例化删除函数
        delimg(uploadPath);
    </script>
    <script>
        layui.use(['form','layer','upload'], function(){
            $ = layui.jquery;
            var form = layui.form(),
                layer = layui.layer;





            //监听提交
            form.on('submit(add)', function(data){
                //发异步，把数据提交给php
                $.ajax({
                    type:'POST',
                    url: '{{url('admin/carousel')}}',
                    dataType: 'json',
                    data:data.field,
                    success: function (data){
                        console.log(data);
                        if(data == 1){
                            layer.alert("增加成功", {icon: 6},function () {
                                // 获得frame索引
                                var index = parent.layer.getFrameIndex(window.name);
                                //关闭当前frame
                                parent.layer.close(index);
                            });
                        } else {
                            layer.alert("添加失败", {icon: 5},function () {
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
