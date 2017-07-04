<?php

namespace App\Http\Controllers\Home;

use App\Models\Category;
use App\Models\Goods;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index( Request $request,$category_id=1)
    {
//        return $category_id;
        //获取后缀的id 1, 女士默认，2男士,3 生活

        $cateId = $category_id;

        //获取女士 id=1
        $onemaam = self::oneTree(1);
        //获取女士下的2级分类
        $twomaan =  self::twoTree(1);
//        dd($twomaan);
//        dd($twomaan);
        //获取女士s 的3级分类
        $threemaan = self::threeTree(1);

        //获取男士 id=2
        $onemam = self::oneTree(2);

        $twomam =  self::twoTree(2);


        $threeman = self::threeTree(2);
        //获取生活 id=3
        $onelife = self::oneTree(3);

        $twolife = self::twoTree(3);

        $threelife = self::threeTree(3);

        $goodsmaams = Goods::where('is_new', '=', '1')->where( 'cat_id', 'like', '1%')->orderBy('goods_id','desc')->take(6)->get();

        //男士新品
        $goodsmams = Goods::where('is_new', '=', '1')->where( 'cat_id', 'like', '2%')->orderBy('goods_id','desc')->take(6)->get();

        //生活新品
        $goodslife= Goods::where('is_new', '=', '1')->where( 'cat_id', 'like', '3%')->orderBy('goods_id','desc')->take(6)->get();


        return view('home.index', [

            'goodsmaams' => $goodsmaams,
            'goodsmams' => $goodsmams,
            'goodslife' => $goodslife,
            'cateId' => $cateId,
            'onelife' => $onelife ,
            'twolife' => $twolife ,
            'threelife '=> $threelife ,
            'onemaam' => $onemaam ,
            'twomaan' =>$twomaan ,
            'threemaan' =>$threeman,
            'onemam' => $onemam ,
            'twoman' =>$twomam ,
            'threeman' =>$threeman,

        ]);

    }

    public function oneTree ($id)
    {
        //获取女士 id=1
        $data =  Category::where('id', '=', $id )->first();
        return $data;

    }

    public function twoTree ($id)
    {

        //获取女士下的2级分类
        $twodata =  Category::where('level', '=', '0,'.$id)->get();
        return $twodata;
    }

    public function threeTree ($pid)
    {

        //获取女士的3级分类
        $threedata = Category::where('pid' , '=' , $pid)->get();
        return $threedata;
    }

    public function getAjaxNewTree($cateId)
    {
        //获取新品商品  1是新品  0不是
        $newgoods = Goods::where('is_new', '=', '1')->where('cat_id', 'like', $cateId.'%')->orderBy('goods_id','desc')->take(6)->get();
        return $newgoods;

    }

    public function getAjaxCatetree($maxId, $pid, $cateId)
    {
        //查询这个分类下的商品，4个
        $goods = Goods::where('cat_id', 'like', $maxId.'_'.$pid.'%')->orderBy('goods_id','desc')->take(4)->get();

        $brand = [];

        if($cateId == 1 || $cateId = ''){

            $newgoods = self::getAjaxNewTree($cateId);

            //男士
        } else if($cateId == 2){

            $newgoods = self::getAjaxNewTree($cateId);

        } else {

            $newgoods = self::getAjaxNewTree($cateId);

        }
        //新品
        foreach ($goods as $good){
            $brand[] = getBrand($good->brand_id);
        }
        $data =   [
            //分类信息
            'cate'    => self::threeTree($pid),
            //商品信息
            'goods'    => $goods,
            //匹配名称
            'brand'    => $brand,
            //商品新品
            'newgoods' => $newgoods
        ];
        return $data;
    }

    public function getAjaxCate(Request $request)
    {
            //接收的2级id
            $pid = $request->input('pid');

            //获取后缀的id 1, 女士默认，2男士,3 生活
            $cateId = $request->input('cate_id');
//    dd($pid);
            //女士
            if($cateId == 1 || $cateId = ''){

                $data = self::getAjaxCatetree('1', $pid, $cateId);

              //男士
            } else if($cateId == 2){
                echo '123';
                $data = self::getAjaxCatetree('2', $pid, $cateId);

            } else {

                $data = self::getAjaxCatetree('3', $pid, $cateId);

            }
           return $data;
    }

    public function newgoods()
    {

    }
}
