<?php

namespace App\Http\Controllers\Admin;

use App\Models\GoodsAttr;
use App\Models\GoodsAttribute;
use App\Models\GoodsImages;
use App\Models\SpecGoodsPrice;
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
        $types = DB::table('goods_type')->get();
        return view('admin.main.goods.create', ['brands' => $brands, 'fatcates' => $fatcates, 'types' => $types]);
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function store(Request $request)
    {

        $data = $request->all();
//        dd($data);
        $goods = new Goods();

        //分类
        if(array_key_exists('cate_id_03', $data)){
            $cate = $data['cat_id'].'_'.$data['cat_id_02'].'_'.$data['cat_id_03'];

        } else if(array_key_exists('cat_id_02', $data)){
            $cate = $data['cat_id'].'_'.$data['cat_id_02'];
        } else {
            $cate = rtrim($data['cat_id'],'_');
        }
        $goods->cat_id = $cate;
        //编号
        if(!$data['goods_sn']){
            $goods->goods_sn = '8'.rand(10000,99999).date('Ymd');
        } else {
            $goods->goods_sn = $data['goods_sn'];
        }
        $goods->goods_name = $data['goods_name'];
        $goods->goods_remark = $data['goods_remark'];
        $goods->sku  = $data['sku'];
        $goods->brand_id = $data['brand_id'];
        $goods->market_price = $data['market_price'];
        $goods->cost_price = $data['cost_price'];
        $goods->shop_price = $data['shop_price'];
        $goods->original_img = $data['img'];
        $goods->store_count = $data['store_count'];
        $goods->keywords = $data['keywords'];
        $goods->goods_content = $data['goods_content'];
        //价格阶梯
        if($data['price_ladder']) {
            $price_ladder = $data['price_ladder'];
            $priladd = '';
            foreach ($price_ladder as $v) {
                $priladd .= $v.'_';
            }
            $goods->price_ladder = rtrim($priladd,'_');
        } else {
            $goods->price_ladder = 'Null';
        }
        if($goods->save()){
            $goods_id = $goods->goods_id;
            $type_id = $data['type_id'];
            //图片相册
            if($data['image_url']){
                $goods_images = new GoodsImages;
                $goods_images->image_url = $data['image_url'];
                $goods_images->goods_id = $goods_id;
                $goods_images->save();
            }
            if($type_id){
            //spec_goods_price 表
                if(array_key_exists('rose', $data)){
                    $spec_goods_price = new SpecGoodsPrice;
                    $spec_goods_price->goods_id = $goods_id;
                    $spec_goods_price->price = $data['price'];
                    $spec_goods_price->store_count = $data['attr_store_count'];
                    $spec_goods_price->sku = $data['attr_sku'];
                    $rose = $data['rose'];
                    $key = '';
                    foreach( $rose as $v){
                        $key .= $v.'_';
                    }
                    $keys = rtrim($key,'_');
                    $spec_goods_price->key = $keys;
                    $spec_goods_price->save();
                }

                //商品属性表goods_attr
                $goods_attrs = GoodsAttribute::where('type_id', '=', $type_id)->get();
                foreach ($goods_attrs as $goods_attr){
                    $attr_id_name = 'attr_'.$goods_attr->attr_id;
                    if(array_key_exists($attr_id_name, $data)){
                        $getAttr = $data[$attr_id_name];
                        foreach ($getAttr as $k => $v){
                            DB::table('goods_attr')->insert([
                                'goods_id'  => $goods_id,
                                'attr_id'   => $k,
                                'attr_value'=> $v,
                                'attr_price'=> '0'
                            ]);
                        }
                    }

                }
             }
//            return redirect()->route('admin.goods');
            return '成功';
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
