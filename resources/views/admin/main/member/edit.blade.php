@extends('admin.layouts.layout')

@section('title','会员修改')
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
@section('x-body')
    <form class="layui-form">
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                昵称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_username" name="nickname" required lay-verify="required"
                       autocomplete="off" value="{{$userinfo->nickname}}" class="layui-input">
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
                真实姓名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_tel" name="realname" autocomplete="off" value="{{$userinfo->tel}}"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_tel" class="layui-form-label">
                身份证号
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_tel" name="id_number" autocomplete="off" value="{{$userinfo->tel}}"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item" >
            <div id="queue"></div>
            <div class="layui-form-item" >
                <label class="layui-form-label">头像</label>
                <div class="layui-input-inline" style="margin-left:30px;">
                    <input type="text" name="avatar" id="img" autocomplete="off" class="layui-input" value="{{$userinfo->avatar}}" >
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
//            console.log(data.field.birthday);
            //发异步，把数据提交给php
            $.ajax({
                type: "PUT",
                url: "./",
                data: { '_token':'{{csrf_token()}}', '_method': 'PUT', 'nickname': data.field.nickname,'realname':data.field.realname,'id_number':data.field.id_number,'sex':data.field.sex,'avatar':data.field.avatar,'birthday':data.field.birthday },
                dataType:'json',
                success: function(data) {
                    console.log(data);
                    if(data.status == 0){
                        layer.alert(data.msg, {icon: 6},function () {
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前frame
                            parent.layer.close(index);
                        });
                    }else{
                        layer.alert(data.msg, {icon: 5});
                        parent.layer.close(index);
                    }
                }
            });

            return false;
        });
    });
</script>
<script>
    var token ='{{csrf_token()}}';
    var uploadPath = "{{url('admin/upload/avatar')}}";
    //实例化上传函数
    upload(uploadPath,token);
    //实例化删除函数
    delimg(uploadPath);
</script>
@endsection