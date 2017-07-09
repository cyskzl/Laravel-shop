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
//use hightman\xunsearch\lib;

class IndexController extends Controller
{
    public function search(Request $request)
    {
        $cateId = $request->session()->get('Index');
        $key = $request->input('goods_name');
//        var_dump($key);
        $xs = new \XS(config_path('goods.ini'));
//        $xs = new \XS('goods');
        $search = $xs->search->setFuzzy(true); // 获取 搜索对象
        $query = $key;
        $search->setQuery($query)
            ->setDocOrder() //是否为正序排列, 即从先到后, 默认为反序,取最新
            ->setLimit(20,0); // 设置搜索语句, 分页, 偏移量
//        ;
        $docs = $search->search(); // 执行搜索，将搜索结果文档保存在 $docs 数组中
        if(!$docs){
            // 无查询结果，则在列表页遍历最新的20件商品;
            $goods = Goods::orderBy('goods_id','desc')->paginate(20);
        }

        foreach ($docs as $k=>$value){
            $goods[] = Goods::where('goods_id',$value['goods_id'])->first();
        }
        return view('home.goods.list',compact('goods','cateId'));
    }

    /**
     * 返回给前台首页的数据
     * @param Request $request
     * @param int $category_id 路由默认值为1，为女的，2为男的
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homeIndex( Request $request)
    {
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
            //ajax为加载前
           $goodsTabOneCate = self::goodsTabOneCate($cateId);

           //热销品牌
           $brands = self::goodsBrand($cateId);
//           dd($brands);

           //销量商品
           $sales_sum = self::sum($cateId);

       } else {

           $request->session()->set('Index', '2');
           //轮播图
           $carousel =self::carousel($cateId);
           //最新产品
           $newest = self::newest($cateId);

           //选项卡
           $goodstabcate = self::goodsTabCate($cateId);
           //ajax为加载前
           $goodsTabOneCate = self::goodsTabOneCate($cateId);

           //热销品牌
           $brands = self::goodsBrand($cateId);

           //销量商品
           $sales_sum = self::sum($cateId);

       }

        return view('home.index', [

                'goodsTabOneCate' => $goodsTabOneCate
                ,'sales_sum'      => $sales_sum
                ,'goodstabcate'   => $goodstabcate
                ,'request'        => $request
                ,'cateId'         => $cateId
                ,'carousel'       => $carousel
                ,'newest'         => $newest
                ,'brands'         => $brands
        ]);

    }

    /**
     * 品牌显示
     * @param $cateId
     * @return mixed
     */
    public function goodsBrand($cateId)
    {
        //select brand.id,brand.name,sales_sum from goods LEFT JOIN brand on goods.brand_id = brand.id ORDER BY  sales_sum desc
        $brand = Goods::where('cat_id', 'like', $cateId. '%' )->where('brand.is_hot','=', '1')->join('brand', 'goods.brand_id', '=', 'brand.id')->orderBy('sales_sum', 'desc')->take(5)->get();
        return $brand;
    }
    /**
     * 获取选项卡的所有分类
     * @param $cateId
     * @return mixed
     */
    public function goodsTabCate($cateId)
    {
        //选项卡
        $goodstabcate = GoodsTabCate::where('is_display', '=', '1')->where('cat_id','like', $cateId.'%')->take(7)->get();
        return $goodstabcate;
    }

    /**
     * 最新热门推荐 获取未加载ajax前的单商品
     * @param $cateId
     * @return mixed
     */
    public function goodsTabOneCate($cateId)
    {

        //获取全部选项卡
        $goodstabcate = self::goodsTabCate($cateId);

        $tabOnecate = explode('_', $goodstabcate[0]['cat_id']);

        if($cateId == 1 || $cateId == ''){
            //女
            $goods = Goods::where('cat_id', 'like', $cateId.'_%'.$tabOnecate[2], 'and', 'is_hot', '=', '1')->take(4)->get();

        } else {
            //女
            $goods = Goods::where('cat_id', 'like', $cateId.'_%'.$tabOnecate[2], 'and', 'is_hot', '=', '1')->take(4)->get();

        }
        return  $goods;
    }
    /**
     * 销量商品
     * @param $cateId
     * @return mixed
     */
    public function sum($cateId)
    {
        $sales_sum = Goods::where('is_hot','=', '1', 'and', 'cat_id','like',$cateId.'%')->orderBy('sales_sum', 'desc')->take(10)->get();
        return $sales_sum;
    }

    /**
     * 流加载首页
     * @param Request $request
     * @return mixed
     */
    public function flow(Request $request)
    {
        $request->input('currentIndex');

        $cateId = $request->session()->get('Index');

        $flow = Goods::where('is_hot','=', '1', 'and', 'cat_id','like',$cateId.'%')->orderBy('sales_sum')->take(25)->paginate(5);

        return $flow;
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

        //男女
        $cate_id = $request->input('cate_id');

        if($cate_id == 1 || $cate_id == ''){

            $goods = Goods::where('cat_id', 'like', $cate_id.'_%'.$three_cate_id, 'and', 'is_hot', '=', '1')->take(4)->get();
            //获取goods对应的品牌名称
            $brand = self::brand($goods);

        } else {
            $goods = Goods::where('cat_id', 'like', $cate_id.'_%'.$three_cate_id, 'and', 'is_hot', '=', '1')->take(4)->get();

            //获取goods对应的品牌名称
            $brand = self::brand($goods);
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

        $goodscate = Category::where( 'id', '=', $pid )->first();
        if($goodscate->pid == $cateId ){
            $goods = Goods::where('cat_id', 'like', $maxId.'_'.$pid.'%')
                ->orderBy('goods_id','desc')
                ->take(4)
                ->get();
        } else {
            $goods = Goods::where('cat_id', 'like', $maxId.'_%'.$pid)
                ->orderBy('goods_id','desc')
                ->take(4)
                ->get();
        }
        //获取goods对应的品牌名称
        $brand = self::brand($goods);

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
            //获取新品数据
            $newgoods = self::getAjaxNewTree($cateId);

        } else {
            //获取新品数据
            $newgoods = self::getAjaxNewTree($cateId);

        }
        //获取goods对应的品牌名称
        $brand = self::brand($newgoods);

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
    /**
     * 遍历数据转商品对应下的品牌
     */
    public function brand($goods)
    {
        $brand = [];
        //获取品牌
        foreach ($goods as $key => $value){

            $brand[] = getBrand($value->brand_id);
        }

        return $brand;
    }
}
