<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Models\SpecGoodsPrice;
use App\Models\SpecItem;
use App\Models\Goods;
use App\Models\Spec;
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

            //用户如果登录将session中的商品信息存到redis
            if ( !empty( $_SESSION['goods_shop'] ) ) {

                foreach ( $_SESSION['goods_shop'] as $session_goods ) {
                    $redis_goods = Redis::hget('user_id:'.Auth::user()->user_id, $session_goods['session_id']);
                    //不存在，添加为新数据
                    if ( !$redis_goods ) {

                        Redis::hset('user_id:'.Auth::user()->user_id, $session_goods['session_id'], json_encode($session_goods));
                    }

                }
                unset($_SESSION['goods_shop']);
            }

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

        foreach ($cart_data as $key => $value) {
            if ( !isset( $value['img'] ) || empty( $value['img'] ) ) {
                $cart_data[$key]['img'] = 'templates/home/images/nofoundpic.gif';
            }
        }
    //    dd($cart_data);

        unset($_SESSION['goods_shop']);
        dd(Redis::FLUSHALL());
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
        //修改商品数量
        if ( $request->data ) {

            if ( Auth::check() ) {

                $redis_goods = Redis::hget( 'user_id:'.Auth::user()->user_id, $id );
                if ( $redis_goods ) {

                    $res = json_decode( $redis_goods );
                    $res->num = $request->data;
                    Redis::hset( 'user_id:'.Auth::user()->user_id, $id, json_encode( $res ) );
                }

            } else {

                if ( $_SESSION['goods_shop'][$id] ) {
                    $_SESSION['goods_shop'][$id]['num'] = $request->data;
                }
            }
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

            if (Auth::check()) {
                $redis_goods = Redis::hget('user_id:'.Auth::user()->user_id, $id);
                if ($redis_goods) {
                    $res = Redis::hdel('user_id:'.Auth::user()->user_id, $id);

                    if ($res) {
                        $error['success'] = 1;
                        $error['info']    = '已删除！';
                        return json_encode($error);
                    }

                    $error['success'] = 0;
                    $error['info']    = '删除失败！';
                    return json_encode($error);
                }

            }

            if ( $_SESSION['goods_shop'][$id] ) {
                unset($_SESSION['goods_shop'][$id]);

                $error['success'] = 1;
                $error['info']    = '已删除！';
                return json_encode($error);
            }

            $error['success'] = 0;
            $error['info']    = '删除失败！';
            return json_encode($error);

        }

        $error['success'] = 0;
        $error['info']    = '没有找到该商品信息！';
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
        if ( !$request->goods_shop ) {
            $error['success'] = 0;
            $error['info']    = '亲，没有选择规格哟！';
            return json_encode( $error );
        }

        //获取商品数据
        $goods = json_decode( $request->goods_shop );

        //查询商品信息
        $goods_info = Goods::find( $goods->goods_id );

        if ( !$goods_info ) {
            $error['success'] = 0;
            $error['info']    = '没有找到该商品信息！';
            return json_encode( $error );
        }
        //查询商品规格信息
        $spec_key = SpecGoodsPrice::where( 'key',$goods->key )
                                  ->first(['key', 'price', 'store_count']);

        if ( !$spec_key ) {
            $error['success'] = 0;
            $error['info']    = '没有找到该商品规格信息！';
            return json_encode( $error );
        }

        if ( $spec_key->store_count < 1 ) {
            $error['success'] = 0;
            $error['info']    = '该商品库存不足！';
            return json_encode( $error );
        }

        //拆分规格id
        $key_arr = explode( '_', $spec_key->key );

        //获取商品规格
        $spec_arr = [];
        foreach ( $key_arr as $value ) {
            //获取商品规格
            $res = SpecItem::where( 'id', $value )->first();
            $spec = Spec::where( 'id', $res->spec_id )->first();
            //拼接规格
            $spec_arr[] = $spec->name.'：'.$res->item;

        }

        //定义session id
        $session_id = $goods_info->goods_id.'_'.$spec_key->key;
        //定义商品信息数组
        $session_goods['img']        = rtrim($goods_info->original_img, ',');
        $session_goods['key']        = $spec_key->key;
        $session_goods['num']        = $goods->num;
        $session_goods['key1']       = $key_arr[0];
        $session_goods['key2']       = $key_arr[1];
        $session_goods['spec']       = $spec_arr;
        $session_goods['price']      = $spec_key->price;
        $session_goods['goods_id']   = $goods_info->goods_id;
        $session_goods['session_id'] = $session_id;
        $session_goods['goods_name'] = $goods_info->goods_name;

        //判断用户是否登录，未登录只存session，已登录存redis
        if (!Auth::check()) {
            //判断该商品是否已存在，不存在加入购物车
            if ( empty( $_SESSION['goods_shop'][$session_id] ) ) {

                //为空加入session
                $res = $_SESSION['goods_shop'][$session_id] = $session_goods;
                if ( $res ) {

                    $error['success'] = 1;
                    $error['info']    = '加入购物车成功！';
                    return json_encode( $error );
                }

                $error['success'] = 0;
                $error['info']    = '加入购物车失败！';
                return json_encode( $error );

            } else {

                //获取session中数据
                $is_goods = $_SESSION['goods_shop'][$session_id];

                //判断是否已存在购物车的商品
                if ( $is_goods['session_id'] == $session_id ) {

                    //判断商品规格是否相等
                    if ( $is_goods['key'] == $spec_key->key ) {

                        //如果相等则与session中的数量与新提交的数量相加
                        $is_goods['num'] = $is_goods['num'] + $goods->num;

                        $_SESSION['goods_shop'][$session_id] = $is_goods;

                        $error['success'] = 1;
                        $error['info']    = '加入购物车成功！';
                        return json_encode( $error );
                    }

                    $error['success'] = 0;
                    $error['info']    = '加入购物车失败！';
                    return json_encode( $error );

                }
            }

        }


        //用户已经登录获取用户id
        $user_id = Auth::user()->user_id;

        //获取该用户的购物车商品数据
        $redis_goods = Redis::hget( 'user_id:'.$user_id, $session_id );

        if ( !$redis_goods ) {
            //如果不存在存进redis
            $res = Redis::hset( 'user_id:'.$user_id, $session_id, json_encode( $session_goods ) );

            if ( $res ) {

                $error['success'] = 1;
                $error['info']    = '加入购物车成功！';
                return json_encode( $error );
            }

            $error['success'] = 0;
            $error['info']    = '加入购物车失败！';
            return json_encode( $error );

        } else {
            //如果已存在，新提交的商品数量与redis中的商品数量相加
            $is_redis = json_decode( $redis_goods );
            $is_redis->num = $is_redis->num + $goods->num;
            //存入新的购物车商品信息
            $res = Redis::hset( 'user_id:'.$user_id, $is_redis->session_id, json_encode( $is_redis ) );
            // dd($is_redis);
            if ( $res == 0 ) {

                $error['success'] = 1;
                $error['info']    = '加入购物车成功！';
                return json_encode( $error );
            }

            $error['success'] = 0;
            $error['info']    = '加入购物车失败！';
            return json_encode( $error );

        }
    }
}
