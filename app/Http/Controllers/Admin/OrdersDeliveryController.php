<?php

namespace App\Http\Controllers\Admin;

use App\Models\DeliveryDoc;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrdersDeliveryController extends Controller
{
    //
    public function index()
    {

//        $deliveryList = DeliveryDoc::with('belongsToOrders')->get();


        $deliveryList = DeliveryDoc::with(['belongsToOrders'=>function($query){
            $query->select('id','created_at','pay_time','total_amount');
        }])->get();

//        dd($deliveryList);


        return view('admin.main.orders.delivery_info.index',compact('deliveryList'));
    }

    public function show($id)
    {
        dd($id);
    }
}
