<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * @return  view    会员列表页
     */
    public function index()
    {
        return view('admin.main.member.index');
    }

    /**
     * @return  view    查看会员详情
     */
    public function show()
    {
        return view('admin.main.member.show');
    }

    /**
     * @return  view    会员添加页
     */
    public function create()
    {
        return view('admin.main.member.add');
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function store(Request $request)
    {
        //会员添加
    }

    /**
     * @return  view    会员修改页
     */
    public function edit()
    {
        return view('admin.main.member.edit');
    }

    /**
     * update   更新修改操作
     *
     * @param   $request    array   获取请求头信息
     *
     * @return  未定义
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * destroy  会员删除
     *
     * @param   $request    array   获取请求头信息
     *
     */
    public function destroy(Request $request)
    {
        //删除id
    }

    /**
     * @return  view    会员密码修改页
     */
    public function memberPassword()
    {
        return view('admin.main.member.password');
    }

    /**
     * @param   $request    获取请求头信息
     *
     */
    public function updatePassword(Request $request)
    {
        //修改会员密码 =》 会员ID
    }

    /**
     * @return  view    会员已删除列表
     */
    public function memberRecycleBin()
    {
        return view('admin.main.member.recyclebin');
    }

    /**
     * @return  view    会员浏览记录
     */
    public function memberBrowseLog()
    {
        return view('admin.main.member.browselog');
    }

    public function memberCollection()
    {
        return view('admin.main.member.collection');
    }



}
