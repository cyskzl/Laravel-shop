@extends('admin.layouts.layout')
@section('style')
    <script src="{{asset('templates/admin/js/jquery.min.js')}}" type="text/javascript"></script>

@endsection
@section('x-nav')
    <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>添加快递</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
@endsection
@section('x-body')
    <form class="layui-form"  action=''>

        <div class="layui-inline">
            <label class="layui-form-label">名称</label>
            <div class="layui-input-block">
                <input type="text" name="name"  lay-verify="required" placeholder="快递名称" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">邮费</label>
            <div class="layui-input-block">
                <input type="text" name="price"  lay-verify="required" placeholder="快递邮费" autocomplete="off" class="layui-input">
            </div>
        </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">描述</label>
                <div class="layui-input-block">
                    <textarea name="desc" placeholder="请输入描述" class="layui-textarea" style="
resize: none;"></textarea>
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

                var price = $('input[name=price]').val();

                var per = /^\d{1,}$/;

                var bool = per.test(price);

                if (!bool){
                    layer.msg('邮费只可以是数字', {icon: 2,time:1000});
                    return false;
                }

                $.ajax({
                    type: 'post',
                    url:  '/admin/deliverymethod',
                    dataType: 'json',
                    data: { '_token':'{{csrf_token()}}',  'json': JSON.stringify(data.field) },
                    success:function (data){
//                        console.log(data);
                        //失败
                        if(data.status == 1){
                            layer.msg(data.msg, {icon: 5,time:1000});
                        } else if(data.status == 3){
                            layer.msg(data.msg, {icon: 5,time:1000});
                        } else if(data.status == 4 ){
                            layer.msg(data.msg, {icon: 5,time:1000});
                        } else if(data.status == 0 ){
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
