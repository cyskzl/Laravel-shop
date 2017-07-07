<?php

namespace App\Http\Controllers\Admin;

use App\Models\DelveryMethod;
use App\Models\OrdersDetails;
use App\Models\Orders;
use App\Models\PayMethod;
use App\Models\Region;
use App\Models\UserLogin;
use App\Models\UserRegister;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission;

class OrdersController extends Controller
{
    protected $perms;

	public function __construct()
	{
		$this->perms = new Permission;
	}

    /**
     * @return  view    订单管理列表页
     */
    public function index(Request $request)
    {
        //判断是否有权限访问列表
		$this->perms->adminPerms('admin, orders', 'orders_list');

//        if ($request->input('keytype') == 0){
//            $user = UserLogin::where('login_name',$request->input('keywords'))->get();
//            $user = $user[0]->user_id;
//            dd($user);
//        }

        $ordersList = Orders::with(['users'=>function($query){

            $query->select('id','email','tel');

        }])->where(function ($query) use ($request){
            $query->where('pay_status',$request->input('pay_status'))
                ->where('pay_code',$request->input('pay_code'))
                ->where('shipping_status',$request->input('shipping_status'))
                ->where('order_status',$request->input('order_status'));
        })->where(function ($query) use ($request){
            if ($request->input('keytype') == '0'){
                $user = UserLogin::where('login_name',$request->input('keywords'))->get();
                if (!empty($user[0]->user_id)){
                    $query->where('user_id',$user[0]->user_id);
                }else{
                    $query->where('user_id',0);
                }
            }
        })->where(function ($query) use ($request){
            if ($request->input('keytype') == '1'){
                $query->where('sn',$request->input('keywords'));
            }
        })->where(function ($query) use($request){
            if ($request->input('add_time_begin') && $request->input('add_time_end')){
                $query->whereBetween('created_at',[$request->input('add_time_begin'),$request->input('add_time_end')]);
                return;
            }

            if ($request->input('add_time_begin')){
                $query->whereBetween('created_at',[$request->input('add_time_begin'),date('Y-m-d H:i:s')]);
            }
        })->get();


        //查出来的总数据条数
        $sum = count($ordersList);

        $pay_status = array(0=>'未支付',1=>'已支付');

        $order_status = array(-3=>'作废订单',-2=>"无效订单",-1=>'已取消',0=>'待确认',1=>'已确认',2=>'已收货',3=>'完成');

        $shipping_status = array(0=>'未发货',1=>'已发货',2=>'部分发货');

        //支付方式
        $payMethod = PayMethod::all();

        return view('admin.main.orders.index',compact(
            'ordersList', 'pay_status','order_status','shipping_status','payMethod','sum','request'));
    }

    /**
     * @return  view    订单详情页
     */
    public function show($id)
    {
        //判断是否有权限查看
		$this->perms->adminPerms('admin, orders', 'show_orders');

        //获取订单信息和订单详情信息。ordergood 关联到订单详情模型。
//        $ordergoods = Orders::whereHas('ordergood',function ($query) use ($id){
//            $query->where('id',$id);
//        })->get();

        $ordergoods = Orders::find($id)->with('ordergood')->get();

        //查询出来的的数据是在0下标，直接获取后使用更方便。
        $ordergoods = $ordergoods[0];

//        dd($ordergoods);

        $regions = Region::whereIn('id',[$ordergoods->country,$ordergoods->province,$ordergoods->city,$ordergoods->district,$ordergoods->twon])->get()->toArray();

        $regionname = '';

        foreach ($regions as $v){

            $regionname .= $v['name'].',';
        }

        $region = trim($regionname,',');

//        dd($region);

        return view('admin.main.orders.show',compact('ordergoods','region'));
    }

    /**
     * @return  view    订单添加页
     */
    public function create()
    {
        //判断是否有权限添加
		$this->perms->adminPerms('admin, orders', 'create_orders');
        return view('admin.main.orders.add');
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function store(Request $request)
    {
        //订单添加
    }

    /**
     * @return  view    订单修改页
     */
    public function edit($id)
    {
        //判断是否有权限修改
		$this->perms->adminPerms('admin, orders', 'edit_orders');

        //获取订单信息和订单详情信息。ordergood 关联到订单详情模型。
        $ordergoods = Orders::find($id)->with('ordergood')->get();


        //查询出来的的数据是在0下标，直接获取后使用更方便。
        $ordergoods = $ordergoods[0];


        $province = Region::where('parent_id',0)->get();

        $city = Region::where('parent_id',$ordergoods->province)->get();

        $district = Region::where('parent_id',$ordergoods->city)->get();

//        dd($province);


        return view('admin.main.orders.edit',compact('ordergoods','province','city','district'));
    }

    /**
     * update   更新修改操作
     *
     * @param   $request    array   获取请求头信息
     *
     * @return  未定义
     */
    public function update(Request $request,$id)
    {
        dd($request);
        // 修改付款状态为付款
        if($request->mode == 1){
           $order =  Orders::find($id);

           $pay_status = $order->select('pay_status')->get();

           if($pay_status[0]->pay_status == 0){

               $order->pay_status =1;

           }

           if($pay_status[0]->pay_status == 1){

               $order->pay_status = 0;
           }

           if($order->save()){
               return 0;
           }else{
               return 1;
           }
        }

        //修改订单状态为作废订单
        if($request->mode == 2){

            $order =  Orders::find($id);

            $shipping_status = $order->select('shipping_status')->get();

            //return $shipping_status[0]->shipping_status;

            if($shipping_status[0]->shipping_status !=1){

                $order->order_status = -3;
            }else{
                return 2;
            }

            if($order->save()){
                return 0;
            }else{
                return 1;
            }

        }

        //订单软删除
        if($request->mode == -1){

            $order =  Orders::find($id);

            $shipping_status = $order->select('order_status')->get();

            //return $shipping_status[0]->shipping_status;

            if($shipping_status[0]->order_status <0){

                $order->delete();

            }else{
                return 2;
            }

            if($order->trashed()){
                return 3;
            }else{
                return 1;
            }

        }
    }

    /**
     * destroy  订单删除
     *
     * @param   $request    array   获取请求头信息
     *
     */
    public function destroy(Request $request)
    {
        //判断是否有权限删除
		$error = $this->perms->adminDelPerms('admin, orders', 'delete_orsers');
        if ($error){
            //$error json数据  success=>错误码  info=>错误提示信息  如要返回的不是json数据请先转换
            return $error;
        }
        //删除id
    }
}
