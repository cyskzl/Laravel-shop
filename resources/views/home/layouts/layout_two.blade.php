<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('/templates/home/css/headert.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('/templates/home/css/footer.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('/templates/home/css/public.css')}}"/>
    @yield('style')
</head>
<body>
<div class="content">
    <!-- 头部 -->
    <div class="header clearfix">
        <!-- 顶部 -->
        <div class="header_top left">
            <ul class="header_top_left left">
                @if(Auth::check())
                    <li><a href="">{{Auth::user()->login_name}}</a></li>
                    <li><a href="{{ url('home/logOut') }}">退出登录</a></li>
                @else
                    <li><a href="{{ url('home/register') }}">注册</a></li>
                    <li><a href="{{ url('home/login') }}">登录</a></li>
                @endif
                <li class="header_top_left_li">下载APP
                    <a href="javascript:">
                        <img class="header_top_left_code" src="{{asset('/templates/home/uploads/down_app.png')}}" alt="">
                    </a>
                </li>
            </ul>
            <ul class="header_top_right right">
                <li><a href="{{url('home/alreadyorder')}}">我的订单</a></li>
                <li><a href="{{url('home/favorites')}}">收藏</a></li>
                <li><a href="{{url('home/newest')}}">消息</a></li>
                <li><a href="{{ url('home/personal') }}">个人中心</a>&nbsp;
                    <span>
                        <img src="{{asset('/templates/home/uploads/pCenter_qian.png')}}" alt="">
                    </span>
                    <div class="header_top_right_div">
                        <a href="{{url('home/shoppingcart')}}">购物车</a>
                        <a href="{{url('home/favorites')}}">收藏夹</a>
                        <a href="{{url('home/integral')}}">W积分</a>
                        <a href="{{url('home/coupon')}}">优惠券</a>
                    </div>
                </li>
                <li><a href="{{url('home/newest')}}">客户服务</a></li>
                <li class="header_top_left_li_two">关注我们
                    <a href="javascript:" class="header_top_left_li_two_ding">
                        <img class="header_top_left_code_two" src="{{asset('/templates/home/uploads/down_app.png')}}" alt="">
                    </a>
                </li>

            </ul>
        </div>
        <!-- 搜索区 -->
        <div class="header_top_bottom left">
            <div class="header_logo left">
                <img src="{{asset('/templates/home/uploads/logo (1).png')}}" alt="">
            </div>
        </div>
    </div>

    <main class="comWidth">
        @yield('main')
    </main>
    <div class="footer left">
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

</div>
@yield('js')
</body>
</html>