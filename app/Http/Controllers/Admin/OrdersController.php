<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * @return  view    订单管理列表页
     */
    public function index()
    {
        return view('admin.main.orders.index');
    }

    /**
     * @return  view    订单添加页
     */
    public function create()
    {
        return view('admin.main.orders.add');
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function store(Request $request)
    {
        //订单添加
    }

    /**
     * @return  view    订单修改页
     */
    public function edit()
    {
        return view('admin.main.orders.edit');
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
     * destroy  订单删除
     *
     * @param   $request    array   获取请求头信息
     *
     */
    public function destroy(Request $request)
    {
        //删除id
    }
}
