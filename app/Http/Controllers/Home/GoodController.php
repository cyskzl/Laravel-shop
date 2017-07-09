<?php

namespace App\Http\Controllers\Home;

use App\Models\Brand;
use App\Models\Category;
use App\Models\CateMiddleGoods;
use App\Models\Goods;
use App\Models\GoodsAttr;
use App\Models\GoodsTag;
use App\Models\GoodsType;
use App\Models\Spec;
use App\Models\SpecGoodsPrice;
use App\Models\SpecItem;
use App\Models\TagMiddleGoods;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class GoodController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 商品列表页
     */
    public function goodsList(Request $request)
    {
        $cateId = $request->session()->get('Index');

        $cate = $request->route('category_id');
        //2级分类
        $twocate = $request->get('cate');

        //广告
        $advertisement = self::advertisement();
//        dd($twocate);
        //女士
        if($cateId == 1){

            //判断是否是2级或者3级
            //新品
            if($twocate == '3' || $twocate == '4'){

                $goods = self::newGoods($cateId);

            }else if(!empty($twocate)){
                //2级走这个
                $goods = self::goodsTwo($cateId, $cate);

            }  else {
                //3级走这里
                $goods = self::goodsTree($cateId, $cate );

            }

            //实例化标签
            $tags = self::tagsTree($cateId);
            //拿到标签下所有的3级分类
            $goodsCatName = self::goodsCatName($tags);
            //拿到标签下所有的3级分类id
            $goodsCatId = self::goodsCatId($tags);

//            dd($advertisement);

        } else {
            //实例化导航栏下的商品
            //判断是否是2级或者3级
            //新品
            if($twocate == '3' || $twocate == '4'){

                $goods = self::newGoods($cateId);

            }else if(!empty($twocate)){
                //2级走这个
                $goods = self::goodsTwo($cateId, $cate);

            }  else {
                //3级走这里
                $goods = self::goodsTree($cateId, $cate );

            }
            //实例化标签
            $tags = self::tagsTree($cateId);
            //拿到标签下所有的3级分类
            $goodsCatName = self::goodsCatName($tags);
            //拿到标签下所有的3级分类id
            $goodsCatId = self::goodsCatId($tags);

//            dd($advertisement);

        }

        return view('home.goods.list', [

                    'request'           => $request
                    ,'cateId'           => $cateId
                    ,'tags'             =>$tags
                    ,'goods'            => $goods
                    ,'goodsCatId'       => $goodsCatId
                    ,'goodsCatName'     => $goodsCatName
                    ,'advertisement'    => $advertisement
        ]);
    }
    /**
     * 广告
     * @param $cateId
     * @return mixed
     */
    public function advertisement()
    {
        $advertisement = Advertisement::where('is_display', '=', '1')->get();
        return $advertisement;
    }
    /**
     * 新品所有商品
     * @param $cateId
     * @return mixed
     */
    public function newGoods($cateId)
    {
        $goods = Goods::where('is_new', '=', '1')->where('cat_id', 'like', $cateId.'%' )->orderBy('sales_sum', 'desc')->paginate(20);
        return $goods;
    }

    /**
     * 2级分类下的商品
     * @param $cateId 男士女士
     * @param $cate 2级的id
     * @return mixed 返回查询的商品数据
     */
    public function goodsTwo($cateId, $cate)
    {

        //查询导航下的商品
        $goods = TagMiddleGoods::join('goods', 'tags_middle_goods.goods_id', '=', 'goods.goods_id')
            ->where('goods.cat_id', 'like', $cateId.'_'.$cate.'_%')
            ->join('goods_tag', 'goods_tag.tag_id', '=', 'tags_middle_goods.tags_id')
            ->paginate(20);

        return $goods;
    }

    /**
     * 返回标签3级下的商品或导航的3级商品
     * @param $cateId  判断是男是女
     * @param $twocate 2级的id
     * @return mixed   查询出的商品
     */
    public function goodsTree($cateId, $twocate)
    {
        //查询导航下的商品
        $goods = TagMiddleGoods::join('goods', 'tags_middle_goods.goods_id', '=', 'goods.goods_id')
            ->where('goods.cat_id', 'like', $cateId.'_'.'%'.$twocate)
            ->join('goods_tag', 'goods_tag.tag_id', '=', 'tags_middle_goods.tags_id')
            ->paginate(20);
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
        // 商品所属分类（面包屑导航）
        $goodcat = explode('_',$goodinfo->cat_id);
        foreach ($goodcat as $k=>$cat){
            $cat_name[$k] = Category::where('id',$cat)->pluck('name')->first();
        }

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

        foreach ($spec_key as $k=>$v){
            $key_team[$k] = explode('_',$v->key);
        }

        $one_key = explode('_',$spec_key[0]->key)[0];

        // 通过上述的第一个商品规格项，通过模糊查询得到第一个规格对应的下一规格项
        $key1_info = SpecGoodsPrice::where('goods_id',$goods_id)->where('key','like',$one_key.'_%')->pluck('key');

        // 通过遍历获取得到商品的第一个规格项的下一规格项的所有信息
        foreach($key1_info as $key2){
            $two_key[] = explode('_',$key2)[1];
        }
        // 商品属性
        $goodattr = GoodsAttr::where('goods_id',$goods_id)->leftjoin('goods_attribute','goods_attr.attr_id','=','goods_attribute.attr_id')->select('goods_attribute.attr_name','goods_attr.attr_value')->get();

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

        if( !in_array($one_key,$spec_id[0])){
            rsort($spec_name);
            rsort($spec_item);
            rsort($spec_id);
        }

        foreach($key_team as $k=>$key1){
            if(in_array($key1[0],$spec_id[0])){
                $key_one[$k] = $key1[0];
            }
        }
        $key_one = array_unique($key_one);

        //商品推荐
        //女士
        if($cateId == 1){
            $recommend = self::recommend($cateId);

        } else {
            //男士
            $recommend = self::recommend($cateId);
        }
        return view('home.goods.details',compact('recommend','goods_id', 'specdetali','goodinfo','brand','spec_name','spec_item','spec_id','two_key','goodattr','key_one','cat_name','cateId'));
    }

    /**
     * 详情页的商品推荐
     * @param $cateId 男士女士id
     * @return mixed 查数据的数据
     */
    public function recommend($cateId)
    {
        $recommend = Goods::where('is_recommend', '=', '1')->where('cat_id', 'like', $cateId.'%')->take(6)->get();
        return $recommend;
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
//            dd($keyinfo);
            if(count($keyinfo)==0){
               $msg = [
                   'status' => 1,
               ];
                return $msg;
            }else {
                foreach ($keyinfo as $k => $v) {
                    $key[$k] = explode('_', $v)[1];
                }
                return $key;
            }

        }
        // key2（32_23）存在,则需要获取商品的价格
        if(!empty($key2)){
            $goodprice = SpecGoodsPrice::where('goods_id',$goods_id)->where('key',$key2)->pluck('price');
            // 返回价格
            return $goodprice[0];

        }
    }

}
