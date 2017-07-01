<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加收货地址</title>
    <link rel="stylesheet" href="{{asset('/templates/home/css/headert.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('/templates/home/css/footer.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('/templates/home/css/public.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/home/css/addres.css')}}"/>
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
        <div class="page_block">
            <div class="page_title">收货地址</div>
            <div class="edit_address_from">
                <form action="">
                    <div class="form_title">添加收货地址</div>
                    <div class="from_row">
                        <label>收货人姓名</label>
                        <input type="text" placeholder="请填写收货人姓名"/>
                    </div>
                    <div class="from_row">
                        <label>手机号码</label>
                        <input type="text" placeholder="请填写手机号码"/>
                    </div>
                    <div class="from_row">
                        <label>收货地址</label>
                        <select name="region" id="region_province" class="validate-select"></select>
                        <select name="region" id="region_city" class="validate-select"></select>
                        <select name="region" id="region_district" class="validate-select"></select>
                    </div>
                    <div class="from_row">
                        <label>详细地址</label>
                        <textarea name="" id="street" placeholder="请填写详细地址" cols="30" rows="10"></textarea>
                    </div>
                    <div class="from_row">
                        <label></label>
                        <input type="checkbox" checked/>
                        <span>设为默认收货地址</span>
                    </div>
                    <div class="from_row">
                        <label>身份证号码</label>
                        <input type="text" placeholder="请填写身份证号码"/>
                        <br/>
                        <p class="iTips">(注：购买直邮/跨境通/行邮商品，请记得填写身份证号码)</p>
                        <div class="certifyArea">
                            <div class="idcardsubmit">
                                <div class="certifyItem clearfix">
                                    <label class="fl">身份证号码</label>
                                    <a class="fl" href="javascript:;">
                                        <em>+</em>
                                        上传图片
                                    </a>
                                    <div class="fl demonstration">
                                        <img src="./uploads/positive_model.png" alt=""/>
                                        <p>正面示范</p>
                                    </div>
                                </div>
                                <div class="certifyItem clearfix">
                                    <label class="fl">身份证号码</label>
                                    <a class="fl" href="javascript:;">
                                        <em>+</em>
                                        上传图片
                                    </a>
                                    <div class="fl demonstration">
                                        <img src="./uploads/negative_model.png" alt=""/>
                                        <p>正面示范</p>
                                    </div>
                                </div>
                            </div>
                            <div class="certifyItem">
                                <ul>
                                    <li>根据中国海关要求，入境走个人行邮通道的物品，购买者必须提供清晰的身份证正反面照片，如下几种情况包裹将不能正常清关：</li>
                                    <li>1、没有提供上传的图片的姓名，身份证号和上面填写不符时；</li>
                                    <li>2、身份证姓名和收件人姓名不符；</li>
                                    <li>3、上传图片不清晰，以能看到身份证底纹为标准；</li>
                                    <li>4、身份证图片不全。</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="from_row">
                        <input type="submit" value="保存" class="btn_subbmit"/>
                    </div>
                </form>
            </div>
        </div>
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