<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrdersReturn;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrdersReturnController extends Controller
{
    //
    public function index(Request $request)
    {
//        初始化搜索订单号的状态
        $ordersn = false;
        $status = false;

//        判断是否存在搜索 处理状态
        if( $request->status != null){
            $status = true;
        }

        //判断是否存在搜索 订单号
        if( $request->ordersn != null){
            $ordersn = true;
        }

        // when 如果第一个参数为真，则执行闭包函数，否则不执行。 获取退货订单
        $ordersReturnList = OrdersReturn::when($status,function ($query) use($request){
            return $query->where('status','=',$request->status);
        })->when($ordersn,function ($query) use($request){
            return $query->where('order_sn','like','%'.$request->ordersn.'%');
        })->get();


        $type = array(0=>'退货',1=>'换货');

        $ostatus = array(-2=>'已取消',-1=>'审核不通过',0=>'待审核',1=>'审核通过',2=>'已发货',3=>'已完成');

        return view('admin.main.orders.return_info.index',compact('ordersReturnList','type','ostatus'));
    }

    public function edit($id)
    {

        $ordersReturn = OrdersReturn::find($id);

        $seller_delivery = json_decode($ordersReturn->seller_delivery,true);

        $type = array(0=>'退货',1=>'换货');

        $ostatus = array(-2=>'已取消',-1=>'审核不通过',0=>'待审核',1=>'审核通过',2=>'已发货',3=>'已完成');

        return view('admin.main.orders.return_info.edit',compact('ordersReturn','seller_delivery','type','ostatus'));
    }

    public function update(Request $request,$id)
    {

        $ordersreturn = OrdersReturn::find($id);

        switch ($request->returnstatus){
            case 0:

                $ordersreturn->status = $request->status;
                $ordersreturn->type = $request->type;
                $ordersreturn->remark = $request->remark;

                if($ordersreturn->save()){
                    return 0;
                }else{
                    return 1;
                }
                break;
            case 1:

                if($request->type == 1){
                    $seller['express_name'] = $request->express_name;
                    $seller['express_sn'] = $request->express_sn;
                    $seller['express_time'] = date('Y-m-d H:i:s');

                    $ordersreturn->seller_delivery = json_encode($seller);

                    $ordersreturn->status = 2;

                    if($ordersreturn->save()){
                        return 0;
                    }else{
                        return 1;
                    }
                    break;
                }


        }
    }
}