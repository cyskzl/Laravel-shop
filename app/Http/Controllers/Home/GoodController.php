<?php

namespace App\Http\Controllers\Home;

use App\Models\Brand;
use App\Models\Category;
use App\Models\CateMiddleGoods;
use App\Models\Goods;
use App\Models\GoodsTag;
use App\Models\Spec;
use App\Models\SpecGoodsPrice;
use App\Models\SpecItem;
use App\Models\TagMiddleGoods;
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
        //2级分类
        $twocate = $request->route('category_id');
        dump($twocate);
        //标签
        if($cateId == 1){
            //女士
            //实例化导航栏下的商品
            $goods = self::goodsTree($cateId, $twocate );
            //实例化标签
            $tags = self::tagsTree($cateId);
            //拿到标签下所有的3级分类
            $goodsCatName = self::goodsCatName($tags);
            //拿到标签下所有的3级分类id
            $goodsCatId = self::goodsCatId($tags);


        } else {
            //实例化导航栏下的商品
            $goods = self::goodsTree($cateId, $twocate );
            //实例化标签
            $tags = self::tagsTree($cateId);
            //拿到标签下所有的3级分类
            $goodsCatName = self::goodsCatName($tags);
            //拿到标签下所有的3级分类id
            $goodsCatId = self::goodsCatId($tags);

        }

        return view('home.goods.list', ['cateId' => $cateId , 'tags' =>$tags, 'goods' => $goods,'goodsCatId' => $goodsCatId ,'goodsCatName' => $goodsCatName]);
    }
    /**
     * 返回导航下的商品
     * @param $cateId  判断是男是女
     * @param $twocate 2级的id
     * @return mixed   查询出的商品
     */
    public function goodsTree($cateId, $twocate)
    {
        //查询导航下的商品
        $goods = TagMiddleGoods::join('goods', 'tags_middle_goods.goods_id', '=', 'goods.goods_id')
            ->where('goods.cat_id', 'like', $cateId.'_'.'%'.$twocate)
            ->join('goods_tag', 'goods_tag.tag_id', '=', 'tags_middle_goods.tags_id')->get();
        return $goods;
    }
    /**
     *  所有标签和标签下的分类
     * @param $cateId 判断是男是女
     * @return mixed 返回所有标签和标签下的分类
     */
    public function tagsTree($cateId)
    {
        //归类3级标签
        $tags = CateMiddleGoods::select(DB::raw('goods_tag.tag_name,group_concat(cate_middle_goods.cate_id) AS goodsCatId,cate_middle_goods.tags_id,goods_category.id,goods_category.pid,goods_category.level,group_concat(goods_category.name) AS goodsCatName'))
            ->where('level', 'like', '0,'.$cateId.'%')
            ->groupby('goods_tag.tag_name')
            ->join('goods_category', 'cate_middle_goods.cate_id', '=', 'goods_category.id')
            ->join('goods_tag', 'goods_tag.tag_id', '=', 'cate_middle_goods.tags_id')
            ->get();
        return $tags;
    }
    /**
     * 所有的标签分类
     * @param $tags
     * @return array
     */
    public function goodsCatName($tags)
    {
        $arr = [];
        //将分类名称和对应的id加入标签下
        foreach($tags as $tag){
            //拆分
            $arr[] = explode( ',',$tag->goodsCatName);
        }
        return $arr;
    }

    /**
     * 所有的标签分类的id
     * @param $tags
     * @return array
     */
    public function goodsCatId($tags)
    {
        $array = [];
        //将分类名称和对应的id加入标签下
        foreach($tags as $tag){
            //拆分
            $array[] = explode(',',$tag -> goodsCatId);
        }
        return $array;
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
        // 页面分类id，区分所属顶级分类
        $cateId = $request->session()->get('Index');

        // 获取商品详细信息，便于详情页以及查找规格价格，属性
        $goodinfo = Goods::find($goods_id);

        // 获取商品的类型id，用于获取商品规格项（颜色、尺寸。。）
        $type_id = $goodinfo->goods_type;

        // 获取品牌id，用于查找商品品牌信息
        $brand_id = $goodinfo->brand_id;

        // 获取商品品牌信息，用于详情页展示
        $brand = Brand::where('id',$brand_id)->pluck('name')->toArray();

//        // 通过商品的类型id，获取商品的规格名与规格id，用于查找商品价格
//        $spec = Spec::where('type_id',$type_id)->pluck('name','id');

        // 通过商品ID获取商品的所有规格项
        $spec_key = SpecGoodsPrice::where('goods_id',$goods_id)->get();

        // 拆分规格项值，用于详情页的第一列的规格展示，并且判断商品此规格项对应下的商品规格项有几个规格
        $one_key = explode('_',$spec_key[0]->key)[0];

        // 通过上述的第一个商品规格项，通过模糊查询得到第一个规格对应的下一规格项
        $key1_info = SpecGoodsPrice::where('goods_id',$goods_id)->where('key','like',$one_key.'_%')->pluck('key');

        // 通过遍历获取得到商品的第一个规格项的下一规格项的所有信息
        foreach($key1_info as $key2){
            $two_key[] = explode('_',$key2)[1];
        }

        // 通过商品的类型ID得到该商品的类型对应的所有规格项
        $specdetali = Spec::select(DB::raw('spec.*, spec_item.spec_id, group_concat(spec_item.item) AS specitem , group_concat(spec_item.id) AS specid'))
        ->join('spec_item', 'spec.id', '=', 'spec_item.spec_id')
        ->where('type_id','=',$type_id)
        ->groupby('spec.name')
        ->get();

        // 拆分规格项的信息，得到规格名spec_name、规格值spec_item,规格id
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
        // 商品ID
        $goods_id = $request->input('goods_id');
        // 商品规格的key（如：32_20里的32）
        $key1 = $request->input('key1');
        // 商品规格的看key（全拼）
        $key2 = $request->input('key2');
        // 通过请求不同的key值得到所需的数值
        // 32_23
        // key1存在，说明需要查找对应的key1（32）的商品有有哪些key2（23.。。）
        if(!empty($key1)){
            $keyinfo = SpecGoodsPrice::where('goods_id',$goods_id)->where('key','like',$key1.'_%')->pluck('key');
            // 遍历拆解key值
            foreach ($keyinfo as $k=>$v){
                $key[$k] = explode('_',$v)[1];
            }
            return $key;

        }
        // key2（32_23）存在,则需要获取商品的价格
        if(!empty($key2)){
            $goodprice = SpecGoodsPrice::where('goods_id',$goods_id)->where('key',$key2)->pluck('price');
            // 返回价格
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
