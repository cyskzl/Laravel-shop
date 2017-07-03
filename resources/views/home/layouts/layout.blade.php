<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('/templates/home/css/public.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/home/css/header.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/home/css/footer.css')}}"/>
    {{--<link rel="stylesheet" href="{{asset('/templates/home/bootstrap/css/bootstrap.min.css')}}"/>--}}
    {{--<script src="{{asset('/templates/home/js/registe.js')}}"></script>--}}
    <script src="{{asset('/templates/home/js/jquery-1.7.2.min.js')}}"></script>
    <script src="{{asset('/templates/home/js/jquery.cookie.js')}}"></script>
    <script src="{{asset('/templates/home/js/jquery-session.js')}}"></script>

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
        <!-- 搜索区 -->
        <div class="header_top_bottom left">
            <div class="header_top_bottom_people left">

                <a href="{{ url('home/') }}/{{$onemaam->id}}" data-currentcategoryid="0">{{$onemaam->name}}</a>
                <a href="{{ url('home/') }}/{{$onemam->id}}"data-currentcategoryid="1">{{$onemam->name}}</a>
                <a href="{{ url('home/') }}/{{$onelife->id}}" data-currentcategoryid="2">{{$onelife->name}}</a>
            </div>
            <div class="header_logo left">
                <img src="{{ asset('templates/home/uploads/logo (1).png') }}" alt="">
            </div>
            <div class="header_search right">
                <div>
                    <input type="text" class="header_searchForm left" placeholder="请输入搜索内容" style="outline:none">
                    <a href="javascript:" id="header_searchin">
                        <img src="{{ asset('templates/home/uploads/icon_searchin.png') }}" alt="">
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
                            {{--女士--}}
                            @if($cateId == 1 || $cateId == '')
                            @foreach($goodsmaams as $goodsmaam)
                            <div class="header_nav_left_new_one">
                                <img src="{{rtrim( $goodsmaam->original_img, ',')}}" alt="">
                                <span class="font_sm">品牌</span>
                                <span class="font">{{$goodsmaam->goods_name}}</span>
                                <span class="money">¥ {{$goodsmaam->shop_price}}</span>
                            </div>
                            @endforeach
                                {{--男士--}}
                                @elseif($cateId == 2)
                                @foreach($goodsmams as $goodsmam)
                                    <div class="header_nav_left_new_one">
                                        <img src="{{rtrim( $goodsmam->original_img, ',')}}" alt="">
                                        <span class="font_sm">品牌</span>
                                        <span class="font">{{$goodsmam->goods_name}}</span>
                                        <span class="money">¥ {{$goodsmam->shop_price}}</span>
                                    </div>
                                @endforeach
                                {{--创意生活--}}
                                @elseif($cateId == 3)
                                @foreach($goodslife as $life)
                                    <div class="header_nav_left_new_one">
                                        <img src="{{rtrim( $life->original_img, ',')}}" alt="">
                                        <span class="font_sm">品牌</span>
                                        <span class="font">{{$life->goods_name}}</span>
                                        <span class="money">¥ {{$life->shop_price}}</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                    {{--女士--}}
                    @if($cateId == 1 || $cateId == '')
                        @foreach($twomaan as $tmaan)
                        <div id="header_nav_left_new">
                            <a href="{{url('catalog/category_id/')}}/{{$tmaan->id}}">{{$tmaan->name}}</a>
                            <div class="header_nav_left_new">
                                <div class="elastic_no">
                                    {{--3级分类--}}
                                    <div class="header_nav_left_new_one_text">
                                    @foreach($threemaan as $treemaan)
                                        {{--{{$treemaan->id}}--}}
                                            @if($tmaan->id == $treemaan->pid)
                                                     <a href="{{url('/catalog/category_id/')}}/{{$treemaan->id}}">{{$treemaan->name}}</a>
                                            @endif
                                        @endforeach
                                    </div>

                                    @foreach($arr as $goodsthreemm)


                                    @foreach($goodsthreemm as $value)

                                            {{$tmaan->id}}
{{--{{dump($value)}}--}}                @if(strpos($value->cat_id,'170'))
                                                <div class="header_nav_left_new_one">
                                                <img src="{{rtrim($value->original_img, ',')}}" alt="">
                                                <span class="font_sm">品牌</span>
                                                <span class="font">{{$value->goods_name}}</span>
                                                <span class="money">¥ {{$value->shop_price}}</span>
                                                </div>


                                            @endif



                                        @endforeach


                                    @endforeach
                                    {{--@endforeach--}}
                                </div>
                            </div>
                        </div>
                    @endforeach


                    {{--男士--}}
                    @elseif($cateId == 2)
                        {{--创意生活--}}
                    @elseif($cateId == 3)
                        @endif
                    {{--2级分类--}}





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
<script src="{{asset('/templates/home/js/index.js')}}"></script>
<script type="text/javascript">
    $(function(){
        if (!$.session.get("currentCategoryId")){

            $('.header_top_bottom_people a')[0].setAttribute('class','women');
            $('.header_top_bottom_people a')[0].style='color:#fff';

        } else {

            var id = $.session.get("currentCategoryId");
            var img = $.session.get("currentCategoryImg");
            $('.header_top_bottom_people a')[id].setAttribute('class',''+ img +'');
            $('.header_top_bottom_people a')[id].style='color:#fff';

        }

    });

    // 女士，男士，创意生活切换
    $(".header_top_bottom_people a").click(function(){

        //导航背景色随频道颜色改变
        var currentId = $(this).data("currentcategoryid"),navBg;

        var img = imgClass(currentId);
        $(this).addClass(''+ img +'').css('color','#fff').siblings("a").removeClass().css('color','#626161');
        // 女士，男士，创意生活切换

        $.session.set('currentCategoryId', currentId);
        $.session.set('currentCategoryImg',''+ img +'');
        window.location.href=''+ $(this).attr('href') +'';
        return false;
    });

    function imgClass(currentId){

        var img = '';
        //    console.log(currentId );
        if(currentId == 0){
            //    navBg = "#f54b73";
            img = 'women';
        }else if(currentId == 1){
            //    navBg = "#505c82";
            img = 'men';
        }else if(currentId == 2){
            //    navBg = "#a4d7d8";
            img = 'design';
        }
        return img;
    }

</script>
</body>
</html>
