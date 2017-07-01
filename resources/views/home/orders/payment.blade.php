<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加收货地址</title>
    <link rel="stylesheet" href="{{asset('/templates/home/css/headert.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('/templates/home/css/footer.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('/templates/home/css/public.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/home/iconfont/iconfont.css')}}./"/>
    <link rel="stylesheet" href="{{asset('/templates/home/css/payment.css')}}"/>
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
            <div class="header_logo left">
                <img src="./uploads/logo (1).png" alt="">
            </div>
        </div>
    </div>

    <!-- 内容 -->
    <main class="comWidth">

        <!--订单提交成功 start -->
        <div class="layout clearfix">
            <span class="iconfont icon-dagou dagou fl"></span>
            <div class="fl erhuh">
                <h3>订单提交成功，请您尽快付款！</h3>
                <p>订单号：  201706291457462774    |     付款金额（元）：  <b>5304.88</b> 元</p>
                <p>请您在  <b>2017-06-30</b> 完成支付，否则订单将自动取消</p>
            </div>
        </div>
        <!--订单提交成功 end -->

        <!--订单详情 start -->
        <div class="details">
            <a href="javascript:;" class="details_btn">订单详情</a>
        </div>
        <!--订单详情 end -->

        <!-- 支付方式 start-->
        <div class="payWay">
            <h4>选择支付方式</h4>
            <div>
                <ul class="payList flex">
                    <li>
                        <div class="payment_area clearfix">
                            <input class="fl vam" type="radio"/>
                            <label class="fl" for=""><img src="./uploads/zfb.jpg" alt=""/></label>
                        </div>
                    </li>
                    <li>
                        <div class="payment_area clearfix">
                            <input class="fl vam" type="radio"/>
                            <label class="fl" for=""><img src="./uploads/hdfk.jpg" alt=""/></label>
                        </div>
                    </li>
                    <li>
                        <div class="payment_area clearfix">
                            <input class="fl vam" type="radio"/>
                            <label class="fl" for=""><img src="./uploads/wx.jpg" alt=""/></label>
                        </div>
                    </li>
                    <li>
                        <div class="payment_area clearfix">
                            <input class="fl vam" type="radio"/>
                            <label class="fl" for=""><img src="./uploads/zxzf.jpg" alt=""/></label>
                        </div>
                    </li>
                    <li>
                        <div class="payment_area clearfix">
                            <input class="fl vam" type="radio"/>
                            <label class="fl" for=""><img src="./uploads/cft.jpg" alt=""/></label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- 支付方式 end-->

        <!-- 确认支付方式 start-->
        <div class="confirm_pay">
            <a href="javascript:;">确认支付方式</a>
        </div>
        <!-- 确认支付方式 end-->
    </main>


    <!-- 尾部 -->
    <div class="footer left">
        <div class="footer_top">
            <a href="javascript:">
                <img src="./uploads/memberLevel.png" alt="">
                <span>会员等级</span>
            </a>
            <a href="javascript:"><img src="./uploads/userManual.png" alt=""><span>用户手册</span></a>
            <a href="javascript:"><img src="./uploads/down_app.png" alt=""><span>下载APP</span></a>
            <a href="javascript:"><img src="./uploads/shang.png" alt=""><span>隐私条款</span></a>
            <a href="javascript:"><img src="./uploads/normalProblem.png" alt=""><span>常见问题</span></a>
        </div>
        <div class="footer_bottom">
            <p>上海森画电子商务有限公司 版权所有<a href="javascript:">沪ICP备 15045419号－1</a></p>

        </div>
    </div>
   
</div>

</body>
</html>