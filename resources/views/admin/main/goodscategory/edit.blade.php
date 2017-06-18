@extends('admin.layouts.layout')
@yield('title','修改分类')
@section('x-body')
    <form class="layui-form">
        <div class="layui-form-item">
            <label for="cname" class="layui-form-label">
                ID
            </label>
            <div class="layui-input-inline">
                <input type="text" id="cname" name="cname" required="" lay-verify="required"
                       autocomplete="off"  value="1" disabled="" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="cname" class="layui-form-label">
                <span class="x-red">*</span>分类名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="cname" name="cname" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">所属分类</label>
            <div class="layui-input-inline" >
                <select name="fid">
                    <option value="0">顶级分类</option>
                    <option value="新闻">新闻</option>
                    <option value="新闻子类1">--新闻子类1</option>
                    <option value="新闻子类2">--新闻子类2</option>
                    <option value="产品">产品</option>
                    <option value="产品子类1">--产品子类1</option>
                    <option value="产品子类2">--产品子类2</option>
                </select>
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
            layer.alert("保存成功", {icon: 6},function () {
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