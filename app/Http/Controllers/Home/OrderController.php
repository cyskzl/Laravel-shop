<?php

namespace App\Http\Controllers\Home;

use App\Models\DeliveryDoc;
use App\Models\DelveryMethod;
use App\Models\Goods;
use App\Models\Orders;
use App\Models\OrdersDetails;
use App\Models\PayMethod;
use App\Models\ReceivingAddress;
use App\Models\Region;
use App\Models\SpecGoodsPrice;
use App\Models\SpecItem;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{


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
//                dd($goodsSale);
                dd('商品下架');
            }

            //查询商品库存
            $goodissnum = $this->goodsNum($goodsid,$specGoods,$goodsnum);

            if ($goodissnum){
//                dd($goodsnum);
                dd('库存不足');
            }

            $goodsNewData = array();

//            SELECT goods.goods_id,goods_name,spec_goods_price.price,spec_goods_price.`key` FROM goods LEFT JOIN spec_goods_price ON goods.goods_id = spec_goods_price.goods_id where goods.goods_id = 86 and spec_goods_price.`key` = '22_24'

            //查询商品信息
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

            return redirect('home/orders');
            dd('非法提交');
        }

        if ($request->session()->has('addorders.address')) {

            $goodsdata = $request->session()->get('addorders');

        }else{
            return redirect('home/orders');
            dd('没有收货地址');
        }

        if ($request->input('shipping_code')){

            $delverinfo = DelveryMethod::find($request->input('shipping_code'))->where('enabled',1)->first();

        }else{

            return redirect('home/orders');
            dd('没有发货方式');
        }


        $goodsdata['delivery'] = $delverinfo->toArray();

        $status = $this->createOrdre($goodsdata,$request);


        if (!$status){

            return redirect('home/orders');
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

        $paymethod = PayMethod::all();

        $request->session()->set('orders.sn',$status['sn']);

        return view('home.orders.payment',compact('cateId','status','paymethod'));

    }

    public function orderToPayMethodSubmit(Request $request,$order_sn)
    {
        if ($order_sn){

            $userid = \Auth::user()->user_id;

            $order = Orders::where('sn',$order_sn)->where('user_id',$userid)->first();

            $status['sn'] = $order->sn;
            $status['order_amount'] = $order->order_amount;

            $request->session()->set('orders.sn',$order->sn);

            $paymethod = PayMethod::all();

            return view('home.orders.payment',compact('cateId','status','paymethod'));

        }



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
    public function show(Request $request,$id)
    {
        $cateId = $request->session()->get('Index');

        $userid = \Auth::user()->user_id;

        $orderData = Orders::where('sn',$id)->where('user_id',$userid)->with('orderDetails','orderDeliveryDoc')->first();

        if (count($orderData)>0){

            $regions = Region::whereIn('id',[$orderData->province,$orderData->city,$orderData->district,$orderData->twon])->get();
            $address = '';

            foreach ($regions as $value){

                $address .= $value->name;
            }
        }

        
//        dd($orderData);
        //
        return view('home.personal.order.orderdetail',compact('cateId','orderData','address'));
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

    //个人中心订单页数据
    public function userOrderData($userid,$field,$arr)
    {
        $orderData = Orders::where('user_id',$userid)->where(function ($query)use ($field,$arr){
            if (!is_array($arr) && !is_array($field)){
                $query->where($field,$arr);
            }

            if (is_array($arr) && !is_array($field)){
                $query->whereIn($field,$arr);
            }
        })->where(function ($query) use ($field,$arr){
            if (is_array($field) && is_array($arr)){
                foreach ($field as $k=>$v){

                    if (is_array($arr[$k])){
                        $query->whereIn($v,$arr[$k]);
                    }else{
                        $query->where($v,$arr[$k]);
                    }
                }
            }
        })->with(['orderDetails'=>function($query){
            $query->select('order_id','goods_info','goods_num','goods_id');
        }])->select('id','order_status','sn','consignee','total_amount','created_at')->orderBy('id','desc')->get();

        return $orderData;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-订单详情（待付款订单）
     */
    public function waitOrder(Request $request)
    {
        $cateId = $request->session()->get('Index');

        $userid =  \Auth::user()->user_id;

        $field = ['pay_status','order_status'];

        $str = [0,0];

        $orderData = $this->userOrderData($userid,$field,$str);

        $orderStatus = array(0=>'未确认',1=>'已确认');

        return view('home.personal.order.waitOrder',compact('cateId','orderData','orderStatus'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-订单详情（已付款订单）
     */
    public function alreadyOrder(Request $request)
    {
        $cateId = $request->session()->get('Index');

        $userid =  \Auth::user()->user_id;

        $field = ['pay_status','order_status'];

        $str = [1,[1,2,3]];

        $orderData = $this->userOrderData($userid,$field,$str);

        $orderStatus = array(0=>'未确认',1=>'已确认');

        return view('home.personal.order.alreadyOrder',compact('cateId','orderData','orderStatus'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-订单详情（已取消订单）
     */
    public function cancelOrder(Request $request)
    {
        $cateId = $request->session()->get('Index');

        $userid =  \Auth::user()->user_id;

        $field = 'order_status';

        $arr = [-1,-2,-3];

        $orderData = $this->userOrderData($userid,$field,$arr);

        $orderStatus = array(-1=>'已取消',-2=>'无效订单',-3=>'作废订单');

        return view('home.personal.order.cancelOrder',compact('cateId','orderData','orderStatus'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-订单详情（退款/退货订单）
     */
    public function refundOrder(Request $request)
    {
        $cateId = $request->session()->get('Index');

//        $userid =  \Auth::user()->user_id;
//
//        $field = 'order_status';
//
//        $arr = [-1,-2,-3];
//
//        $orderData = $this->userOrderData($userid,$field,$arr);
//
//        $orderStatus = array(-1=>'已取消',-2=>'无效订单',-3=>'作废订单');

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

                    //查询规格表的库存，如果数量不少于当前提交的数量则可以查出商品信息。
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

        //获取启动的发货方式
        $data = DelveryMethod::where('id',$id)->where('enabled',1)->first();


        if (count($data)>0){

            //存入session
            $request->session()->set('addorders.delivery',$data->toArray());

            //返回获取到的数据
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

            //订单编号
            $ordremodel->sn = $sn;

            //用户id
            $ordremodel->user_id = $goodsdata['address']->user_id;

            //收货人
            $ordremodel->consignee = $goodsdata['address']->consignee;

            //邮箱
            $ordremodel->email = $goodsdata['address']->email;

            //地址省份
            $ordremodel->province = $goodsdata['address']->province;

            //地址城市
            $ordremodel->city = $goodsdata['address']->city;
            //地址区县
            $ordremodel->district = $goodsdata['address']->district;
            //地址乡镇街区
            $ordremodel->twon = $goodsdata['address']->twon;
            //详细地址
            $ordremodel->address = $goodsdata['address']->detailed_address;

            //邮编
            $ordremodel->zipcode = $goodsdata['address']->zipcode;
            //手机号码
            $ordremodel->mobile = $goodsdata['address']->mobile;

            //商品总价
            $ordremodel->goods_price = $goodsdata['sum'];

            //邮费
            $ordremodel->shipping_price = $goodsdata['delivery']['price'];
            //物流id号
            $ordremodel->shipping_code = $goodsdata['delivery']['id'];
            //物流名称
            $ordremodel->shipping_name = $goodsdata['delivery']['name'];

            //获取应付金额
            $order_amount = $goodsdata['sum'] + $goodsdata['delivery']['price'];

            //应付款金额
            $ordremodel->order_amount = $order_amount;

            //订单总额
            $ordremodel->total_amount = $goodsdata['sum'] + $goodsdata['delivery']['price'];

            //用户备注
            $ordremodel->user_note = $request->input('user_note');

            if ($ordremodel->save()){

                $orderid = $ordremodel->id;

                foreach ($goodsdata['order'] as $value){

                    $detailsModel = new OrdersDetails();

                    $detailsModel->order_id = $orderid;

                    $detailsModel->order_sn = $sn;

                    $detailsModel->goods_id = $value['goods_id'];

                    $goodsinfo['goods_name'] = $value['goods_name'];

                    $goodsinfo['original_img'] = trim($value['original_img'],',');

                    $detailsModel->goods_info = json_encode($goodsinfo);

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
        //获取日期时间到秒
        $snone = date('YmdHis');

        //redis 自增ID获取
        $sntow = Redis::incr('ordresn');

        //如果到了99999则销毁这个key，下次获取就是1
        if ($sntow == 99999){
            Redis::del('ordresn');
        }

        //redis获取的id转成5位数值
        $sntow = sprintf("%05d", $sntow);

        if ($sntow){

            //返回日期和5位数值合并的号码 例如：20170711194200001
            return $snone.$sntow;
        }

        return false;

    }

    //提交订单付款方式
    public function payMethodSubmit(Request $request)
    {
        $payid = $request->input('pay_name');

        //获取付款方式
        $payData = PayMethod::find($payid)->where('enabled',1)->first();

        //获取用户id
        $userid = \Auth::user()->user_id;


            if ($request->session()->has('orders.sn')) {

                //获取订单编号
                $orderSn = $request->session()->get('orders.sn');
            }


        //调用更改付款状态和创建发货单方法
        $status = $this->createDeliveryDoc($orderSn,$userid,$payData);

        //更改付款状态和创建发货单
        if ($status){
            //重定向到订单详情页
            return redirect('home/alreadyorder');
        }



    }

    //个人中心提交过来的取消订单
    public function toCancelOrder($id)
    {
        $userid =  \Auth::user()->user_id;

        $order = Orders::where('user_id',$userid)->where('order_status',0)->where('pay_status',0)->where('sn',$id)->first();

        if (count($order)>0){

            $order->order_status = -1;

            if ($order->save()){

                return '取消成功';
            }else{
                return '取消失败';
            }

        }else{

            return '订单信息错误';
        }

    }

    //更改付款状态和创建发货单
    public function createDeliveryDoc($orderSn,$userid,$payData)
    {
        $status = DB::transaction(function() use ($orderSn,$userid,$payData)
        {
            $order = Orders::where('sn',$orderSn)->where('user_id',$userid)->first();

            $order->order_status = 1;
            $order->pay_status = 1;

            $order->pay_code = $payData->id;
            $order->pay_name = $payData->name;

            if ($order->save()){
                $delivery = new DeliveryDoc();

                $delivery->order_id = $order->id;

                $delivery->order_sn = $order->sn;
                $delivery->user_id = $userid;
                $delivery->consignee = $order->consignee;
                $delivery->zipcode = $order->zipcode;
                $delivery->mobile = $order->mobile;
                $delivery->country = $order->country;
                $delivery->province = $order->province;
                $delivery->city = $order->city;
                $delivery->twon = $order->twon;
                $delivery->address = $order->address;
                $delivery->shipping_code = $order->shipping_code;
                $delivery->shipping_name = $order->shipping_name;
                $delivery->shipping_price = $order->shipping_price;

                if ($delivery->save()){

                   return true;

                }

            }
        });

        return $status;

    }

}
