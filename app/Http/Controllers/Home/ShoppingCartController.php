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
//        session_start();
        $cart_data = [];

        //判断用户是否登录
        if (Auth::check()) {
            //用户已经登录从redis中取出该用户购物车数据
            $redis = Redis::hGetAll('user_id:'.Auth::user()->user_id);

            foreach ($redis as $row) {
                $cart_data[] = json_decode($row, true);
            }

        } else {
            //未登录从session获取
            if ( !empty( $_SESSION['goods_shop']) ) {
                $cart_data = $_SESSION['goods_shop'];
            }

        }

//        unset($_SESSION['goods_shop']);
//        dd(Redis::FLUSHALL());
        return view('home.shoppingcart.cart_isset', compact('cart_data'));
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

        if ( $request->data ) {

            $_SESSION['goods_shop'][$id]['num'] = $request->data;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        if ( $request->data ) {
            unset($_SESSION['goods_shop'][$id]);
            $error['success'] = 1;
            $error['info']    = '已删除';
            return json_encode($error);
        }

        $error['success'] = 0;
        $error['info']    = '删除失败';
        return json_encode($error);

    }

    /**
     * 添加商品到购物车
     *
     * @param  Request $request
     * @return string
     */
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

        //判断用户是否登录，未登录只存session，登录存redis
        if (!Auth::check()) {

            if ( empty( $_SESSION['goods_shop'][$goods['session_id']] ) ) {

                //为空加入session
                $res = $_SESSION['goods_shop'][$goods['session_id']] = $goods;
                if ( $res ) {

                    $error['success'] = 1;
                    $error['info']    = '加入购物车成功！';
                    return json_encode($error);
                } else {

                    $error['success'] = 0;
                    $error['info']    = '加入购物车失败！';
                    return json_encode($error);

                }

            } else {

                //获取session中数据
                $is_goods = $_SESSION['goods_shop'][$goods['session_id']];

                //判断是否已存在购物车的商品
                if ( $is_goods['session_id'] == $goods['session_id'] ) {

                    //判断商品规格是否相等
                    if ( $is_goods['key1'] == $goods['key1'] && $is_goods['key2'] == $goods['key2'] ) {

                        //如果相等则与session中的数量与新提交的数量相加
                        $is_goods['num'] = $is_goods['num'] + $goods['num'];
                        $_SESSION['goods_shop'][$goods['session_id']] = $is_goods;

                        $error['success'] = 1;
                        $error['info']    = '加入购物车成功！';
                        return json_encode($error);
                    } else {

                        $error['success'] = 0;
                        $error['info']    = '加入购物车失败！';
                        return json_encode($error);

                    }

                }
            }

        } else {

            if ( !empty($_SESSION['goods_shop'])) {
                foreach ( $_SESSION['goods_shop'] as $session_goods) {
                    var_dump($session_goods);
                }
            }

        }


        //用户已经登录获取用户id
        $user_id = Auth::user()->user_id;

        //获取该用户的购物车商品数据
        $redis_goods = Redis::hget( 'user_id:'.$user_id, $goods['session_id'] );

        if ( !$redis_goods ) {

            $res = Redis::hset('user_id:'.$user_id, $goods['session_id'], json_encode($goods));

            if ($res) {

                $error['success'] = 1;
                $error['info']    = '加入购物车成功！';
                return json_encode($error);
            } else {

                $error['success'] = 0;
                $error['info']    = '加入购物车失败！';
                return json_encode($error);
            }
        } else {

            $is_redis = json_decode($redis_goods);
            $is_redis->num = $is_redis->num + $goods['num'];

            $res = Redis::hset('user_id:'.$user_id, $is_redis->session_id, json_encode($is_redis));
            if ($res) {

                $error['success'] = 1;
                $error['info']    = '加入购物车成功！';
                return json_encode($error);
            } else {

                $error['success'] = 0;
                $error['info']    = '加入购物车失败！';
                return json_encode($error);
            }

        }

        $res = Redis::hgetall('user_id:'.Auth::user()->user_id);
        dd($res);


    }
}
