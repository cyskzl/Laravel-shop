<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('templates/admin/lib/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('templates/admin/css/goodscomment/comment_replay_style.css')}}">
</head>
<body>
<div data-role="content" class="container ui-content" role="main">
    <ul class="content-reply-box mg10">
        @foreach($data as $v)
            @if($v->user_id)
                <li class="odd">
                    <a class="user ui-link" href="#"><img class="img-responsive avatar_" src="images/avatar-1.png" alt="">
                        <span class="user-name">{{$v->login_name}}</span>
                    </a>
                    <div class="reply-content-box">
                        <span class="reply-time">{{$v->created_at}}</span>
                        <div class="reply-content pr">
                            <span class="arrow">&nbsp;</span>
                            {{$v->reply_info}}
                        </div>
                    </div>
                </li>
            @endif

            @if($v->admin_id)
        <li class="even">
            <div class="reply-content-box">
                <span class="reply-time">{{$v->created_at}}</span>
                <a class="user ui-link" href="#">
                    <img class="img-responsive avatar_" src="images/avatar-1.png" alt="">
                    <span class="user-name">{{$v->nickname}}</span>
                </a>
                <div class="reply-content pr">
                    <span class="arrow">&nbsp;</span>
                    {{$v->reply_info}}
                </div>
            </div>
        </li>
                @endif
        @endforeach

    </ul>
    <ul class="form-horizontal row">
            <div class="form-group">
                <div class="col-sm-10">
                    <textarea class="form-control" rows="2" name="reply_info"></textarea>
                </div>
                <div class="col-sm-2">
                    <p></p>
                    <a class="btn btn-info" href="javascript:;" onclick="level_update(this,'{{$id}}')">回复</a>
                </div>
            </div>
    </ul>
    <script src="{{asset('templates/admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script src="{{asset('templates/admin/js/x-layui.js')}}" charset="utf-8"></script>
    <script>
        layui.use(['element','laypage','layer','form'], function(){
            $ = layui.jquery;//jquery
            lement = layui.element();//面包导航
            laypage = layui.laypage;//分页
            layer = layui.layer;//弹出层
            form = layui.form();//弹出层


        });


            function level_update(obj,id) {
                layer.confirm('确认要提交吗？', function (index) {
                    //发异步修改数据
                    var str = $('.form-control').val();

                    if(str == ''){
                        layer.msg('回复内容不可为空', {icon: 2, time: 1000});
                        return false;
                    }

                    $.ajax({
                        type: "PUT",
                        url: './' + id,
                        data: {'_token': '{{csrf_token()}}', 'reply_info': str, '_method': 'PUT'},
                        success: function (data) {

                            if (data == 0) {
                                layer.msg('修改成功!', {icon: 1, time: 1000});
                            } else if (data == 2){
                                layer.msg('回复内容不可为空', {icon: 2, time: 1000});
                            }else {
                                layer.msg('操作失败!', {icon: 2, time: 1000});

                            }

                            self.location.reload();
                        }
                    });
                })
            };




    </script>
</div>
</body>
</html>