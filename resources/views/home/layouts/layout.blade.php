<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('/templates/home/css/public.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/home/css/header.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/home/css/footer.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/admin/lib/layui/css/layui.css')}}"/>
    {{--<link rel="stylesheet" href="{{asset('/templates/home/bootstrap/css/bootstrap.min.css')}}"/>--}}
    {{--<link rel="stylesheet" href="{{asset('/templates/home/bootstrap/css/bootstrap.min.css')}}"/>--}}
    {{--<script src="{{asset('/templates/home/js/registe.js')}}"></script>--}}
    <script src="{{asset('/templates/home/js/jquery-1.7.2.min.js')}}"></script>
    <script src="{{asset('/templates/home/js/jquery.cookie.js')}}"></script>
    <script src="{{asset('/templates/home/js/jquery-session.js')}}"></script>
    <script src="{{asset('/templates/home/js/jquery.leanModal.min.js')}}"></script>
    <script src="{{asset('/templates/admin/lib/layui/layui.js')}}"></script>

    @yield('style')
</head>
<body>
<div class="content">
    <!-- 头部 -->
    <div class="header clearfix">
        <!-- 顶部 -->

    @include('home.layouts.top')
    <!-- 搜索区 -->
        <div class="header_top_bottom left">
            <div class="header_top_bottom_people left">
                <a href="{{ url('home/') }}/?categoryId={{$onemaam->id}}" data-currentcategoryid="0">{{$onemaam->name}}</a>
                <a href="{{ url('home/') }}/?categoryId={{$onemam->id}}"data-currentcategoryid="1">{{$onemam->name}}</a>
                {{--<a href="{{ url('home/') }}/{{$onelife->id}}" data-currentcategoryid="2">{{$onelife->name}}</a>--}}
            </div>
            <div class="header_logo left">
                <img src="{{asset('/templates/home/uploads/logo (1).png')}}" alt="">
            </div>
            <div class="header_search right">
                <div>
                    <input type="text" class="header_searchForm left" placeholder="请输入搜索内容" style="outline:none">
                    <a href="javascript:" id="header_searchin">
                        <img src="{{asset('/templates/home/uploads/icon_searchin.png')}}" alt="">
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
                <div id="header_nav_left_nab">
                    <!--<a href="javascript:">6.18</a>-->
                    <div class="header_nav_left_nab">
                    </div>
                </div>
                {{--导航分类请求ajax--}}
                @if($cateId == 1 || $cateId == '')
                    @foreach($twomaan as $tmaan)
                        <div id="header_nav_left_new" class="CateNav">
                            <a id="butt" href="{{url('home/goodsList/')}}/{{$tmaan->id}}" route="{{$cateId}}" data-id="{{$tmaan->id}}" >{{$tmaan->name}}</a>
                            <div class="header_nav_left_new">
                                <div class="elastic_no">
                                    <div class="header_nav_left_new_one_text">
                                        {{--3级分类--}}
                                    </div>
                                    {{--2级分类下的商品图片--}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @elseif($cateId == 2)
                    @foreach($twomam as $tman)
                        <div id="header_nav_left_new" class="CateNav">
                            <a href="{{url('home/goodsList/')}}/{{$tman->id}}" route="{{$cateId}}" data-id="{{$tman->id}}" >{{$tman->name}}</a>
                            <div class="header_nav_left_new">
                                <div class="elastic_no">
                                    <div class="header_nav_left_new_one_text">
                                        {{--3级分类--}}
                                    </div>
                                    {{--2级分类下的商品图片--}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
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
    //导航栏
    $('.CateNav').mouseenter (function (){
        var that = $(this);
        //判断是男士还是女士,生活
        var cate_id ={{$cateId}}
            bool = that.find('a').first().attr('exists') ;
        //获取pid
        var pid = that.find('a').first().attr('data-id');
        //判断是否是第一个
        var index =  $('.CateNav').index(this);
        //第一个是新品
        if (!bool) {
            if(index == '0'){
                var goodsnew = '';
                //请求ajax 前先清除里面的内
                $("div").siblings(".CateNav").eq(0).find('.elastic_no').children().remove();
                $.ajax({
                    type: "POST",
                    url: "/home/newgoods",
                    data: {'_token': '{{csrf_token()}}', 'pid': pid, 'cate_id': cate_id},
                    success: function (data) {
                        //取得新品数据
                        for(var z=0;z<data.newgoods.length;z++){
                            var original_img = data.newgoods[z]['original_img'] ;
                            original_img=original_img.substring(0,original_img.length-1);
                            goodsnew +=  '<div class="header_nav_left_new_one">';
                            goodsnew += '<a href="/home/goodsDetail/'+data.newgoods[z]['goods_id']+'"><img src='+original_img+' >';
                            goodsnew += '<span class="font_sm">'+data.brand[z]+'</span>';
                            goodsnew += '<span class="font">'+data.newgoods[z]['goods_name']+'</span>';
                            goodsnew += '<span class="money">¥ '+data.newgoods[z]['shop_price']+'</span>';
                            goodsnew += '</a></div>';
                        }
                        //添加新品图片
                        $("div").siblings(".CateNav").eq(0).find('.elastic_no').remove('.header_nav_left_new_one_text').append(goodsnew);
                        //往最大的div添加属性
                        that.attr('exists', '1');
                    }
                });
            } else {
                var str = '';
                var goodsstr = '';
                //第一次前清除里面的内容
                that.find('header_nav_left_new_one_text').children().remove();
                that.find('.header_nav_left_new_one').remove();
                $.ajax({
                    type: "POST",
                    url: "/home/getAjaxCate",
                    data: {'_token': '{{csrf_token()}}', 'pid': pid, 'cate_id': cate_id},
                    success: function (data) {
                        //遍历分类
                        var cate = data.cate;
                        for(var i=0; i<cate.length; i++) {
                            str += ' <a href="/home/catalog/category_id/'+cate[i]['id']+'">'+cate[i]['name']+'</a>';
                        }
                        //遍历商品图片
                        for(var j=0; j<data.goods.length;j++){
                            var original_img = data.goods[j]['original_img'] ;
                            original_img=original_img.substring(0,original_img.length-1);
                            goodsstr += '<div class="header_nav_left_new_one">';
                            goodsstr += '<a href="/home//goodsDetail/'+data.goods[j]['goods_id']+'"><img src='+original_img+' >';
                            goodsstr += '<span class="font_sm">'+data.brand[j]+'</span>';
                            goodsstr += '<span class="font">'+data.goods[j]['goods_name']+'</span>';
                            goodsstr += '<span class="money">¥ '+data.goods[j]['shop_price']+'</span>';
                            goodsstr += '</a></div>';
                        }
                        //添加
                        that.find('.header_nav_left_new_one_text').append(str);
                        that.find('.elastic_no').append(goodsstr);
                        that.find('a').first().attr('exists', '1');
                    }
                });
            }
        }



    });

    //新品


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
//        console.log(currentId);
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
            {{--{{Config::set('calculations.Index', '1')}}--}}
            {{--            {{$request->session()->set('Index', '1')}}--}}

        }else if(currentId == 1){
            //    navBg = "#505c82";
            img = 'men';
            {{--            {{$request->session()->set('Index', '2')}}--}}
            {{--            {{Config::set('calculations.Index', '2')}}--}}
        }else if(currentId == 2){
            //    navBg = "#a4d7d8";
            img = 'design';
        }
        return img;
    }

</script>
</body>
</html>
