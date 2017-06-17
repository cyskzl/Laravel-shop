<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    /**
     * @return  view    商品列表页
     */
    public function index()
    {
        return view('admin.main.goods.index');
    }

    /**
     * @return  view    商品添加页
     */
    public function create()
    {
        return view('admin.main.goods.add');
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function store(Request $request)
    {
        //商品添加
    }

    /**
     * @return  view    商品修改页
     */
    public function edit()
    {
        return view('admin.main.goods.edit');
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
     * destroy  商品删除
     *
     * @param   $request    array   获取请求头信息
     *
     */
    public function destroy(Request $request)
    {
        //删除id
    }



}
