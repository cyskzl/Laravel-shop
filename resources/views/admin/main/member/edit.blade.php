<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>会员信息修改</title>
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
    <form class="layui-form">
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                邮箱
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_email" name="email" required lay-verify="email"
                       autocomplete="off" value="113664000@qq.com" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                如果您在邮箱已激活的情况下，变更了邮箱，需
                <a href="/user/activate/" style="font-size: 12px; color: #4f99cf;">
                    重新验证邮箱
                </a>
                。
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                昵称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_username" name="username" required lay-verify="required"
                       autocomplete="off" value="zhibinm" class="layui-input">
            </div>
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <input type="radio" name="sex" value="0" checked title="男">
                    <input type="radio" name="sex" value="1" title="女">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_city" class="layui-form-label">
                城市
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_city" name="city" autocomplete="off" value="广州"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label for="L_sign" class="layui-form-label">
                签名
            </label>
            <div class="layui-input-block">
                        <textarea placeholder="随便写些什么刷下存在感" id="L_sign" name="sign" autocomplete="off"
                                  class="layui-textarea" style="height: 80px;"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_sign" class="layui-form-label">
            </label>
            <button class="layui-btn" key="set-mine" lay-filter="save" lay-submit>
                保存
            </button>
        </div>
    </form>
</div>
<script src="{{ asset('templates/admin/lib/layui/layui.js') }}" charset="utf-8">
</script>
<script src="{{ asset('templates/admin/js/x-layui.js') }}" charset="utf-8">
</script>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form()
            ,layer = layui.layer;

        //自定义验证规则
        // form.verify({
        //   nikename: function(value){
        //     if(value.length < 5){
        //       return '昵称至少得5个字符啊';
        //     }
        //   }
        //   ,pass: [/(.+){6,12}$/, '密码必须6到12位']
        //   ,repass: function(value){
        //       if($('#L_pass').val()!=$('#L_repass').val()){
        //           return '两次密码不一致';
        //       }
        //   }
        // });
        //监听提交
        form.on('submit(save)', function(data){
            console.log(data);
            //发异步，把数据提交给php
            layer.alert("增加成功", {icon: 6},function () {
                // 获得frame索引
                var index = parent.layer.getFrameIndex(window.name);
                //关闭当前frame
                parent.layer.close(index);
            });
            return false;
        });


    });
</script>

</body>

</html>