<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('/templates/home/css/public.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/home/css/header.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/home/css/footer.css')}}"/>
    {{--<script src="{{asset('/templates/home/js/registe.js')}}"></script>--}}
    <script src="{{asset('/templates/home/js/jquery-1.7.2.min.js')}}"></script>
    <script src="{{asset('/templates/home/js/jquery.cookie.js')}}"></script>
    <script src="{{asset('/templates/home/js/header.js')}}"></script>

    @yield('style')
</head>
<body>
<div class="content">
    <!-- 头部 -->
    <div class="header clearfix">
        <!-- 顶部 -->
        <div class="header_top left">
            <ul class="header_top_left left">
                <li><a href="javascript:;">注册</a></li>
                <li><a href="javascript:;">登录</a></li>
                <li class="header_top_left_li">下载APP
                    <a href="javascript:">
                        <img class="header_top_left_code" src="./uploads/down_app.png" alt="">
                    </a>
                </li>
            </ul>
            <ul class="header_top_right right">
                <li>我的订单</li>
                <li>收藏</li>
                <li>消息</li>
                <li class="header_top_right_li">个人中心&nbsp;
                    <span>
						<img src="./uploads/pCenter_qian.png" alt="">
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
                        <img class="header_top_left_code_two" src="./uploads/down_app.png" alt="">
                    </a>
                </li>

            </ul>
        </div>
        <!-- 搜索区 -->
        <div class="header_top_bottom left">
            <div class="header_top_bottom_people left">
                <a href="javascript:">女士</a>
                <a href="javascript:">男士</a>
                <a href="javascript:">创意生活</a>
            </div>
            <div class="header_logo left">
                <img src="./uploads/logo (1).png" alt="">
            </div>
            <div class="header_search right">
                <div>
                    <input type="text" class="header_searchForm left" placeholder="请输入搜索内容" style="outline:none">
                    <a href="javascript:" id="header_searchin">
                        <img src="./uploads/icon_searchin.png" alt="">
                    </a>
                </div>
                <ul class="left">
                    <li><a href="javascript:">SALONDEJU</a></li>
                    <li><a href="javascript:">ANDERSSON BELL</a></li>
                    <li><a href="javascript:">FIND KAPOOR</a></li>
                    <li><a href="javascript:">MONTS</a></li>
                    <li><a href="javascript:">BIBYSEOB</a></li>
                    <li><a href="javascript:">Yuul Yie</a></li>
                </ul>
            </div>
        </div>
        <!-- 头部nav -->
        <div class="header_nav left">
            <div class="header_nav_left left">
                <div id="header_nav_left_new">
                    <a href="javascript:">新品</a>
                    <div class="header_nav_left_new">
                        <div class="elastic_no">
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="header_nav_left_new">
                    <a href="javascript:">服饰</a>
                    <div class="header_nav_left_new">
                        <div class="elastic_no">
                            <div class="header_nav_left_new_one_text">
                                <a href="javascript:">帽衫／卫衣</a>
                                <a href="javascript:">衬衫</a>
                                <a href="javascript:">毛衣／针织衫</a>
                                <a href="javascript:">T恤</a>
                                <a href="javascript:">大衣／风衣</a>
                                <a href="javascript:">夹克</a>
                                <a href="javascript:">便服</a>
                                <a href="javascript:">牛仔</a>
                                <a href="javascript:">西装</a>
                                <a href="javascript:">皮衣</a>
                                <a href="javascript:">连衣裙</a>
                                <a href="javascript:">半身裙</a>
                                <a href="javascript:">休闲裤</a>
                                <a href="javascript:">运动裤</a>
                                <a href="javascript:">西裤</a>
                                <a href="javascript:">羽绒服／棉服</a>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="header_nav_left_new">
                    <a href="javascript:">鞋履</a>
                    <div class="header_nav_left_new">
                        <div class="elastic_no">
                            <div class="header_nav_left_new_one_text">
                                <a href="javascript:">帽衫／卫衣</a>
                                <a href="javascript:">衬衫</a>
                                <a href="javascript:">毛衣／针织衫</a>
                                <a href="javascript:">T恤</a>
                                <a href="javascript:">大衣／风衣</a>
                                <a href="javascript:">夹克</a>
                                <a href="javascript:">便服</a>
                                <a href="javascript:">牛仔</a>
                                <a href="javascript:">西装</a>
                                <a href="javascript:">皮衣</a>
                                <a href="javascript:">连衣裙</a>
                                <a href="javascript:">半身裙</a>
                                <a href="javascript:">休闲裤</a>
                                <a href="javascript:">运动裤</a>
                                <a href="javascript:">西裤</a>
                                <a href="javascript:">羽绒服／棉服</a>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="header_nav_left_new">
                    <a href="javascript:">包袋</a>
                    <div class="header_nav_left_new">
                        <div class="elastic_no">
                            <div class="header_nav_left_new_one_text">
                                <a href="javascript:">帽衫／卫衣</a>
                                <a href="javascript:">衬衫</a>
                                <a href="javascript:">毛衣／针织衫</a>
                                <a href="javascript:">T恤</a>
                                <a href="javascript:">大衣／风衣</a>
                                <a href="javascript:">夹克</a>
                                <a href="javascript:">便服</a>
                                <a href="javascript:">牛仔</a>
                                <a href="javascript:">西装</a>
                                <a href="javascript:">皮衣</a>
                                <a href="javascript:">连衣裙</a>
                                <a href="javascript:">半身裙</a>
                                <a href="javascript:">休闲裤</a>
                                <a href="javascript:">运动裤</a>
                                <a href="javascript:">西裤</a>
                                <a href="javascript:">羽绒服／棉服</a>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="header_nav_left_new">
                    <a href="javascript:">饰品.其他</a>
                    <div class="header_nav_left_new">
                        <div class="elastic_no">
                            <div class="header_nav_left_new_one_text">
                                <a href="javascript:">帽衫／卫衣</a>
                                <a href="javascript:">衬衫</a>
                                <a href="javascript:">毛衣／针织衫</a>
                                <a href="javascript:">T恤</a>
                                <a href="javascript:">大衣／风衣</a>
                                <a href="javascript:">夹克</a>
                                <a href="javascript:">便服</a>
                                <a href="javascript:">牛仔</a>
                                <a href="javascript:">西装</a>
                                <a href="javascript:">皮衣</a>
                                <a href="javascript:">连衣裙</a>
                                <a href="javascript:">半身裙</a>
                                <a href="javascript:">休闲裤</a>
                                <a href="javascript:">运动裤</a>
                                <a href="javascript:">西裤</a>
                                <a href="javascript:">羽绒服／棉服</a>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                            <div class="header_nav_left_new_one">
                                <img src="./uploads/wimg_450700745_2945817.jpg" alt="">
                                <span class="font_sm">LOOKAST</span>
                                <span class="font">翻领短袖开叉连衣裙_黄色</span>
                                <span class="money">¥ 715</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="javascript:">博主控</a>
                </div>
            </div>
            <div class="header_nav_right right">
                <div class="header_nav_right_one">
                    <a href="javascript:">潮流推荐</a>
                    <div id="header_nav_right_recommended">
                        <div>
                            <h3>促销</h3>
                            <img src="{{asset('/templates/home/uploads/170612_newweb_03.jpg')}}" alt="">
                        </div>
                        <div>
                            <h3>穿搭</h3>
                            <img src="{{asset('/templates/home/uploads/170612_newweb_03.jpg')}}" alt="">
                        </div>
                        <div>
                            <h3>设计师</h3>
                            <img src="{{asset('/templates/home/uploads/170612_newweb_03.jpg')}}" alt="">
                        </div>
                        <div>
                            <h3>明星同款</h3>
                            <img src="{{asset('/templates/home/uploads/170612_newweb_03.jpg')}}" alt="">
                        </div>
                        <div>
                            <h3>最新韩流</h3>
                            <img src="{{asset('/templates/home/uploads/170612_newweb_03.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="header_nav_right_two ">
                    <a href="javascript:">活动专区</a>
                    <div id="header_nav_right_area">
                        <div>
                            <h3><a href="">热门话题</a></h3>
                            <img src="{{asset('/templates/home/uploads/topicBanner.png')}}" alt="">
                        </div>
                        <div>
                            <h3><a href="">最新活动</a></h3>
                            <img src="{{asset('/templates/home/uploads/kv.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--主体内容-->
    <main class="clearfix">
        @yield('main')
    </main>
    <!-- 错误弹窗 -->
    <div class="alert" id="alert">
        @yield('alert')
    </div>


<!-- 尾部 -->
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
    @yield('footer')
    <div class="shoppingcar">
        @yield('shop')
    </div>
</div>
@yield('js')

</body>
</html>