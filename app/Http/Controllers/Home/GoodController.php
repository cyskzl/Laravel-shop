<?php

namespace App\Http\Controllers\Home;

use App\Models\Brand;
use App\Models\Goods;
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
    public function goodsList()
    {
        return view('home.goods.list');
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
    public function goodsDetail($goods_id)
    {
        $goodinfo = Goods::find($goods_id);
//        dd($goodinfo);
        $type_id = $goodinfo->goods_type;

        $brand_id = $goodinfo->brand_id;

        $brand = Brand::where('id',$brand_id)->pluck('name')->toArray();

        $spec = Spec::where('type_id',$type_id)->pluck('name','id');
//        dd($spec);

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
        return view('home.goods.details',compact('specdetali','goodinfo','brand','spec_name','spec_item','spec_id'));
    }

    public function ajaxDetail(Request $request)
    {
        $goods_id = $request->input('goods_id');
        $key1 = $request->input('key1');
        $key2 = $request->input('key2');
        if(!empty($key1)){
            $keyinfo = SpecGoodsPrice::where('goods_id',$goods_id)->where('key','like',$key1.'_%')->pluck('key');
            foreach ($keyinfo as $k=>$v){
                $key[$k] = trim($v,$key1.'_');
            }
            return $key;

        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 购物车页
     */
    public function shopCart()
    {
        return view('home.goods.shopCart');
    }
}
