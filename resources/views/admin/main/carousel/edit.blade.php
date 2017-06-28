@extends('admin.layouts.layout')

@section('title','修改轮播图')

@section('x-body')
    <form class="layui-form">
        <div class="layui-form-item">
            <label for="link" class="layui-form-label">
                <span class="x-red">*</span>轮播图
            </label>
            <div class="layui-input-inline">
                <div class="site-demo-upbar">
                    <input type="file" name="file" class="layui-upload-file" id="test">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label  class="layui-form-label">缩略图
            </label>
            <img id="LAY_demo_upload" width="400" src="{{asset('templates/admin/images/banner.png')}}">
        </div>
        <div class="layui-form-item">
            <label  class="layui-form-label">
            </label>
            （由于服务器资源有限，所以此处每次给你返回的是同一张图片)
        </div>

        <div class="layui-form-item">
            <label for="link" class="layui-form-label">
                <span class="x-red">*</span>链接
            </label>
            <div class="layui-input-inline">
                <input type="text" id="link" name="link" required="" lay-verify="required" value="http://www.xuebingsi.com"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="desc" class="layui-form-label">
                <span class="x-red">*</span>描述
            </label>
            <div class="layui-input-inline">
                <input type="text" id="desc" name="desc" required="" lay-verify="required" value="十月活动轮播"
                       autocomplete="off" class="layui-input">
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
        layui.use(['form','layer','upload'], function(){
            $ = layui.jquery;
            var form = layui.form()
                ,layer = layui.layer;


            //图片上传接口
            layui.upload({
                url: './upload.json' //上传接口
                ,success: function(res){ //上传成功后的回调
                    console.log(res.code);
                    $('#LAY_demo_upload').attr('src',res.url);
                }
            });


            //监听提交
            form.on('submit(add)', function(data){
                console.log(data);
                //发异步，把数据提交给php
                layer.alert("修改成功", {icon: 6},function () {
                    // 获得frame索引
                    var index = parent.layer.getFrameIndex(window.name);
                    //关闭当前frame
                    parent.layer.close(index);
                });
                return false;
            });


        });
    </script>
@endsection