<?php

namespace App\Http\Controllers\Home;

use App\Models\DelveryMethod;
use App\Models\Goods;
use App\Models\Orders;
use App\Models\OrdersDetails;
use App\Models\ReceivingAddress;
use App\Models\Region;
use App\Models\SpecGoodsPrice;
use App\Models\SpecItem;
use App\Models\UserInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function __construct()
    {
        $user = UserInfo::where('user_id', '=', \Auth::user()->user_id)->first();
        view()->share('user', $user);
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


            if (array_key_exists('address',$goodsdata)){

                //销毁发货地址
                unset($goodsdata['address']);
            }


            $sum = 0;
            $goodsid = array();
            $specGoods = array();
            $goodsnum = array();

            foreach ($goodsdata as $v){

                if ($v){

                    array_push($goodsid,$v['goods_id']);
                    array_push($specGoods,$v['key1_key2']);
                    array_push($goodsnum,$v['num']);
                }


            }

            //查询商品下架信息
            $goodsSale = $this->checkGoodsSale($goodsid);

            if (count($goodsSale)<1){
                dd($goodsSale);
                dd('商品下架');
            }

            //查询商品库存
            $goodissnum = $this->goodsNum($goodsid,$specGoods,$goodsnum);

            if ($goodissnum){
                dd($goodsnum);
                dd('库存不足');
            }

            $goodsNewData = array();

//            SELECT goods.goods_id,goods_name,spec_goods_price.price,spec_goods_price.`key` FROM goods LEFT JOIN spec_goods_price ON goods.goods_id = spec_goods_price.goods_id where goods.goods_id = 86 and spec_goods_price.`key` = '22_24'

            foreach ($goodsid as $k=>$value){

                $goods = Goods::where('goods.goods_id',$value)
                    ->leftjoin('spec_goods_price','spec_goods_price.goods_id','=','goods.goods_id')
                    ->where('spec_goods_price.key',"$specGoods[$k]")
                    ->select('goods.goods_id','goods.goods_name','spec_goods_price.price','spec_goods_price.key','goods.original_img','goods.cost_price','goods.goods_sn','goods.cost_price')
                    ->get()->toArray();


                $NewData = SpecItem::whereIn('spec_item.id',explode("_",$specGoods[$k]))
                    ->join('spec','spec.id','=','spec_item.spec_id')
                    ->select('spec.name','spec_item.item')
                    ->get()->toArray();

                $goods = $goods[0];


                //压入商品数量
                $goods['num'] = $goodsnum[$k];

                //压入商品id_key1_key2  规格
                $goods['goodskey'] = $goods['goods_id'].'_'.$goods['key'];

                //统计订单总额
                $sum += $goodsnum[$k] * $goods['price'];

                //商品和规格压入
                $goods['item'] = $NewData;

                //分多个商品压入
                array_push($goodsNewData,$goods);

            }


//            dd($goodsNewData);
            //写入所有商品信息
            $request->session()->set('addorders.order',$goodsNewData);

            //写入订单总额
            $request->session()->set('addorders.sum',$sum);

            //查询地址库
            $address = ReceivingAddress::where('user_id',\Auth::user()->user_id)->orderBy('is_default')->first();

            //获取各级地址信息
            if($address){
                $province = Region::where('level',1)->pluck('name','id');

                $city = Region::where('level',2)->pluck('name','id');

                $district = Region::where('level',3)->pluck('name','id');

                $twon = Region::where('level',4)->pluck('name','id');

                $request->session()->set('addorders.address',$address);


            }

            //查询发货方式
            $delvary = DelveryMethod::where('enabled',1)->get();

            //判断是否有发货方式。并把默认的发货方式写入session
            if (count($delvary)>0){
                $request->session()->set('addorders.delivery',$delvary[0]->toArray());
            }

        }else{
            dd('没有在购物车提交');
        }

        return view('home.orders.submit_order', compact('cateId','goodsNewData','sum','address','request','province','city','district','twon','delvary'));
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

        $cateId = $request->session()->get('Index');

        if (!$request->session()->has('addorders')) {

            dd('非法提交');
        }

        if ($request->session()->has('addorders.address')) {

            $goodsdata = $request->session()->get('addorders');

        }else{

            dd('没有收货地址');
        }

        if ($request->input('shipping_code')){

            $delverinfo = DelveryMethod::find($request->input('shipping_code'))->where('enabled',1)->first();

        }else{
            dd('没有发货方式');
        }


        $goodsdata['delivery'] = $delverinfo->toArray();

        $status = $this->createOrdre($goodsdata,$request);


        if (!$status){

            dd('生成订单失败');
        }

