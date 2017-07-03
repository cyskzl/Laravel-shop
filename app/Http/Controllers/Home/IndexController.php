<?php

namespace App\Http\Controllers\Home;

use App\Models\Category;
use App\Models\Goods;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index($category_id = 1 , Request $request)
    {
        //获取后缀的id 1, 女士默认，2男士,3 生活
        $cateId = $request->route('category_id');

        //获取最大的分类
        $onecates = Category::where('pid', '=', '0')->get();
        //获取女士 id=1
        $onemaam = self::oneTree(1);
        //获取女士下的2级分类
        $twomaan =  self::twoTree(1);

        //获取女士s 的3级分类
        $threemaan = self::threeTree(1);
        //2级
        $arr = [];
        foreach ($twomaan as $v){
            $twoid = $v->id;
            $twogoods = Goods::where('cat_id', 'like', '%'.$twoid.'%')->get();
            $arr[] = $twogoods ;
//            dump($twogoods);
        }

        $arr = array_unique($arr);
        dump($arr);

        //获取男士 id=2
        $onemam = self::oneTree(2);

        $twomam =  self::twoTree(2);

        $threeman = self::threeTree(2);
        //获取生活 id=3
        $onelife = self::oneTree(3);

        $twolife = self::twoTree(3);

        $threelife = self::threeTree(3);

        //新品  0 不是 1是 //女士
        $goodsmaams = Goods::where('is_new', '=', '1')->where( 'cat_id', 'like', '1%')->orderBy('goods_id','desc')->take(6)->get();

        //男士新品
        $goodsmams = Goods::where('is_new', '=', '1')->where( 'cat_id', 'like', '2%')->orderBy('goods_id','desc')->take(6)->get();

        //生活新品
        $goodslife= Goods::where('is_new', '=', '1')->where( 'cat_id', 'like', '3%')->orderBy('goods_id','desc')->take(6)->get();

        //2级下的商品
        $goodstwomaams = Goods::where( 'cat_id', 'like', '1_%_')->orderBy('goods_id','desc')->take(6)->get();

        $goodsModel = new Goods();

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
                                'threemaan' =>$threemaan,
                                'onemam' => $onemam ,
                                'twoman' =>$twomam ,
                                'threeman' =>$threeman,
                                'arr' =>$arr,
                                'goodsModel'=>$goodsModel,
                                'goodstwomaams' => $goodstwomaams

            ]);
    }
    public function commonMethod()
    {

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
    public function threeTree ($id)
    {

        //获取女士的3级分类
        $threedata = Category::where('level' , 'like' , '0,'.$id.',%')->get();
        return $threedata;
    }

    public function catalog($id, Request $request)
    {
        $cateId = $request->route('id');
        dd($cateId);
    }
}
