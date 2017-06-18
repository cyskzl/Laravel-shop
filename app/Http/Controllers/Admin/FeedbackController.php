<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    /**
     * @return  view    意见反馈列表页
     */
    public function index()
    {
        return view('admin.main.feedback.index');
    }



    /**
     * @return  view    意见反馈修改页
     */
    public function edit()
    {
        return view('admin.main.feedback.edit');
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
     * destroy  意见反馈删除
     *
     * @param   $request    array   获取请求头信息
     *
     */
    public function destroy(Request $request)
    {
        //删除id
    }
}
