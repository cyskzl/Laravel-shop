@extends('admin.layouts.layout')
@section('x-body')

    <form class="layui-form">
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                邮箱
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_email" name="email" required lay-verify="email"
                       autocomplete="off" value="{{$userinfo->email}}" class="layui-input">
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
                       autocomplete="off" value="{{$userinfo->nickname or '无'}}" class="layui-input">
            </div>
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <input type="radio" name="sex" value="1" {{$userinfo->sex==1?'checked':''}} title="男">
                    <input type="radio" name="sex" value="2" {{$userinfo->sex==2?'checked':''}} title="女">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_tel" class="layui-form-label">
                手机号码
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_tel" name="tel" autocomplete="off" value="{{$userinfo->tel or '无'}}"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_avatar" class="layui-form-label">
                头像
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_avtar" name="avatar" autocomplete="off" value="{{$userinfo->avatar or '无'}}"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">生日</label>
            <div class="layui-input-inline">
                <input type="date" class="layui-input" placeholder="生日" name="birthday" id="LAY_demorange_s" >
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
@endsection
@section('js')
<script>
    layui.use(['form','layer','laydate'], function(){
        $ = layui.jquery;
        laydate = layui.laydate;//日期插件
        var form = layui.form()
            ,layer = layui.layer;

        var data;

        var start = {
            min: '0000-00-00 00:00:00',
            max: laydate.now(),
            istoday: false,
            choose: function (datas){
                data = datas;


            }
        };



        document.getElementById('LAY_demorange_s').onclick = function () {
            start.elem = this;
            laydate(start);
//            console.log(start.choose);
        }

        form.on('submit(save)', function(data){
            console.log(data.field.birthday);
            //发异步，把数据提交给php
            $.ajax({
                type: "POST",
                url: "admin/member/",
                data: { '_token':'{{csrf_token()}}', '_method': 'PUT', 'email': data.field.email,'tel':'data.field.tel','nickname':'data.field.nickname','sex':'data.field.sex','avatar':'data.field.avatar' },
                dataType:'json',
                success: function(data) {
                    console.log(data);
                }
            });

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
@endsection