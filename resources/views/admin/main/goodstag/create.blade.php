@extends('admin.layouts.layout')

@section('x-nav')
    <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>添加分类</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
@endsection
@section('x-body')
    <form class="layui-form layui-form-pane"  action='' style="width:100%">
        <div class="layui-form-item" style="width: 400px">
            <label class="layui-form-label" style="width: 100px">标签名称</label>
            <div class="layui-input-block">
                <input type="text" name="tag_name"  lay-verify="required" placeholder="标签名称" autocomplete="off" class="layui-input">
            </div>
        </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn"  lay-filter="add" lay-submit lay-filter="formDemo">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        {{csrf_field()}}
    </form>

@endsection
@section('js')
    {{--上传插件引入--}}
    <script>
        layui.use(['form', 'layer', 'layedit', 'upload'], function () {
            $ = layui.jquery;
            var form = layui.form()
                , layer = layui.layer;

            var $ = layui.jquery, layer = layui.layer; //独立版的layer无需执行这一句
            $('#layer-photos-demo' ).on('click', function(){
                //图片放大
                layer.photos({
                    photos: '#layer-photos-demo',
                });
            });

            form.on('submit(add)', function(data){
                console.log(data);
                //发异步，把数据提交给php
                $.ajax({
                    type: 'post',
                    url:  '/admin/goodstag',
                    dataType: 'json',
                    data: { '_token':'{{csrf_token()}}',  'json': JSON.stringify(data.field) },
                    success:function (data){
//                        console.log(data);
                        //失败
                        if(data.status == 2){
                            layer.msg(data.msg, {icon: 5,time:1000});
                        } else if(data.status == 1 ){
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
