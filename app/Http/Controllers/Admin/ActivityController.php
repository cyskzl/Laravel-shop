<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    /**
     * @return  view    活动管理列表页
     */
    public function index()
    {
        return view('admin.main.activity.index');
    }

    /**
     * @return  view    活动添加页
     */
    public function create()
    {
        return view('admin.main.activity.add');
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function store(Request $request)
    {
        //活动添加
    }

    /**
     * @return  view    活动修改页
     */
    public function edit()
    {
        return view('admin.main.activity.edit');
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
     * destroy  活动删除
     *
     * @param   $request    array   获取请求头信息
     *
     */
    public function destroy(Request $request)
    {
        //删除id
    }
}
