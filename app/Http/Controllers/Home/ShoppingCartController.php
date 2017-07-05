<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Auth;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 购物车无商品时
//        return view('home.shoppingcart.cart_empty');
        // 购物车有商品时

        $goods_shop = $request->session()->get('goods_shop');
        dd($request->session()->get('goods_shop'));
        return view('home.shoppingcart.cart_isset', compact('goods_shop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(Request $request, $id)
    {
        $req = json_decode($request->json);
        dd($req);
    }

    public function shoppingCache(Request $request)
    {

        //判断是否有数据
        if (!$request->goods_shop) {
            $error['success'] = 0;
            $error['info']    = '亲，没有选择规格哟！';
            return json_encode($error);
        }

        //获取商品数据
        $goods = json_decode($request->goods_shop, true);

        if (!Auth::check()) {
            $request->session()->push('goods_shop', $goods);
            $error['success'] = 1;
            $error['info']    = '加入购物车成功！';
            return json_encode($error);
        }

    }
}
