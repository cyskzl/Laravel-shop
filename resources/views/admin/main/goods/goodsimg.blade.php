
@section('style')
    <script src="{{asset('templates/admin/js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('org/uploadify/uploadify.css')}}">
    <script src="{{asset('org/uploads/uploadsImg.js')}}" type="text/javascript"></script>
    <style>
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
        .backclose{
            background:url({{asset('org/uploadify/uploadify-cancel.png')}});display: inline-block;height: 15px;width: 15px; position:relative;left: 95px;top:-36px;
        }
    </style>
@endsection
@section('x-body')
    <form class="layui-form layui-form-pane">
        <div class="layui-form-item" >
            <div id="queue"></div>
            <div class="layui-form-item" >
                <label class="layui-form-label" style="width: 100px">图片</label>
                <div class="layui-input-inline" style="margin-left:10px;">
                    <input type="text" name="original_img" id="img" autocomplete="off" class="layui-input">
                </div>
                <input id="file_upload"  type="file" multiple="true">

            </div>
            <div class="layui-form-item" id = 'thumbnail'>
                <label class="layui-form-label" style="width: 100px">缩略图
                </label>
                <div id='layer-photos-demo' class='layer-photos-demo' style='width: 660px;'>
                </div>
            </div>
        </div>

    </form>

@endsection
@section('js')
    <script>
    //logo 图实例
    var token ='{{csrf_token()}}';
    var uploadPath = "{{url('admin/upload/goods')}}"
    //实例化上传函数
    upload(uploadPath,token)
    //实例化删除函数
    delimg(uploadPath)
    </script>
    @endsection