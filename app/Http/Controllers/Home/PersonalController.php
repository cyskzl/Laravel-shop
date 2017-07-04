<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PersonalController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-设置-个人信息
     */
    public function index()
    {
        return view('home.personal.set.personalInfo');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-交易管理（浏览记录）
     */
    public function browseLog()
    {
        return view('home.personal.transaction.browseLog');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-交易管理（收藏夹）
     */
    public function favorites()
    {
        return view('home.personal.transaction.favorites');
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-个人中心（积分）
     */
    public function integral()
    {
        return view('home.personal.userinfo.integral');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-个人中心（会员等级）
     */
    public function memberLevel()
    {
        return view('home.personal.userinfo.memberLevel');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-个人中心（优惠劵）
     */
    public function coupon()
    {
        return view('home.personal.userinfo.coupon');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-服务中心（最新消息）
     */
    public function newest()
    {
        return view('home.personal.service.newest');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-服务中心（常见问题）
     */
    public function comProblem()
    {
        return view('home.personal.service.comProblem');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-服务中心（用户手册）
     */
    public function userManual()
    {
        return view('home.personal.service.userManual');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-服务中心（隐私条款）
     */
    public function privacyClause()
    {
        return view('home.personal.service.privacyClause');
    }
}
