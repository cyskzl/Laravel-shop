<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MemberIntegralController extends Controller
{
    /**
     * @return  view    会员积分规则列表
     */
    public function index()
    {
        return view('admin.main.memberintegral.index');
    }

    /**
     * @return  view    会员积分规则添加
     */
    public function create()
    {
        return view('admin.main.memberintegral.add');
    }

    /**
     * @return  view    会员积分规则修改
     */
    public function edit()
    {
        return view('admin.main.memberintegral.edit');
    }


}
