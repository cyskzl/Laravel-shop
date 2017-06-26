/**
 * 引入文件
 * <script src="{{asset('templates/admin/js/jquery.min.js')}}" type="text/javascript"></script>
 * <script src="{{asset('org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
 * <link rel="stylesheet" type="text/css" href="{{asset('org/uploadify/uploadify.css')}}">
 * <script src="{{asset('org/uploads/uploadsImg.js')}}" type="text/javascript"></script>
 * @param uploadPath
 * @param token
 *  调用方法：
 *   category 是文件夹名称，自定义
 *  var token ='{{csrf_token()}}';
 *  var uploadPath = "{{url('admin/upload/category')}}"
 *  实例化上传函数
 *  upload(uploadPath,token)
 *  实例化删除函数
 *  delimg(uploadPath)
 *
 *  html代码
 *  .uploadify{ display: inline-block;}
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
         <div class="layui-form-item" >
         <div id="queue"></div>
         <div class="layui-form-item" >
         <label class="layui-form-label">图片</label>
         <div class="layui-input-inline" style="margin-left:30px;">
         <input type="text" name="img" id="img" autocomplete="off" class="layui-input">
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
 */
// $(function() {
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
// });


/**
 *
 * @param delUrl   传上传文件的路径
 * 注：一定要与上传文件路由同名
 */
function delimg(delUrl){
    $( '#layer-photos-demo' ).on( 'click','#delimg', function(){
        var that = $(this);
        var src = that.next().attr('src');
        $.ajax({
            type      :   'get',
            //url      :   '/admin/upload/category',
            url      :   delUrl,
            dataType :   'json',
            data     :   { 'data' : src },
            success  :   function (data) {
                var fileattr = $('#file_upload').data('uploadify');//获取上传文件的属性
                //获取自己设置的上传文件大小
                console.log(fileattr.settings);
                var uploadLimit=fileattr.settings.uploadLimit;
                //重置增加上传文件数,队列-1
                $('#file_upload').uploadify('settings','uploadLimit', ++uploadLimit);

                //获取状态值
                if(data.status == 0){
                    //获取php返回路径
                    if(data.path == src){
                        //图片路径
                        var str = that.next().attr('src')+',';
                        //input框的路径
                        var val = $('#img').attr('value');
                        //替换为空白
                        var rep =val.replace(str,'');
                        //加到input中
                        $('#img').attr('value', rep);
                        //删除X 图片
                        that.next().remove();
                        //删除缩略图
                        that.remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                    }
                } else {
                    layer.msg('删除失败啦！检查有图片', {icon: 5,time:1000});
                }
            }
        });
    });
}