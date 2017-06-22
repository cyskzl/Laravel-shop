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
    <script src="{{asset('templates/admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script src="{{asset('templates/admin/js/x-layui.js')}}" charset="utf-8"></script>
</head>
<body>
<div data-role="content" class="container ui-content" role="main">
    <ul class="content-reply-box mg10">
        <li class="odd">
            <a class="user ui-link" href="#"><img class="img-responsive avatar_" src="images/avatar-1.png" alt=""><span class="user-name">奔波儿灞</span></a>
            <div class="reply-content-box">
                <span class="reply-time">03-08 15：00</span>
                <div class="reply-content pr">
                    <span class="arrow">&nbsp;</span>
                    为什么小鑫的名字里有三个金呢？
                </div>
            </div>
        </li>
        <li class="even">
            <a class="user ui-link" href="#">
                <img class="img-responsive avatar_" src="images/avatar-1.png" alt="">
                <span class="user-name">灞波儿奔</span>
            </a>
            <div class="reply-content-box">
                <span class="reply-time">03-08 15：10</span>
                <div class="reply-content pr">
                    <span class="arrow">&nbsp;</span>
                    他命里缺金，所以取名叫鑫，有些人命里缺水，就取名叫淼，还有些人命里缺木就叫森。
                </div>
            </div>
        </li>
        <li class="odd">
            <a class="user ui-link" href="#">
                <img class="img-responsive avatar_" src="images/avatar-1.png" alt="">
                <span class="user-name">奔波儿灞</span>
            </a>
            <div class="reply-content-box">
                <span class="reply-time">03-08 15：20</span>
                <div class="reply-content pr">
                    <span class="arrow">&nbsp;</span>
                    那郭晶晶命里缺什么？
                </div>
            </div>
        </li>
        <li class="even">
            <a class="user ui-link" href="#">
                <img class="img-responsive avatar_" src="images/avatar-1.png" alt="">
                <span class="user-name">灞波儿奔</span>
            </a>
            <div class="reply-content-box">
                <span class="reply-time">03-08 15：30</span>
                <div class="reply-content pr">
                    <span class="arrow">&nbsp;</span>
                    此处省略一百字...
                </div>
            </div>
        </li>
    </ul>
    <ul class="form-horizontal row">
        <div class="form-group">
            <div class="col-sm-10">
                <textarea class="form-control" rows="2"></textarea>
            </div>
            <div class="col-sm-2">
                <p></p>
                <button type="button" class="btn btn-info">回复</button>
            </div>
        </div>



    </ul>
</div>
</body>
</html>