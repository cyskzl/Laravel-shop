<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;

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
            $onemaam = self::oneTree(1);
            //获取女士下的2级分类
            $twomaan =  self::twoTree(1);

            //获取男士 id=2
            $onemam = self::oneTree(2);

            $twomam =  self::twoTree(2);

            $view->with('onemaam', $onemaam);
            $view->with('twomaan', $twomaan);
            $view->with('onemam', $onemam);
            $view->with('twomam', $twomam);


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
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
