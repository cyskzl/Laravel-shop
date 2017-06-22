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
        <form class="layui-form layui-form-pane">
            {{csrf_field()}}
            <div class="layui-form-item">
                <label for="L_name" class="layui-form-label">
                    名称
                </label>
                <div class="layui-input-block">
                    <input type="text" id="L_name" name="name" required lay-verify="name"
                           autocomplete="off" class="layui-input">
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
                            <option value="3">团购</option>
                            <option value="4">超值</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_start" class="layui-form-label">
                    开始时间
                </label>
                <div class="layui-input-block">
                    <input type="date" id="L_start" name="start_time" required lay-verify="start_time"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_start" class="layui-form-label">
                    结束时间
                </label>
                <div class="layui-input-block">
                    <input type="date" id="L_end" name="end_time" required lay-verify="end_time"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item" >
                <div id="queue"></div>
                <div class="layui-form-item" >
                    <label class="layui-form-label">图片</label>
                    <div class="layui-input-inline" style="margin-left:30px;">
                        <input type="text" name="img" id="img" autocomplete="off" class="layui-input">
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
                    <script id="container" name="content" type="text/plain"></script>
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
        function upload(uploadPath,token ){
            $('#file_upload').uploadify({
                'uploadLimit': 5,                               //上传文件设置
                'fileSizeLimit': '20000KB',                     //上传大小
                'fileTypeDesc': 'Image Files',                  //上传文件备注
                'multi': true,                                  //开启多文件
                'preventCaching': true,                         //不允许缓存
                'fileTypeExts': '*.jpeg; *.jpg; *.png; *.gif',  //文件格式
                'buttonText': '图片上传',                       //按钮名
                'formData': {                                   //请求token值
                    '_token': token
                },
                'swf': "/org/uploadify/uploadify.swf",
                //请求路径
                'uploader': uploadPath, //上传处理路由
                //成功返回回调函数
                'onUploadSuccess': function (file, data, response) {
                    console.log(data);
                    //判断php，return回来的值
                    if (data) {
                        //添加到缩略图
                        var str = "";
                        str += "<a id='delimg' href='javascript:;' class='backclose'></a>";
                        str += "<img id='photos'class='photos'  src='" + data + "' layer-src='" + data + "' style='height: 100px;width: 100px;padding-left: 1px'>";
                        //将目录的路径加到img中
                        $("#layer-photos-demo").append($(str));
                        //查找动态生成的img标签
                        var imgsrc = $('#layer-photos-demo').find('img');
                        //生成第一张图片时候，走判断
                        if (imgsrc.attr('src') !== null) {
                            //定义一个空数组
                            var array = new Array();
                            //找出所有的src的地址
                            for (var i = 0; i < imgsrc.length; i++) {
                                //压入数组，并以最后一个为，分隔
                                array.push($(imgsrc[i]).attr('src') + ',');
                                //计算数据有多少条，并拼接
                                // for (var j = 0; j < array.length; j++) {
                                //判断长度，最多5张
                                switch (array.length) {
                                    case 1:
                                        $('#img').attr('value', array[0]);
                                        break;
                                    case 2:
                                        $('#img').attr('value', array[0] + array[1]);
                                        break;
                                    case 3:
                                        $('#img').attr('value', array[0] + array[1] + array[2]);
                                        break;
                                    case 4:
                                        $('#img').attr('value', array[0] + array[1] + array[2] + array[3]);
                                        break;
                                    case 5:
                                        $('#img').attr('value', array[0] + array[1] + array[2] + array[3] + array[4]);
                                        break;
                                    default:
                                        $('#img').attr('value','');
                                        break;
                                }
                                // }
                            }
                        }
                    }
                }
            });
        }
        layui.use(['form', 'layer', 'layedit'], function () {
            $ = layui.jquery;
            var form = layui.form()
                , layer = layui.layer
                , layedit = layui.layedit;


            layedit.set({
                uploadImage: {
                    url: "./upimg.json" //接口url
                    , type: 'post' //默认post
                }
            })

            //创建一个编辑器
            editIndex = layedit.build('L_content');


            //监听提交
            form.on('submit(add)', function (data) {
                console.log(data);
                //发异步，把数据提交给php
                layer.alert("增加成功", {icon: 6}, function () {
                    // 获得frame索引
                    var index = parent.layer.getFrameIndex(window.name);
                    //关闭当前frame
                    parent.layer.close(index);
                });
                return false;
            });


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