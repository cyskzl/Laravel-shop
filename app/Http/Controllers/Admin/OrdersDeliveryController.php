<?php

namespace App\Http\Controllers\Admin;

use App\Models\DeliveryDoc;
use App\Models\Region;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrdersDeliveryController extends Controller
{
    //
    public function index()
    {

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
}
