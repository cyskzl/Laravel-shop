<?php

namespace App\Http\Controllers\Home;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Goods;
use App\Models\GoodsTag;
use App\Models\Spec;
use App\Models\SpecGoodsPrice;
use App\Models\SpecItem;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GoodController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 商品列表页
     */
    public function goodsList(Request $request)
    {
        $cateId = $request->session()->get('Index');

        //标签
//        $tags = GoodsTag::all();
        $array = [];
//        foreach($tags as $tag){
//
////            $arrcom = explode('_',$tag->cate_id);
//            //2下标为3级id，在查数据库
//
//            $arr = Category::where('id','=',$arrcom[2])->get();
//            $array[] = $arr;
//        }
        $tags = Category::select(DB::raw('goods_category.*,goods_tag.*'))
            ->join('goods_tag', 'goods_tag.three_cate_id', '=', 'goods_category.id')
            ->get();
        dump($tags);

        return view('home.goods.list', ['cateId' => $cateId , 'tags' =>$tags]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 最新商品列表页
     */
    public function goodsProduct()
    {
        return view('home.goods.product');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 商品详情页
     */
    public function goodsDetail(Request $request,$goods_id)
    {
        $cateId = $request->session()->get('Index');

        $goodinfo = Goods::find($goods_id);
//        dd($goodinfo);
        $type_id = $goodinfo->goods_type;

        $brand_id = $goodinfo->brand_id;

        $brand = Brand::where('id',$brand_id)->pluck('name')->toArray();

        $spec = Spec::where('type_id',$type_id)->pluck('name','id');

        $spec_key = SpecGoodsPrice::where('goods_id',$goods_id)->get();
//        dd($spec_key);
//        dd($spec_key[0]->key);
        $one_key = explode('_',$spec_key[0]->key)[0];

        $key1_info = SpecGoodsPrice::where('goods_id',$goods_id)->where('key','like',$one_key.'_%')->pluck('key');
//        dd($key1_info);
//        dd($first_key);
        foreach($key1_info as $key2){
            $two_key[] = explode('_',$key2)[1];
        }
//        dd($two_key);
//        foreach($spec_key as $key){
//            $good_key = explode('_',$key->key);
//        }
        $specdetali = Spec::select(DB::raw('spec.*, spec_item.spec_id, group_concat(spec_item.item) AS specitem , group_concat(spec_item.id) AS specid'))
        ->join('spec_item', 'spec.id', '=', 'spec_item.spec_id')
        ->where('type_id','=',$type_id)
        ->groupby('spec.name')
        ->get();
        foreach($specdetali as $k=>$detail){
            $spec_name[$k] = $detail->name;
            $spec_item[$k] = explode(',',$detail->specitem);
            $spec_id[$k] = explode(',',$detail->specid);
        }

//        dump($spec_name);
//        dump($spec_item);
//        dd($spec_id);
//        $specinfo = $goodinfo->specGoodsPrice;
//        foreach($specinfo as $spec_key){
//            $speckey[] = explode('_',$spec_key->key);
//            foreach($speckey as $key){
////                dump($key[0]);
////                $spec_info= ;
//                foreach($key as $k){
//                    $spec_item = SpecItem::find($k);
////                    dd($spec_item);
//
//                    $specAll = $spec_item->spec;
////                    dump($specAll);
////                    $specname[$] .= $specAll->name.':'.$spec_item->item;
//                }
//
//            }
//            $goodSpec[$goods_id][] = $spec_info."价格:".$spec_key->price;
//        }
//        dd(array_unique($goodSpec));
//        dump($spec_item);
//        dump($specinfo);
//        dump($spec_name);
//        dd($specitem);
//        dd($specinfo);
        return view('home.goods.details',compact('specdetali','goodinfo','brand','spec_name','spec_item','spec_id','two_key','cateId'));
    }

    /**
     * @param Request $request
     * @return mixed
     * 处理详情页的规格和价格的ajax请求
     */
    public function ajaxDetail(Request $request)
    {
        $goods_id = $request->input('goods_id');
        $key1 = $request->input('key1');
        $key2 = $request->input('key2');
        if(!empty($key1)){
            $keyinfo = SpecGoodsPrice::where('goods_id',$goods_id)->where('key','like',$key1.'_%')->pluck('key');
//            dump($keyinfo);
            foreach ($keyinfo as $k=>$v){
                $key[$k] = explode('_',$v)[1];
            }
            return $key;

        }
        if(!empty($key2)){
            $goodprice = SpecGoodsPrice::where('goods_id',$goods_id)->where('key',$key2)->pluck('price');

            return $goodprice[0];

        }
    }


//    public function shoppingCache(Request $request)
//    {
//        $goods_id = $request->input('goods_id');
//        $goods_name = $request->input('goods_name');
//        $specone = $request->input('specone');
//        $spectwo = $request->input('spectwo');
//        $num = $request->input('num');
//        $price = $request->input('price');
//        return $goods_name;
//    }
}
