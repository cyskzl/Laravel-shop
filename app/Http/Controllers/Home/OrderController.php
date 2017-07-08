<?php

namespace App\Http\Controllers\Home;

use App\Models\Goods;
use App\Models\SpecGoodsPrice;
use App\Models\SpecItem;
use App\Models\UserInfo;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct()
    {
//        $user = UserInfo::where('user_id', '=', \Auth::user()->user_id)->first();
//        view()->share('user', $user);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cateId = $request->session()->get('Index');

        if ($request->session()->has('orders')){

            $goodsdata = $request->session()->get('orders');

            $sum = 0;
            $goodsid = array();
            $specGoods = array();
            $goodsnum = array();

            foreach ($goodsdata as $v){

                array_push($goodsid,$v['goods_id']);
                array_push($specGoods,$v['key1_key2']);
                array_push($goodsnum,$v['num']);

            }

            $goodsSale = $this->checkGoodsSale($goodsid);

            if ($goodsSale){
                dd('商品下架');
            }

            $goodsnum = $this->goodsNum($goodsid,$specGoods,$goodsnum);

            if ($goodsnum){
                dd($goodsnum);
                dd('库存不足');
            }


            $goodsNewData = array();

//            SELECT goods.goods_id,goods_name,spec_goods_price.price,spec_goods_price.`key` FROM goods LEFT JOIN spec_goods_price ON goods.goods_id = spec_goods_price.goods_id where goods.goods_id = 86 and spec_goods_price.`key` = '22_24'

            foreach ($goodsid as $k=>$value){

                $goods = Goods::where('goods.goods_id',$value)
                    ->leftjoin('spec_goods_price','spec_goods_price.goods_id','=','goods.goods_id')
                    ->where('spec_goods_price.key',"$specGoods[$k]")
                    ->select('goods.goods_id','goods.goods_name','spec_goods_price.price','spec_goods_price.key')
                    ->get()->toArray();


                $NewData = SpecItem::whereIn('spec_item.id',explode("_",$specGoods[$k]))
                    ->join('spec','spec.id','=','spec_item.spec_id')
                    ->select('spec.name','spec_item.item')
                    ->get()->toArray();

//
                array_push($goods,$NewData);

                array_push($goodsNewData,$goods);

            }

            dd($goodsNewData);




        }else{
            dd('没有在购物车提交');
        }

        return view('home.orders.submit_order', compact('cateId','goodsdata','sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('home.orders.payment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }
    public  function shopOrders(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-订单详情（待付款订单）
     */
    public function waitOrder(Request $request)
    {
        $cateId = $request->session()->get('Index');
        return view('home.personal.order.waitOrder',compact('cateId'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-订单详情（已付款订单）
     */
    public function alreadyOrder(Request $request)
    {
        $cateId = $request->session()->get('Index');
        return view('home.personal.order.alreadyOrder',compact('cateId'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-订单详情（已取消订单）
     */
    public function cancelOrder(Request $request)
    {
        $cateId = $request->session()->get('Index');
        return view('home.personal.order.cancelOrder',compact('cateId'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-订单详情（退款/退货订单）
     */
    public function refundOrder(Request $request)
    {
        $cateId = $request->session()->get('Index');
        return view('home.personal.order.refundOrder',compact('cateId'));
    }

    public function cartAjax(Request $request)
    {

//        dd($request->data);
        if ( $request->data ) {

            $goodsdata = json_decode($request->data, true);

            $request->session()->put('orders',$goodsdata);

            $error['success'] = 1;
            $error['url']     = url('home/orders');
            return json_encode($error);
        }

        $error['success'] = 0;
        $error['info']    = '未知错误！';
        return json_encode($error);

    }


    /**
     * @param array $arr    商品编号
     * @return array|bool   如果商品下架返回商品id,否则返回false
     */
    public function checkGoodsSale($arr = array())
    {
        if ($arr){
            $arr = array_unique($arr);
            $goodsid = array();
            foreach ($arr as $k=>$value){

               $id = Goods::where('goods_id',$value)->where('is_on_sale',1)->get();

               if (count($id)<1){
                   array_push($goodsid,$value);
               }
            }

            if ($goodsid){
                return $goodsid;
            }
        }

        return false;

    }

    public function goodsNum($id = array(),$arr = array(),$num = array())
    {
        if ($arr){
            $goodsid = array();
            foreach ($arr as $k=>$value){
                dump($id[$k]);
                dump($value);
                dump($num[$k]);
               $goodsnum =  SpecGoodsPrice::where('goods_id',$id[$k])->where('key',$value)->where('store_count','>',$num[$k])->get();

               if (count($goodsnum)<1){
                   array_push($goodsid,$id[$k]);
               }
            }

            if ($goodsid){
                return $goodsid;
            }
        }

        return false;
    }

}
