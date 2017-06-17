<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CarouselController extends Controller
{
    /**
     * @return  view    轮播图管理列表页
     */
    public function index()
    {
        return view('admin.main.carousel.index');
    }

    /**
     * @return  view    轮播图添加页
     */
    public function create()
    {
        return view('admin.main.carousel.add');
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function store(Request $request)
    {
        //轮播图添加
    }

    /**
     * @return  view    轮播图修改页
     */
    public function edit()
    {
        return view('admin.main.carousel.edit');
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
     * destroy  轮播图删除
     *
     * @param   $request    array   获取请求头信息
     *
     */
    public function destroy(Request $request)
    {
        //删除id
    }
}
