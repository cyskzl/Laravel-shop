<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>添加角色</title>
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
    <form action="/admin/adminrole" method="post" class="layui-form layui-form-pane">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="layui-form-item">
            <label for="name" class="layui-form-label">
                <span class="x-red">*</span>角色名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="name" name="name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label for="name" class="layui-form-label">
                <span class="x-red">*</span>角色标识
            </label>
            <div class="layui-input-inline">
                <input type="text" id="name" name="display_name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label for="desc" class="layui-form-label">
                描述
            </label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" id="desc" name="description" class="layui-textarea"></textarea>
            </div>
        </div>

        <!-- <div class="layui-form-item">
            <label for="name" class="layui-form-label">
                <span class="x-red">*</span>角色标识
            </label>
            <div class="layui-input-inline">
                <input type="text" id="name" name="name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div> -->
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">
                拥有权限
            </label>
            <table  class="layui-table layui-input-block">
                <tbody>
                <tr>
                    <td>
                        @if( count($permission) > 0 )

                            <div class="layui-input-block">
                                @foreach($permission as $perms)
                                    <input name="perms[]" type="checkbox" value="{{ $perms->id }}" title="{{ $perms->description }}">
                                    @endforeach
                            </div>

                        @else
                            暂无权限列表
                        @endif
                    </td>
                </tr>

                </tbody>
            </table>
        </div>

        <div class="layui-form-item">
            <button class="layui-btn" lay-submit="" lay-filter="add">增加</button>
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
        form.on('submit(add)', function(data){
            //表单数据转换
            var arr = new Array();
            var a = $("input[name='perms[]']:checked")
            for (var i=0; i<a.length; i++) {
                arr.push(a[i].value);
            }

            //发异步，把数据提交给php
            $.ajax({
                url: '/admin/adminrole',
                type: 'POST',
                dataType: 'json',
                data: {'_token':data.field._token,'json':JSON.stringify(data.field),'perms':JSON.stringify(arr)},
                traditional: true,
                success:function (data){
                    if (data == '1') {
                        layer.alert("增加成功", {icon: 1},function () {
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前frame
                            parent.layer.close(index);

                        });
                    } else {
                        layer.alert("添加失败", {icon: 2},function () {
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

</body>

</html>
