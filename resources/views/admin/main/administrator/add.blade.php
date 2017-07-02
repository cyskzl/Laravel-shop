<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>添加管理员</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="{{ asset('templates/admin/css/x-admin.css') }}" media="all">
        <script src="{{asset('templates/admin/js/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('org/uploadify/uploadify.css')}}">
        <script src="{{asset('org/uploads/uploadsOneImg.js')}}" type="text/javascript"></script>
        <style media="screen">
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
         /*.backclose{
            background: url( {{asset('org/uploadify/uploadify-cancel.png')}} );
            display: inline-block;
            height: 15px;width: 15px; position:relative;left: 95px;top:-36px;
        }*/
        </style>
    </head>

    <body>
        <div class="x-body">
            <form class="layui-form">

                <div class="layui-form-item" >
                    <div id="queue"></div>
                    <div class="layui-form-item" >
                        <label class="layui-form-label">图片</label>
                        <div class="layui-input-inline" style="margin-left:30px;">
                            <input type="text" name="img" id="imgone" autocomplete="off" class="layui-input">
                        </div>
                        <input id="file_oneupload"  type="file" multiple="true">

                    </div>
                    <div class="layui-form-item" id = 'thumbnail'>
                        <label class="layui-form-label">缩略图
                        </label>
                        <div id='uploadone' class='uploadone' style='width: 660px;'>
                        </div>
                    </div>
                </div>


                <div class="layui-form-item" >
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>用户名
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="username" name="nickname" required="" lay-verify="required"
                        autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>将会成为您唯一的登入名
                    </div>
                </div>
                <!-- <div class="layui-form-item">
                    <label for="phone" class="layui-form-label">
                        <span class="x-red">*</span>手机
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="phone" name="tel" required="" lay-verify="phone"
                        autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>将会成为您唯一的登入名
                    </div>
                </div> -->
                <div class="layui-form-item">
                    <label for="L_email" class="layui-form-label">
                        <span class="x-red">*</span>邮箱
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_email" name="email" required="" lay-verify="email"
                        autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">角色</label>
                    <div class="layui-input-block">
                        @foreach($roles as $role)
                      <input type="checkbox" name="roles[]" title="{{ $role->display_name }}" value="{{ $role->id }}">
                      @endforeach
                    </div>
                  </div>
                <div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">
                        <span class="x-red">*</span>密码
                    </label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_pass" name="password" required="" lay-verify="pass"
                        autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        6到16个字符
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                        <span class="x-red">*</span>确认密码
                    </label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_repass" name="repass" required="" lay-verify="repass"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">状态</label>
                    <div class="layui-input-block">
                        <input type="radio" name="status" value="1" title="启用" checked>
                        <input type="radio" name="status" value="0" title="禁用">
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
        </div>
        <script src="{{ asset('templates/admin/lib/layui/layui.js') }}" charset="utf-8">
        </script>
        <script src="{{ asset('templates/admin/js/x-layui.js') }}" charset="utf-8">
        </script>
        <script>

            var token = '{{ csrf_token() }}';
            layui.use(['form','layer'], function(){
                $ = layui.jquery;
              var form = layui.form()
              ,layer = layui.layer;

              //自定义验证规则
              form.verify({
                nikename: function(value){
                  if(value.length < 5){
                    return '昵称至少得5个字符啊';
                  }
                }
                ,pass: [/(.+){6,12}$/, '密码必须6到12位']
                ,repass: function(value){
                    if($('#L_pass').val()!=$('#L_repass').val()){
                        return '两次密码不一致';
                    }
                }
              });

              //监听提交
              form.on('submit(add)', function(data){
                // console.log(data);
                var arr = new Array();
                var a = $("input[name='roles[]']:checked")
                for (var i=0; i<a.length; i++) {
                    arr.push(a[i].value);
                }
                //发异步，把数据提交给php
                $.ajax({
                  url:'{{ url('admin/adminlist/') }}',
                  type:'post',
                  datatype:'json',
                  data:{
                    'json':JSON.stringify(data.field),
                    'roles':JSON.stringify(arr),
                     '_token':token,
                   },
                  success:function (res){
                      res = JSON.parse(res);
                      console.log(res.success);
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


            var token1 = token;
            var uploadPath = "{{url('admin/upload/admin')}}"
              //实例化上传函数
            oneUpload(uploadPath,token1)
              //实例化删除函数
            delOneImg(uploadPath)
        </script>
    </body>

</html>
