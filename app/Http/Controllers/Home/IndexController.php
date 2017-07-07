<?php

namespace App\Http\Controllers\Home;

use App\Models\GoodsTabCate;
use Illuminate\Support\Facades\DB;
use App\Models\Carousel;
use App\Models\Goods;
use App\Http\Requests;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;


class IndexController extends Controller
{
    public function search()
    {
        $xs = new \XS('goods');
        $search = $xs->search;

    }

    /**
     * 返回给前台首页的数据
     * @param Request $request
     * @param int $category_id 路由默认值为1，为女的，2为男的
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homeIndex( Request $request)
    {
//        $cateId = $category_id;

        $cateId = Input::get('categoryId');

        //获取后缀的id 1, 女士默认，2男士,
       if($cateId == '1'){

           $request->session()->set('Index', '1');
           //轮播图
           $carousel =  self::carousel($cateId);
           //最新产品
           $newest = self::newest($cateId);

           //分类
//           $hotgoods = Goods::select()->where('is_hot', '=', '1', 'and','like','cat_id',$cateId.'_%_%')->get();

//           $goodscate =  DB::select('select * from goods_category where id=1 and pid != 0 OR pid IN( SELECT id from goods_category where pid in(SELECT id from goods_category where id=1)) limit 8');
           //选项卡
           $goodstabcate = self::goodsTabCate($cateId);

           $goodsTabOneCate = $goodstabcate[0];
           dd($goodsTabOneCate);
           //销量商品
           $sales_sum = self::sum($cateId);

       } else {

           $request->session()->set('Index', '2');
           //轮播图
           $carousel =self::carousel($cateId);
           //最新产品
           $newest = self::newest($cateId);

           $goodstabcate = self::goodsTabCate($cateId);
//           dd($goodstabcate);
           //销量商品
           $sales_sum = self::sum($cateId);

       }

        return view('home.index', ['goodsTabOneCate' => $goodsTabOneCate,'sales_sum' => $sales_sum,'goodstabcate' => $goodstabcate,'request' => $request ,'cateId' => $cateId ,'carousel' => $carousel,'newest' => $newest]);

    }
    public function goodsTabCate($cateId)
    {
        //选项卡
        $goodstabcate = GoodsTabCate::where('is_display', '=', '1')->where('cat_id','like', $cateId.'%')->get();
        return $goodstabcate;
    }

    public function goodsTabOneCate($cateId)
    {
        //3级分类
//        $three_cate_id = $request->input('three_cate_id');
//        dd($three_cate_id);
        //男女
        $goodstabcate = self::goodsTabCate($cateId);
        $goodsTabOneCate = $goodstabcate[0];



//        if($cateId == 1 || $cateId == ''){
//            //女
//            $goods = Goods::where('cat_id', 'like', $cateId.'_%'.$three_cate_id, 'and', 'is_hot', '=', '1')->take(4)->get();
//            $brand = [];
//            //获取品牌
//            foreach ($goods as $key=>$good){
//
//                $brand[] = getBrand($good->brand_id);
//            }
////            dd($goods);
//        } else {
//            //女
//            $goods = Goods::where('cat_id', 'like', $cate_id.'_%'.$three_cate_id, 'and', 'is_hot', '=', '1')->take(4)->get();
//            $brand = [];
//            //获取品牌
//            foreach ($goods as $good){
//                $brand[] = getBrand($good->brand_id);
//            }
//        }
//        return  $data =   [
//            'goods' =>$goods,
//            'brand' => $brand
//        ];
    }
    /**
     * 销量商品
     * @param $cateId
     * @return mixed
     */
    public function sum($cateId)
    {
        $sales_sum = Goods::where('is_hot','=', '1', 'and', 'cat_id','like',$cateId.'%')->orderBy('sales_sum', 'desc')->take(20)->get();
        return $sales_sum;
    }
    /**
     * 选项卡
     * @param Request $request
     * @return array
     */
    public function getAjaxTab(Request $request)
    {
        //3级分类
        $three_cate_id = $request->input('three_cate_id');
//        dd($three_cate_id);
        //男女
        $cate_id = $request->input('cate_id');

        if($cate_id == 1 || $cate_id == ''){
            //女
            $goods = Goods::where('cat_id', 'like', $cate_id.'_%'.$three_cate_id, 'and', 'is_hot', '=', '1')->take(4)->get();
            $brand = [];
            //获取品牌
            foreach ($goods as $key=>$good){

                $brand[] = getBrand($good->brand_id);
            }
//            dd($goods);
        } else {
            //女
            $goods = Goods::where('cat_id', 'like', $cate_id.'_%'.$three_cate_id, 'and', 'is_hot', '=', '1')->take(4)->get();
            $brand = [];
            //获取品牌
            foreach ($goods as $good){
                $brand[] = getBrand($good->brand_id);
            }
        }
        return  $data =   [
            'goods' =>$goods,
            'brand' => $brand
        ];
    }

