<?php

namespace App\Http\Controllers\Admin;

use App\Models\GoodsAttribute;
use App\Models\GoodsImages;
use App\Models\Spec;
use App\Models\SpecGoodsPrice;
use App\Models\SpecImage;
use App\Models\GoodsAttr;
use DB;
use App\Models\Goods;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    /**
     * @return  view    商品列表页
     */
    public function index(Request $request)
    {
        //分页查询以keyword为搜索关键字
        $goods= Goods::orderBy('sort', 'desc')
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('goods_name','like','%'.$keyword.'%');
                }
            })->paginate(10);
        return view('admin.main.goods.index', ['request' => $request, 'goods' =>$goods ]);
    }

    /**
     * @return  view    商品添加页
     */
    public function create()
    {

        $fatcates   =  DB::table('goods_category')->where('pid', '=', '0')->select()->get();
        $brands  =  DB::table('brand')->select()->get();
        $types  =  DB::table('goods_type')->select()->get();
        $specitems  =  DB::table('spec_item')->select()->get();
        $specs  =  DB::table('spec')->select()->get();
        return view('admin.main.goods.create', ['brands' => $brands, 'fatcates' => $fatcates, 'types' => $types, 'specs' => $specs,'specitems' => $specitems]);
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $goods = new Goods;
        $goods->goods_name = $data['goods_name'];
        $goods->goods_remark = $data['goods_remark'];
        if(array_key_exists('goods_sn',$data)){
            $goods->goods_sn = $data['goods_sn'];
        } else {
            $goods->goods_sn = "8".rand(10000,999999).date('Ymd');
        }

        $goods->sku = $data['sku'];

        if(array_key_exists('cat_id_03', $data)){
            $cat_id = $data['cat_id'].'_'.$data['cat_id_02'].'_'.$data['cat_id_03'];

        }else if(array_key_exists('cat_id_02', $data)){
            $cat_id = $data['cat_id'].'_'.$data['cat_id_02'];

        } else {
            $cat_id =  $data['cat_id'];
        }
        $goods->cat_id = $cat_id;

        $goods->brand_id = $data['brand_id'];
        $goods->shop_price = $data['shop_price'];
        $goods->market_price = $data['market_price'];
        $goods->cost_price = $data['cost_price'];
        $goods->original_img = $data['img'];
        $goods->cost_price = $data['cost_price'];
        $goods->keywords = $data['keywords'];
        $goods->goods_content = $data['goods_content'];
        $goods->price_ladder = $data['price_ladder'][0].'_'.$data['price_ladder'][1];
        //商品添加
        if($goods->save()){
            $goods_id = $goods->goods_id;
            $goodsimages = new GoodsImages;

            //加入图片表
            if($data['image_url']){
                $goodsimages->goods_id = $goods_id;
                $goodsimages->image_url = $data['image_url'];
                $goodsimages->save();
            }
            if($data['type_id']){
                //商品规格
                if(array_key_exists('rose',$data)){
                    $rose = $data['rose'];
                    $key = '';
                    foreach ($rose as $v){
                        $key .= $v.'_';
                    }
                    $goods_key = rtrim($key,'_');
                    $spec_goods_price = new SpecGoodsPrice;
                    $spec_goods_price->goods_id = $goods_id;
                    $spec_goods_price->key = $goods_key;
                    $spec_goods_price->price = $data['price'];
                    $spec_goods_price->sku = $data['attr_sku'];
                    $spec_goods_price->store_count = $data['attr_store_count'];
                    $spec_goods_price->save();
                }

                //商品属性
                $goodsattributes  = GoodsAttribute::where('type_id', '=', $data['type_id'])->get();
                foreach($goodsattributes as $goodsattribute){
                    $goodsattr = 'attr_'.$goodsattribute->attr_id;

                    if(array_key_exists($goodsattr,$data)){
                        $attr = $data[$goodsattr];
                        foreach ($attr as $k=>$v){
                            GoodsAttr::insert([
                                'goods_id'  =>$goods_id ,
                                'attr_id'  =>$k,
                                'attr_value'=> $v,

                            ]);
                        }
                    }

                }
            }
            return '添加成功';
        } else {
            return back();
        }

    }

    /**
     * @return  view    商品修改页
     */
    public function edit()
    {
        return view('admin.main.goods.edit');
    }

    /**
     * update   更新修改操作
     *
     * @param   $request    array   获取请求头信息
     *
     * @return  未定义
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * destroy  商品删除
     *
     * @param   $request    array   获取请求头信息
     *
     */
    public function destroy(Request $request)
    {
        //删除id
    }




}
