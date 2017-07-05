<?php

namespace App\Http\Controllers\Admin;


use App\Models\Brand;
use App\Models\Category;
use App\Models\GoodsAttr;
use App\Models\GoodsAttribute;
use App\Models\GoodsImages;
use App\Models\GoodsTag;
use App\Models\GoodsType;
use App\Models\SpecGoodsPrice;
use App\Models\TagMiddleGoods;
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
        $typeinfos = GoodsType::select('id', 'name')->get();

        $brands = Brand::select()->get();
        //分页查询以keyword为搜索关键字
        $goods= Goods::orderBy('sort', 'desc')
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('goods_name','like','%'.$keyword.'%');
                }
                //分类检索
                $typename = $request->input('typename');
                if (!empty($typename)) {
                    $query->where('type_id', 'like', '%' . $typename . '%');
                }
                //品牌检索
                $brand= $request->input('brandslect');
                if (!empty($brand)) {
                    $query->where('brand_id', 'like', '%' . $brand . '%');
                }

            })->paginate(10);
        return view('admin.main.goods.index', ['request' => $request, 'brands' => $brands ,'goods' =>$goods, 'typeinfos' => $typeinfos ]);
    }

    /**
     * @return  view    商品添加页
     */
    public function create()
    {
        $tags = GoodsTag::all();
        $fatcates   =  Category::where('pid', '=', '0')->select()->get();
        $brands  =  Brand::select()->get();
        $types = GoodsType::select()->get();
        return view('admin.main.goods.create', ['tags' => $tags,'brands' => $brands, 'fatcates' => $fatcates, 'types' => $types]);
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function store(Request $request)
    {

        $data = $request->all();
//        dd($data['image_url']);
        $goods = new Goods();

        //3级分类不能为空
        if(!empty($data['cat_id_03'])){
                if($data['cat_id_03'] !== ''){
                    //拼接
                    $cate = $data['cat_id'].'_'.$data['cat_id_02'].'_'.$data['cat_id_03'];
                }
        } else if(!empty($data['cat_id_02'])){
            //2级分类不能为空
                if($data['cat_id_02'] !== ''){
                    $cate = $data['cat_id'].'_'.$data['cat_id_02'];
                }
        } else {
            $cate = $data['cat_id'];
        }
//        dd($cate);
        //赋值
        $goods->cat_id = $cate;
        //编号如果用户不写则自动生成
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
        $goods->goods_type = $data['type_id'];
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
        //商品添加
        if($goods->save()){
            //获取商品goods_id
            $goods_id = $goods->goods_id;
            $type_id = $data['type_id'];
            $tags = $data['tag_id'];
           if(!empty($tags)){
               $goods->tags()->sync($tags);
           }
            //图片相册
            if(!empty($data['image_url'])){
                $data['image_url'];
                $goods_images = new GoodsImages;
                $goods_images->image_url = $data['image_url'];
                $goods_images->goods_id = $goods_id;
                $goods_images->save();
            }
            //用户必须选择了模型才能添加
            if($type_id){
            //spec_goods_price 表 添加商品模型表
                if(array_key_exists('rose', $data)){
                    $spec_goods_price = new SpecGoodsPrice;
                    $spec_goods_price->goods_id = $goods_id;
                    $spec_items = $data['items'];
                    //商品规格添加
                    foreach ($spec_items as $k => $v){
                       //$k  为key值
                        foreach ($v as $key => $value){
                            //库错的key值与价格的key值一样
                            $store_count = $data['it'][$k]["store_count"];
                                //执行添加
                            DB::table('spec_goods_price')->insert([
                                'key'  => $k,
                                'price'   => $value,
                                'goods_id'=> $goods_id,
                                'store_count'=> $store_count
                            ]);
                        }
                    }
                }

                //商品属性表goods_attr，先获取用户选择的模型下的属性数据
                $goods_attrs = GoodsAttribute::where('type_id', '=', $type_id)->get();
                foreach ($goods_attrs as $goods_attr){
                    //获取表单提交过来的name名称
                    $attr_id_name = 'attr_'.$goods_attr->attr_id;
                    //接收过来的值中存在的话
                    if(array_key_exists($attr_id_name, $data)){
                        //获取提交的数据
                        $getAttr = $data[$attr_id_name];
                        //遍历表单提交的数组
                        foreach ($getAttr as $k => $v){
                            //$k 为attr_id  $v为值
                            //执行添加
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
    public function edit($id)
    {
        $good = Goods::select()->find($id);
        $spec_goods_price = SpecGoodsPrice::where('goods_id', '=', $id)->first();
        if (!$good){
            return abort('404');
        }

        $cat_id = explode('_', $good->cat_id);
        //0就是最大的分类id   1  2级分类  2  3级分类
//        if($cat_id[1]){
//            $max_cat = Category::where('level', '=','0,'.$cat_id[0], 'and', 'pid', '=', $cat_id[0])->get();
////            dd($max_cat);
//        }
//        dd($cat_id);
        $fatcates   =  Category::where('pid', '=', '0')->select()->get();
        $brands  =  Brand::select()->get();
        $types = GoodsType::select()->get();
//        $key = $spec_goods_price->key;
        return view('admin.main.goods.edit', ['brands' => $brands, 'fatcates' => $fatcates, 'types' => $types, 'good' => $good ] );
//        return view('admin.main.goods.edit', ['brands' => $brands, 'fatcates' => $fatcates, 'types' => $types, 'good' => $good , 'key' => $key] );
    }

    /**
     * update   更新修改操作
     *
     * @param   $request    array   获取请求头信息
     *
     * @return  未定义
     */
    public function update(Request $request, $id)
    {
        dd($request->all());
    }

    /**
     * destroy  商品删除
     *
     * @param   $request    array   获取请求头信息
     *
     */
    public function destroy(Request $request, $id)
    {
        //id在的话
        if ($id) {
            //在删除与goods表关联的表
            $goods = Goods::find($id);
            //获取与goods表关联的images表数据
            $goodImages = $goods->goodImages()->first();
            //获取与goods表关联的attr属性表数据
            $goodsAttr = $goods->goodAttr()->get();
            //获取与goods表关联的attr属性表数据
            $specGoodsPrice = $goods->specGoodsPrice()->get();

            if(!empty($goods)){
                    //删除与标签管关联的表
                    TagMiddleGoods::where('goods_id', '=', $goods->goods_id)->delete();

                //同时删除数据
                //删除spec_goods_price数据
                if(!empty($specGoodsPrice)){
                    foreach($specGoodsPrice as $v){
                        SpecGoodsPrice::destroy($v['id']);
                    }
                }
                //goods_attr
                if(!empty($goodsAttr)){
                    foreach($goodsAttr as $v){
                        GoodsAttr::destroy($v['goods_attr_id']);
                    }
                }
                //删除图片在删除数据
                if(!empty($goodImages)){
                    if($goodImages->image_url){
                        $delcomma = rtrim($goodImages->image_url,',');
                        //清除左边符号
                        $imgarr = explode(',', $delcomma);
                        foreach ($imgarr as $k => $v){
                            //删除img的所有图
                            $imagepath = '.'.$v;
                            @unlink($imagepath);
                        }
                   }
                    $goodImages->delete();
                }
                //最后删除goods表
                //删除goods表单图片
                if(!empty($goods->original_img)){
                    $delgoodsimg = rtrim($goods->original_img, ',');
                    @unlink('.'.$delgoodsimg);
                }
                if( $goods->delete()){
                    $data = [
                        'status' => 1,
                        'msg'   => '删除成功',
                    ];
                } else {
                    $data = [
                        'status' => 0,
                        'msg'   => '删除失败',
                    ];
                }
            } else {
                $data = [
                    'status' => 2,
                    'msg'   => '删除失败,请刷新重试',
                ];
            }
        } else {
            $data = [
                'status' => 2,
                'msg'   => '删除失败,请刷新重试',
            ];
        }
        return $data;
    }
    public function show(){}

}