    /**
     * 最新的商品
     * @param $cateId
     * @return mixed
     */
    public function newest($cateId)
    {
        //查女士最新的产品id排序
        $newest = Goods::where('is_new', '=', '1', 'and', 'cat_id', 'like', $cateId.'%')->orderBy('goods_id','desc')->take(8)->get();
        return $newest;
    }
    /**
     * 首页轮播图
     * @param $cateId
     * @return mixed
     */
    public function carousel($cateId)
    {
        //轮播图
        $carousel = Carousel::where('status', '=', '1')->where('cate_id','=', $cateId)->take(3)->get();
        return $carousel;
    }
    /**
     * 获取首页分类的方法
     * @param $maxId 1级ID
     * @param $pid  父ID
     * @param $cateId 区分男女士
     * @return array   ajax响应数据
     */
    public function getAjaxCatetree($maxId, $pid, $cateId)
    {
        //查询这个分类下的商品，4个
        $goods = Goods::where('cat_id', 'like', $maxId.'_'.$pid.'%')->orderBy('goods_id','desc')->take(4)->get();

        $brand = [];

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

        ];
        return $data;
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
     * 首页分类获取，ajax请求
     * @param Request $request
     * @return array
     */
    public function getAjaxCate(Request $request)
    {
            //接收的2级id
            $pid = $request->input('pid');

            //获取后缀的id 1, 女士默认，2男士,3 生活
            $cateId = $request->input('cate_id');

            //女士
            if($cateId == 1 || $cateId = ''){

                $data = self::getAjaxCatetree('1', $pid, $cateId);

              //男士
            } else {

                $data = self::getAjaxCatetree('2', $pid, $cateId);

            }
           return $data;
    }

    /**
     * 响应数据给ajax首页新品
     * @param Request $request
     * @return array
     */
    public function newgoods(Request $request)
    {
        //接收的2级新品id
        $pid = $request->input('pid');

        //获取后缀的id 1, 女士默认，2男士,3 生活
        $cateId = $request->input('cate_id');

        if($cateId == 1){

            $newgoods = self::getAjaxNewTree($cateId);

        } else {

            $newgoods = self::getAjaxNewTree($cateId);

        }

        $brand = [];

        foreach ($newgoods as $newgood){
            $brand[] = getBrand($newgood->brand_id);
        }

        return $data = [
                'brand'    => $brand,
                'newgoods' => $newgoods
        ];

    }

    /**
     * 首页获取新品商品
     * @param $cateId 区分男女士
     * @return mixed  goods数据
     */
    public function getAjaxNewTree($cateId)
    {
        //获取新品商品  1是新品  0不是
        $newgoods = Goods::where('is_new', '=', '1')->where('cat_id', 'like', $cateId.'%')->orderBy('goods_id','desc')->take(6)->get();
        return $newgoods;

    }

    public function cataLog (Request $request)
    {
        $cateId =  $request->route('id');

    }

}
