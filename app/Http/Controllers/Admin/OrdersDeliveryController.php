<?php

namespace App\Http\Controllers\Admin;

use App\Models\DeliveryDoc;

use App\Models\Region;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission;

class OrdersDeliveryController extends Controller
{
    protected $perms;

	public function __construct()
	{
		$this->perms = new Permission;
	}

    //
    public function index()
    {

        //判断是否有权限访问列表
		$this->perms->adminPerms('admin, orders', 'ordersdelivery_list');

//        $deliveryList = DeliveryDoc::with('belongsToOrders')->get();

//        dd($deliveryList);

        $deliveryList = DeliveryDoc::with(['belongsToOrders'=>function($query){
            $query->select('id','created_at','pay_time','total_amount');
        }])->get();

//        dd($deliveryList);


        return view('admin.main.orders.delivery_info.index',compact('deliveryList'));
    }

    public function show($id)
    {
        //判断是否有权限查看
		$this->perms->adminPerms('admin, orders', 'show_ordersdelivery');

        $ordergoods = DeliveryDoc::find($id)->with('belongsToOrdersDetalis','belongsToOrders')->get();

        $ordergoods = $ordergoods[0];

        $regions = Region::whereIn('id',[$ordergoods->country,$ordergoods->province,$ordergoods->city,$ordergoods->district,$ordergoods->twon])->get()->toArray();

        $regionname = '';

        foreach ($regions as $v){

            $regionname .= $v['name'].',';
        }

        $region = trim($regionname,',');

//        dd($region);

//        dd($ordergoods);

        return view('admin.main.orders.delivery_info.show',compact('ordergoods','region'));
    }


    public function update(Request $request,$id)
    {
        if (empty($id)){

            //返回空id错误号
            return 1;
        }

        if (empty($request->input('invoice_no'))){

            //返回空快递号错误
            return 2;
        }

        $deliver = DeliveryDoc::find($id);

        $orderid = $deliver->order_id;

        if ($request->mode == 1 || $request->mode == 2){

            $status = 1;
            $invoice = $request->input('invoice_no');

        }else{
            $status = 0;
            $invoice = "";
        }

            $note = $request->input('note');

            $status = DB::transaction(function ($date) use ($request,$orderid,$status,$invoice,$note) {

                DB::table('orders')->where('id',$orderid)->update(['shipping_status'=>$status]);

                DB::table('orders_details')->where('order_id',$orderid)->update(['is_send'=>$status]);

                DB::table('delivery_doc')->where('order_id',$orderid)->update(['invoice_no' => $invoice,
                    'note' => $note]);
        });


        return $status;


        $deliver = DeliveryDoc::find($id);

        $orderid = $deliver->order_id;

        return $orderid;

        //写入发货快递单号
        $deliver->invoice_no = $request->input('invoice_no');

        //写入发货备注信息
        $deliver->note = $request->input('note');

        //判断写入是否成功
        if ($deliver->save()){

            //返回成功号
            return 0;
        }else{

            //返回修改数据库错误号
            return 3;
        }
    }
}
