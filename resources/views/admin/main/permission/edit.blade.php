<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>权限规则修改</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="{{ asset('templates/admin/css/x-admin.css') }}" media="all">
    </head>

    <body>
        <div class="x-body">
            <form class="layui-form" action="">
                <input type="hidden" name="id" value="{{ $permission->id }}">

                <div class="layui-form-item">
                    <label class="layui-form-label">权限名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" required  lay-verify="required" placeholder="请输入权限名称" autocomplete="off" class="layui-input" value="{{ $permission->name }}">
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">权限描述</label>
                    <div class="layui-input-inline">
                        <textarea name="description" placeholder="请输入内容" class="layui-textarea">{{ $permission->description }}</textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="save">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </div>
        <script src="{{ asset('templates/admin/lib/layui/layui.js') }}" charset="utf-8"></script>
        <script src="{{ asset('templates/admin/js/x-layui.js') }}" charset="utf-8"></script>
        <script>
            layui.use(['form','layer'], function(){
                $ = layui.jquery;
              var form = layui.form()
              ,layer = layui.layer;


              //监听提交
              form.on('submit(save)', function(data){

                // 发异步，把数据提交给php
                $.ajax({
                    url:'{{ url('admin/permission') }}' + '/' + data.field.id,
                    type:'put',
                    datatype:'json',
                    data:{
                        '_token':"{{ csrf_token() }}",
                        'json':JSON.stringify(data.field)
                    },
                    success:function (data) {
                        res = JSON.parse(data);
                        if (res.success == '1') {
                            layer.alert(res.info, {icon: 6},function () {
                                // 获得frame索引
                                var index = parent.layer.getFrameIndex(window.name);
                                //关闭当前frame
                                parent.layer.close(index);
                            });
                        } else {

                            layer.alert(res.info, {icon: 5},function () {
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
        <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
          var s = document.getElementsByTagName("script")[0];
          s.parentNode.insertBefore(hm, s);
        })();
        </script>
    </body>

</html>
