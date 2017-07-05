<div class="header_top left">
    <ul class="header_top_left left">

        @if(Auth::check())
            <li><a href="{{ url('home/personal') }}">{{Auth::user()->login_name}}</a></li>
            <li><a href="{{ url('home/logOut') }}">退出登录</a></li>
        @else
            <li><a href="{{ url('home/register') }}">注册</a></li>
            <li><a href="{{ url('home/login') }}">登录</a></li>
        @endif

        <li class="header_top_left_li">下载APP
            <a href="javascript:">
                <img class="header_top_left_code" src="{{ asset('templates/home/uploads/down_app.png') }}" alt="">
            </a>
        </li>
    </ul>
    <ul class="header_top_right right">
        <li>我的订单</li>
        <li>收藏</li>
        <li>消息</li>
        <li class="header_top_right_li">个人中心&nbsp;
            <span>
						<img src="{{ asset('templates/home/uploads/pCenter_qian.png') }}" alt="">
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
            <a href="javascript:" class="header_top_left_li_two_ding">
                <img class="header_top_left_code_two" src="{{ asset('templates/home/uploads/down_app.png') }}" alt="">
            </a>
        </li>

    </ul>
</div>
        