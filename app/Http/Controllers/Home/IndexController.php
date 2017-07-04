<?php

namespace App\Http\Controllers\Home;

use App\Models\Goods;
use App\Http\Requests;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * 返回给前台首页的数据
     * @param Request $request
     * @param int $category_id 路由默认值为1，为女的，2为男的
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homeIndex( Request $request, $category_id = 1)
    {

        $cateId = $category_id ;
//        $cateId = $request->session()->get('Index');
//        dump($cateId);
        //获取后缀的id 1, 女士默认，2男士,3 生活
        // $cateId = $category_id;
        return view('home.index', ['request' => $request ,'cateId' => $cateId ]);

    }

    public function cate_Id(Request $request, $category_id = 1)
    {
        $cateId = $category_id;
        return $cateId;
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

}
