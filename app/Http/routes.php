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

Route::group(['prefix' => 'home', 'namespace' => 'Home'], function () {
    // 注册页面
    Route::get('/register', 'RegisterController@register');
    // 验证码生成
    Route::get('/register/code', 'RegisterController@createCode');
    // 邮箱发送注册
    Route::post('/register', 'RegisterController@toRegister');
    // 邮箱验证是否注册
    Route::post('/register/validate', 'RegisterController@validateEmail');
    // 邮箱激活
    Route::get('/register/validate_email', 'RegisterController@validateEmailCode');
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

        //商品列表
        Route::resource('/goods', 'Admin\GoodsController');

        //活动管理
        Route::resource('/activity', 'Admin\ActivityController');

        //轮播图管理
        Route::resource('/carousel', 'Admin\CarouselController');

        //订单管理
        Route::resource('/orders', 'Admin\OrdersController');

        //商品评论管理
        Route::resource('/comment', 'Admin\CommentController');

        //意见反馈
        Route::resource('/feedback', 'Admin\FeedbackController');

        //会员管理
        Route::resource('/member', 'Admin\MemberController');

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

        //友情链接
        Route::resource('/link', 'Admin\LinkController');

        //系统日志
        Route::get('systemlog', 'Admin\AdminController@SystemLog');



});



