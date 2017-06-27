<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('/templates/home/css/public.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/home/css/header.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/home/css/footer.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/home/css/registe.css')}}">
    {{--<script src="{{asset('/templates/home/js/registe.js')}}"></script>--}}
    <script src="{{asset('/templates/home/js/jquery-2.0.0.min.js')}}"></script>
    @yield('style')
</head>
<body>
<!-- 头部 -->
<div class="header">
    <!-- 顶部 -->
    <div class="header_top left">
        <ul class="header_top_left left">
            <li><a href="registe.html">注册</a></li>
            <li><a href="login.html">登录</a></li>
            <li class="header_top_left_li">下载APP
                <a href="javascript:">
                    <img class="header_top_left_code" src="{{asset('/templates/home/uploads/down_app.png')}}" alt="">
                </a>
            </li>
        </ul>
        <ul class="header_top_right right">
            <li>我的订单</li>
            <li>收藏</li>
            <li>消息</li>
            <li class="header_top_right_li">个人中心&nbsp;
                <span>
                        <img src="{{asset('/templates/home/uploads/pCenter_qian.png')}}" alt="">
                    </span>
                <div class="header_top_right_div">
                    <a href="javascript:">购物车</a>
                    <a href="javascript:">收藏夹</a>
                    <a href="javascript:">W积分</a>
                    <a href="javascript:">优惠券</a>
                </div>
            </li>
            <li>客户服务</li>
            <li class="header_top_left_li_two">关注我们
                <a href="javascript:">
                    <img class="header_top_left_code_two" src="{{asset('/templates/home/uploads/down_app.png')}}" alt="">
                </a>
            </li>

        </ul>
    </div>
    <!-- 搜索区 -->
    <div class="header_top_bottom">
        <div class="header_logo">
            <img src="{{asset('/templates/home/uploads/logo (1).png')}}" alt="">
        </div>
    </div>
</div>

<!--主体内容-->

<main>
    @yield('main')
</main>
<!-- 错误弹窗 -->
<div class="alert" id="alert">
    @yield('alert')
</div>
    @yield('js')
<!-- 尾部 -->
<div class="footer">
    <div class="footer_top">
        <a href="javascript:">
            <img src="{{asset('/templates/home/uploads/memberLevel.png')}}" alt="">
            <span>会员等级</span>
        </a>
        <a href="javascript:"><img src="{{asset('/templates/home/uploads/userManual.png')}}" alt=""><span>用户手册</span></a>
        <a href="javascript:"><img src="{{asset('/templates/home/uploads/down_app.png')}}" alt=""><span>下载APP</span></a>
        <a href="javascript:"><img src="{{asset('/templates/home/uploads/shang.png')}}" alt=""><span>隐私条款</span></a>
        <a href="javascript:"><img src="{{asset('/templates/home/uploads/normalProblem.png')}}" alt=""><span>常见问题</span></a>
    </div>
    <div class="footer_bottom">
        <p>上海森画电子商务有限公司 版权所有<a href="javascript:">沪ICP备 15045419号－1</a></p>
    </div>
</div>
</body>
</html>