//        Redis::hdel(user_id:Auth::user()->user_id);
//        $aa = Redis::hgetAll('user_id:'.\Auth::user()->user_id);
        foreach ($goodsdata['order'] as $vaule){

            Redis::hdel('user_id:'.\Auth::user()->user_id,$vaule['goodskey']);
        }

        $request->session()->forget('addorders');
        $request->session()->forget('orders');

        $status['data'] = date('Y-m-d H:i:s',strtotime("+1 day"));

        return view('home.orders.payment',compact('status'));
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

    /**
     * @param array $id
     * @param array $arr
     * @param array $num
     * @return array|bool
     */
    public function goodsNum($id = array(),$arr = array(),$num = array())
    {

        if ($arr){

            $goodsid = array();

            foreach ($arr as $k=>$value){

                if ($value){

                    $goodsnum =  SpecGoodsPrice::where('goods_id',$id[$k])->where('key',$value)->where('store_count','>',$num[$k])->get();

                    if (count($goodsnum)<1){
                        array_push($goodsid,$id[$k]);
                    }
                }

            }

            if ($goodsid){
                return $goodsid;
            }
        }

        return false;
    }


    //ajax获取发货方式
    public function toDelivery(Request $request,$id)
    {
        $data = DelveryMethod::where('id',$id)->where('enabled',1)->first();


        if (count($data)>0){

            //存入session
            $request->session()->set('addorders.delivery',$data->toArray());

            return $data->price;

        }

        return false;

    }

    //创建订单
    public function createOrdre($goodsdata,$request)
    {
        $status = DB::transaction(function() use ($goodsdata,$request)
        {
            $sn = $this->createSn();

            $ordremodel = new Orders();

            $ordremodel->sn = $sn;

            $ordremodel->user_id = $goodsdata['address']->user_id;

            $ordremodel->consignee = $goodsdata['address']->consignee;

            $ordremodel->email = $goodsdata['address']->email;

            $ordremodel->province = $goodsdata['address']->province;

            $ordremodel->city = $goodsdata['address']->city;
            $ordremodel->district = $goodsdata['address']->district;
            $ordremodel->twon = $goodsdata['address']->twon;
            $ordremodel->address = $goodsdata['address']->detailed_address;

            $ordremodel->zipcode = $goodsdata['address']->zipcode;
            $ordremodel->mobile = $goodsdata['address']->mobile;

            $ordremodel->goods_price = $goodsdata['sum'];

            $ordremodel->shipping_price = $goodsdata['delivery']['price'];
            $ordremodel->shipping_code = $goodsdata['delivery']['id'];
            $ordremodel->shipping_name = $goodsdata['delivery']['name'];
            $ordremodel->shipping_name = $goodsdata['delivery']['name'];

            //应付金额
            $order_amount = $goodsdata['sum'] + $goodsdata['delivery']['price'];
            $ordremodel->order_amount = $order_amount;

            //订单总额
            $ordremodel->total_amount = $goodsdata['sum'] + $goodsdata['delivery']['price'];

            $ordremodel->user_note = $request->input('user_note');

            if ($ordremodel->save()){

                $orderid = $ordremodel->id;

                foreach ($goodsdata['order'] as $value){

                    $detailsModel = new OrdersDetails();

                    $detailsModel->order_id = $orderid;

                    $detailsModel->order_sn = $sn;

                    $detailsModel->goods_id = $value['goods_id'];

                    $detailsModel->goods_name = $value['goods_name'];

                    $detailsModel->goods_sn = $value['goods_sn'];
                    
                    $detailsModel->goods_num = $value['num'];

                    $detailsModel->goods_price = $value['price'];

                    $detailsModel->cost_price = $value['price'];

                    $detailsModel->cost_price = $value['cost_price'];

                    $detailsModel->spec_key = $value['key'];
                    
                    $detailsModel->spec_key = $value['key'];

                    $spec_key_name = '';

                    foreach ($value['item'] as $v){

                        $spec_key_name .= $v['name'].'@'.$v['item']."_";

                    }

                    $detailsModel->spec_key_name = $spec_key_name;

                    $detailsModel->save();

                }

                $info['sn'] = $sn;
                $info['order_amount'] = $order_amount;

                return $info;
            }

        });

        return $status;

    }


    //生产订单号
    public function createSn()
    {
        $snone = date('YmdHis');

        $sntow = Redis::incr('ordresn');

        if ($sntow == 99999){
            Redis::del('ordresn');
        }

        

        $sntow = sprintf("%05d", $sntow);

        if ($sntow){

            return $snone.$sntow;
        }

        return false;

    }

}
