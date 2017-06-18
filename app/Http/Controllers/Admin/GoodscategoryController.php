<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GoodscategoryController extends Controller
{
    /**
     * @return  view    商品分类列表页
     */
    public function index()
    {
        return view('admin.main.goodscategory.index');
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function create(Request $request)
    {
        //商品分类添加
    }



    /**
     * @return  view    商品分类修改页
     */
    public function edit()
    {
        return view('admin.main.goodscategory.edit');
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
     * destroy  商品分类删除
     *
     * @param   $request    array   获取请求头信息
     *
     */
    public function destroy(Request $request)
    {
        //分类删除id
    }
}
