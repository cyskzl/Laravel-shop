@extends('admin.layouts.layout')
@section('title','添加活动')
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
@section('x-nav')
    <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>添加活动</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
@endsection
@section('x-body')
    <div class="x-body">
        <form class="layui-form layui-form-pane" action="{{url('admin/activity')}}" method="post">
            {{csrf_field()}}
            @if(session('fail'))
                <div class="alert alert-fail" style="color:red;">
                    {{session('fail')}}
                </div>
            @endif
            <div class="layui-form-item">
                <label for="L_name" class="layui-form-label">
                    名称
                </label>
                <div class="layui-input-block">
                    <input type="text" id="L_name" name="name" required lay-verify="name"
                           autocomplete="off" class="layui-input" value="{{old('name')}}">
                    <span style="color:mediumvioletred;">
                        {{ $errors->first('name') }}
                    </span>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">
                        类别
                    </label>
                    <div class="layui-input-block">
                        <select lay-verify="required" name="type">
                            <option>
                            <option value="1">促销</option>
                            <option value="2">折扣</option>
                        </select>
                        <span style="color:mediumvioletred;">
                            {{ $errors->first('type') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">

                    </label>
                    <div class="layui-input-block">
                        
                        <span style="color:mediumvioletred;">
                            {{ $errors->first('type') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_start" class="layui-form-label" style="width:100px">
                    开始时间
                </label>
                <div class="layui-input-block" id="end_time">
                    <input type="date" id="L_start" name="start_time" required lay-verify="start_time"  autocomplete="off" class="layui-input" style="width:20%;"  value="{{old('start_time')}}"><span></span>
                    <span style="color:mediumvioletred;">
                        {{ $errors->first('start_time') }}
                    </span>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_start" class="layui-form-label" style="width:100px">
                    结束时间
                </label>
                <div class="layui-input-block">
                    <input type="date" id="L_end" name="end_time" required lay-verify="end_time" autocomplete="off" class="layui-input" style="width:20%;"  value="{{old('end_time')}}"><span></span>
                    <span style="color:mediumvioletred;">
                        {{ $errors->first('end_time') }}
                    </span>
                </div>
            </div>
            <div class="layui-form-item" >
                <div id="queue"></div>
                <div class="layui-form-item" >
                    <label class="layui-form-label" style="width:100px">图片</label>
                    <div class="layui-input-inline" style="margin-left:30px;">
                        <input type="text" name="img" id="img" autocomplete="off" class="layui-input" lay-verify="required">
                    </div>
                    <input id="file_upload"  type="file" multiple="true">

                </div>
                </div>
                <div class="layui-form-item" id = 'thumbnail'>
                    <label class="layui-form-label">缩略图
                    </label>
                    <div id='layer-photos-demo' class='layer-photos-demo' style='width: 660px;'>
                    </div>
                </div>

            <div class="layui-form-item layui-form-text">
                <div class="layui-input-block">
                    <!-- 加载编辑器的容器 -->
                    <script id="container" name="desc" lay-verify="required"  value="{{old('desc')}}" type="text/plain"></script>
                    <!-- 配置文件 -->
                    <script type="text/javascript" src="{{asset('templates/admin/ueditor/ueditor.config.js')}}"></script>
                    <!-- 编辑器源码文件 -->
                    <script type="text/javascript" src="{{asset('templates/admin/ueditor/ueditor.all.js')}}"></script>
                    <!-- 实例化编辑器 -->
                    <script type="text/javascript">
                        var ue = UE.getEditor('container');
                    </script>
                </div>
                <label for="L_content" class="layui-form-label" style="top: -2px;">
                    描述
                </label>
                <span style="color:mediumvioletred;">
                        {{ $errors->first('desc') }}
                    </span>
            </div>

            <div class="layui-form-item">
                <button class="layui-btn" lay-filter="add" lay-submit>
                    立即发布
                </button>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script>

        layui.use(['form', 'layer', 'laydate','layedit'], function () {
            $ = layui.jquery;
            var form = layui.form()
                , layer = layui.layer
                , layedit = layui.layedit;

                //自定义验证规则
                form.verify({
                    name: function(value){
                        if(value.length < 3){
                            return '活动至少得3个字符啊';
                        }
                    },
                    type: function(value){
                        if(value.length == 0){
                            return '请选择活动类型';
                        }
                    }
                });

            // 判断活动开始时间
            var nowtime = laydate.now('Y-m-d H:i:s');
            $('#L_start').on('change',function (){
                if($(this).val()<nowtime){
                    layer.msg('活动时间不能低于目前时间',{icon:5});
                }
            });
            // 判断活动结束时间是否大于开始时间
            $('#L_end').on('change',function (){
                var start_time = $(this).parent().parent().prev().children('#end_time').children('#L_start').val();
//                console.log(start_time);
                if($(this).val()<start_time){
                    layer.msg('结束时间不能低于开始时间',{icon:5});
                }
            });


            layedit.set({
                uploadImage: {
                    url: "./upimg.json" //接口url
                    , type: 'post' //默认post
                }
            })

            //创建一个编辑器
            editIndex = layedit.build('L_content');


        });
    </script>
    <script>
        var token ='{{csrf_token()}}';
        var uploadPath = "{{url('admin/upload/activity')}}";
        //实例化上传函数
        upload(uploadPath,token);
        //实例化删除函数
        delimg(uploadPath);
    </script>
@endsection