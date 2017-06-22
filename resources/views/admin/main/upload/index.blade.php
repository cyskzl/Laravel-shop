<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="{{asset('templates/admin/js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('org/uploadify/jquery.uploadify.js')}}" type="text/javascript"></script>
    <script src="{{asset('org/uploadify/uploadify-move.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('org/uploadify/upload.css')}}">
    <title>Uploadify</title>
</head>
<body>
<div class="W">
    <div class="Bg"></div>
    <div class="Wrap" id="Wrap" style="top: 98px; left: 186px; display: block;">
        <div class="Title">
            <h3 class="MainTit" id="MainTit"></h3>
            <a href="javascript:Close();" title="关闭" class="Close"></a>
        </div>
        <div class="Cont">
            <p class="Note">最多上传<strong>1</strong>个附件,单文件最大<strong>4M</strong>,类型<strong>jpg,png,gif,jpeg</strong></p>
            <div class="flashWrap">
                <!-- <span><input type="checkbox" name="iswatermark" id="iswatermark" /><label>是否添加水印</label></span>-->
            </div>
            <div class="fileWarp">
                <fieldset>
                    <legend>列表</legend>
                    <ul>
                    </ul>
                    <div id="fileQueue">
                    </div>
                </fieldset>
            </div>
            <div class="btnBox">
                <button class="btn" id="SaveBtn" disabled="disabled">保存</button>
                &nbsp;
                <button class="btn" id="CancelBtn">取消</button>
            </div>
        </div>
        <!--[if IE 6]>
        <iframe frameborder="0" style="width:100%;height:100px;background-color:transparent;position:absolute;top:0;left:0;z-index:-1;"></iframe>
        <![endif]-->
    </div>
</div>


<!--防止客户端缓存文件，造成uploadify.js不更新，而引起的“喔唷，崩溃啦”-->

<script type="text/javascript">
    function Close(){
        $("iframe.uploadframe", window.parent.document).remove();
    }

    $("#CancelBtn").click(function(){
        $("iframe.uploadframe", window.parent.document).remove();
        //$('#uploadify').uploadifyClearQueue();
        //$(".fileWarp ul li").remove();
    });

    $(function() {
        $('#uploadify').uploadify({
            'auto'			  : true,
            'method'   		  : 'post',
            'multi'   		  : true,
            'swf'      		  : '/public/plugins/uploadify/uploadify.swf',
            'uploader'        : "/index.php/Admin/Ueditor/imageUp/savepath/category/pictitle/banner/dir/images.html",
            'progressData'    : 'all',
            'queueSizeLimit'  : 1,
            'uploadLimit'     : 5,
            'fileSizeLimit'   : '20000KB',
            'fileTypeDesc' 	  : 'Image Files',
            'fileTypeExts'    : '*.jpeg; *.jpg; *.png; *.gif',
            'buttonImage'     : '/public/plugins/uploadify/select.png',
            'queueID'         : 'fileQueue',
            'onUploadStart'   : function(file){
                $('#uploadify').uploadify('settings', 'formData', {'iswatermark':$("#iswatermark").is(':checked')});
            },
            'onUploadSuccess' : function(file, data, response){
                $("#SaveBtn").attr("disabled",false);
                $(".fileWarp ul").append(SetImgContent(data));
                SetUploadFile();
            }
        });
    });

    function SetImgContent(data){
        var obj=eval('('+data+')');
        if(obj.state == 'SUCCESS'){
            var sLi = "";
            sLi += '<li class="img">';
            sLi += '<img src="' + obj.url + '" width="100" height="100" onerror="this.src=\'/public/plugins/uploadify/nopic.png\'">';
            sLi += '<input type="hidden" name="fileurl_tmp[]" value="' + obj.url + '">';
            sLi += '<a href="javascript:void(0);">删除</a>';
            sLi += '</li>';
            return sLi;
        }else{
            //window.parent.message(obj.text,8,2);
            layer.alert(obj.text, {icon: 2});
            return;
        }
    }



    function SetUploadFile(){
        $("ul li").each(function(l_i){
            $(this).attr("id", "li_" + l_i);
        })
        $("ul li a").each(function(a_i){
            $(this).attr("rel", "li_" + a_i);
        }).click(function(){
            $.get(
                '/index.php/Admin/Uploadify/delupload.html',{action:"del", filename:$(this).prev().val()},function(){}
            );
            $("#" + this.rel).remove();
        })
    }

    /*点击保存按钮时
     *判断允许上传数，检测是单一文件上传还是组文件上传
     *如果是单一文件，上传结束后将地址存入$input元素
     *如果是组文件上传，则创建input样式，添加到$input后面
     *隐藏父框架，清空列队，移除已上传文件样式*/
    $("#SaveBtn").click(function(){
        var callback = "img_call_back";
        var num = 1;
        var fileurl_tmp = [];
        if(callback != "undefined"){
            if(num > 1){
                $("input[name^='fileurl_tmp']").each(function(index,dom){
                    fileurl_tmp[index] = dom.value;
                });
            }else{
                fileurl_tmp = $("input[name^='fileurl_tmp']").val();
            }
            eval('window.parent.'+callback+'(fileurl_tmp)');
            $(window.parent.document).find("iframe.uploadframe").remove();
            return;
        }
        if(num > 1){
            var fileurl_tmp = "";
            $("input[name^='fileurl_tmp']").each(function(){
                fileurl_tmp += '<li rel="'+ this.value +'"><input class="input-text" type="text" name="[]" value="'+ this.value +'" /><a href="javascript:void(0);" onclick="ClearPicArr(\''+ this.value +'\',\'\')">删除</a></li>';
            });
            $(window.parent.document).find("#").append(fileurl_tmp);
        }else{
            $(window.parent.document).find("#").val($("input[name^='fileurl_tmp']").val());
        }

        $(window.parent.document).find("iframe.uploadframe").remove();
    });
</script>

</body></html>