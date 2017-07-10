<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Redis;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 使用闭包型态的视图组件...
        view()->composer('*', function ($view) {

            //获取女士 id=1
            $onemaam   = self::oneTree(1);
            //获取女士下的2级分类
            $twomaan   =  self::twoTree(1);

            //获取男士 id=2
            $onemam    = self::oneTree(2);

            $twomam    =  self::twoTree(2);

            //统计购物车商品数量
            $cartCount = self::cartCount();
            //用户信息
            $user      = self::userInfo();

            $view->with('user', $user);
            $view->with('onemaam', $onemaam);
            $view->with('twomaan', $twomaan);
            $view->with('onemam', $onemam);
            $view->with('twomam', $twomam);
            $view->with('cartCount', $cartCount);



        });
    }
    /**
     * 获取1级分类
     * @param $pid
     * @return mixed
     */
    public function oneTree ($id)
    {
        //获取女士 id=1
        $data =  Category::where('id', '=', $id )->first();
        return $data;

    }

    /**
     * 获取2级分类
     * @param $pid
     * @return mixed
     */
    public function twoTree ($id)
    {

        //获取女士下的2级分类
        $twodata =  Category::where('level', '=', '0,'.$id)->get();
        return $twodata;
    }

    /**
     * 获取3级分类
     * @param $pid
     * @return mixed
     */
    public function threeTree ($pid)
    {
        //获取女士的3级分类
        $threedata = Category::where('pid' , '=' , $pid)->get();
        return $threedata;
    }

    /**
     * 统计购物车商品数量
     *
     * @return int
     */
    public function cartCount()
    {
        if ( Auth::check() ) {

            $cartCount = Redis::hlen( 'user_id:'.Auth::user()->user_id );
            return $cartCount;
        }

        if ( !empty( $_SESSION['goods_shop'] ) ) {

            $session_count = count($_SESSION['goods_shop']);
            return $session_count;
        }

        return 0;

    }

    /**
     * 获取用户信息
     *
     * @return mixed
     */
    public function userInfo() {

        if ( Auth::check() ) {
            $user = Userinfo::where('user_id', '=', \Auth::user()->user_id)->first();
            return $user;
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
