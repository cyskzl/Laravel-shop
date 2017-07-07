<?php

namespace App\Http\Controllers\Home;

use App\Models\UserInfo;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct()
    {
        $user = UserInfo::where('user_id', '=', \Auth::user()->user_id)->first();
        view()->share('user', $user);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cateId = $request->session()->get('Index');

        return view('home.orders.submit_order', compact('cateId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('home.orders.payment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }
    public  function shopOrders(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-订单详情（待付款订单）
     */
    public function waitOrder(Request $request)
    {
        $cateId = $request->session()->get('Index');
        return view('home.personal.order.waitOrder',compact('cateId'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-订单详情（已付款订单）
     */
    public function alreadyOrder(Request $request)
    {
        $cateId = $request->session()->get('Index');
        return view('home.personal.order.alreadyOrder',compact('cateId'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-订单详情（已取消订单）
     */
    public function cancelOrder(Request $request)
    {
        $cateId = $request->session()->get('Index');
        return view('home.personal.order.cancelOrder',compact('cateId'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-订单详情（退款/退货订单）
     */
    public function refundOrder(Request $request)
    {
        $cateId = $request->session()->get('Index');
        return view('home.personal.order.refundOrder',compact('cateId'));
    }

    public function cartAjax(Request $request)
    {
        if ( $request->data ) {

            $goodsarr = json_decode($request->data, true);


            $error['success'] = 1;
            $error['url']     = url('home/orders');
            return json_encode($error);
        }

        $error['success'] = 0;
        $error['info']    = '未知错误！';
        return json_encode($error);

    }


}
