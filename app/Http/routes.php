<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//DB::listen(function($sql) {
////dump($sql);
//    echo $sql->sql;
//// dump($sql->bindings);
//});

Route::get('/', function () {
    return redirect('home');
});

Route::group(['prefix' => 'home', 'namespace' => 'Home'], function () {

    // 首页
    Route::get('/', 'IndexController@index');
    // 注册页面
    Route::get('/register', 'RegisterController@register');

    Route::group(['middleware'=>'auth'],function(){
        // 登录界面
        Route::get('/login', 'UserController@login');
    });
    // 验证码生成
    Route::get('/register/code', 'RegisterController@createCode');
    // 邮箱发送注册
    Route::post('/register', 'RegisterController@toRegister');
    // 邮箱验证是否注册
    Route::post('/register/validate', 'RegisterController@validateEmail');
    // 邮箱激活
    Route::get('/register/validate_email', 'RegisterController@validateEmailCode');
    // 登录信息处理
    Route::post('/doLogin', 'Usercontroller@doLogin');
    // 退出登录
    Route::get('/logOut', 'UserController@logOut');
    // 商品列表页
    Route::get('/goodsList/{category_id}', 'GoodController@goodsList');
    // 商品新品列表页（本周与今日最新）
    Route::get('/goodsList/product', 'GoodController@goodsProduct');
    // 商品详情页
    Route::get('/goodsDetail/{goods_id}', 'GoodController@goodsDetail');
    // 购物车
    Route::resource('/shoppingcart', 'ShoppingCartController');
    // 订单页
    Route::resource('/orders', 'OrderController');
    // 个人中心(默认为设置-个人信息 home.personal.set.personnalInfo)
    Route::get('/personal', 'PersonalController@index');
    // 个人中心-交易管理（浏览记录）
    Route::get('/browseLog', 'PersonalController@browseLog');
    // 个人中心-交易管理（收藏夹）
    Route::get('/favorites', 'PersonalController@favorites');
    // 个人中心-订单详情（待付款订单）
    Route::get('/waitorder', 'OrderController@waitOrder');
    // 个人中心-订单详情（已付款订单）
    Route::get('/alreadyorder', 'OrderController@alreadyOrder');
    // 个人中心-订单详情（已取消订单）
    Route::get('/cancelorder', 'OrderController@cancelOrder');
    // 个人中心-订单详情（退款/退货订单）
    Route::get('/refundorder', 'OrderController@refundOrder');
    // 个人中心-个人中心（积分）
    Route::get('/integral', 'PersonalController@integral');
    // 个人中心-个人中心（会员等级）
    Route::get('/memberlevel', 'PersonalController@memberLevel');
    // 个人中心-个人中心（优惠劵）
    Route::get('/coupon', 'PersonalController@coupon');
    // 个人中心-个人中心（评论）
    Route::get('/comment', 'CommentController@comment');
    // 个人中心-服务中心（最新消息）
    Route::get('/newest', 'PersonalController@newest');
    // 个人中心-服务中心（常见问题）
    Route::get('/comproblem', 'PersonalController@comProblem');
    // 个人中心-服务中心（用户手册）
    Route::get('/usermanual', 'PersonalController@userManual');
    // 个人中心-服务中心（隐私条款）
    Route::get('/privacyclause', 'PersonalController@privacyClause');
    // 个人中心-设置（地址管理）
    Route::resource('/adress', 'AddressController');



});

//prefix => 前缀
    // 后台首页
Route::group(['prefix' => 'admin'], function (){
        //后台首页

        Route::get('/', 'Admin\AdminController@index');

        Route::get('/welcome', 'Admin\AdminController@welcome');

        //商品分类  goods =>商品   category => 分类
        Route::resource('/goodscategory', 'Admin\GoodscategoryController');

        //图片上传
        Route::any('/upload/{uploadname}', 'Admin\CommonController@upload');
        //返回3级分类
        Route::any('/ajaxCate','Admin\CommonController@ajaxCate');
        //规格
        Route::any('/ajaxModel','Admin\CommonController@ajaxModel');
        //加载商品属性
        Route::any('/ajaxAttr','Admin\CommonController@ajaxAttr');
        //处理ajax
        Route::any('/ajax', 'Admin\CommonController@ajax');
        //商品列表
        Route::resource('/goods', 'Admin\GoodsController');
        //商品类型
        Route::resource('/type', 'Admin\GoodsTypeController');
        //商品规格
        Route::resource('/spec', 'Admin\SpecController');
        //商品属性
        Route::resource('/goodsattr', 'Admin\GoodsAttributeController');
        //商品品牌
        Route::resource('/brand', 'Admin\BrandController');
        //活动管理
        Route::resource('/activity', 'Admin\ActivityController');
        // 活动商品管理
        Route::resource('/goodsactivity','Admin\GoodsActivityController');

        //轮播图管理
        Route::resource('/carousel', 'Admin\CarouselController');
        //轮播图排序
        Route::post('/carousel/orderby', 'Admin\CarouselController@orderBy');
        //修改轮播图状态
        Route::post('/carousel/status', 'Admin\CarouselController@status');

        //发货单管理
        Route::resource('/deliveryinfo', 'Admin\OrdersDeliveryController');

        //退货单管理
        Route::resource('/returninfo', 'Admin\OrdersReturnController');

        //订单管理
        Route::resource('/orders', 'Admin\OrdersController');

        //商品评论管理
        Route::resource('/comment', 'Admin\CommentController');

        //意见反馈
        Route::resource('/feedback', 'Admin\FeedbackController');

        //会员管理
        Route::resource('/member', 'Admin\MemberController');

        // 收货地址管理
        Route::get('/address','Admin\MemberController@getAddress');

        //会员密码修改
        Route::get('/memberpassword', 'Admin\MemberController@memberPassword');

        //会员回收列表
        Route::get('/memberrecyclebin', 'Admin\MemberController@memberRecycleBin');

        //会员浏览记录
        Route::get('/memberbrowselog', 'Admin\MemberController@memberBrowseLog');

        //商品收藏管理
        Route::get('/membercollection', 'Admin\MemberController@memberCollection');

        //会员等级管理
        Route::resource('/memberlevel', 'Admin\MemberLevelController');

        //会员积分规则管理
        Route::resource('/memberintegral', 'Admin\MemberIntegralController');

        //管理员列表
        Route::resource('/adminlist', 'Admin\AdminListController');

        //角色列表
        Route::resource('/adminrole', 'Admin\AdminRoleController');

        //权限规则
        Route::resource('/adminrule', 'Admin\AdminRuleController');

        //权限分类
        Route::resource('/adminjurisdiction', 'Admin\AdminJurisdictionCateController');

        //系统设置
        Route::any('/settings', 'Admin\SystemSettingsController@index');

        //系统设置修改
        Route::post('/setchange', 'Admin\SystemSettingsController@setChange');

        //友情链接
        Route::resource('/link', 'Admin\LinkController');

        //系统日志
        Route::get('systemlog', 'Admin\AdminController@SystemLog');



});



