<?php

namespace App\Http\Controllers\Home;

use App\Models\ReceivingAddress;
use App\Models\Region;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Userinfo;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    public function __construct()
    {
        $user = Userinfo::where('user_id', '=', \Auth::user()->user_id)->first();
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
        return view('home.personal.set.address', compact('cateId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cateId = $request->session()->get('Index');

        // 获取一级的城市
        $province = Region::where('parent_id',0)->get();


        return view('home.personal.set.create_address',compact('province','cateId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'consignee'=>'required',
            'mobile'=>'required | regex:/^1[34578][0-9]{9}$/',
            'email'=>'required | email',
            'province'=>'required',
            'city'=>'required',
            'district'=>'required',
            'detailed_address'=>'required',
        ],[
            'required'=>':attribute不能为空',
            'email'=>':attribute格式不正确',
        ],[
            'consignee'=>'收货人',
            'mobile'=>'手机号码',
            'email'=>'邮箱',
            'province'=>'省',
            'city'=>'市',
            'district'=>'区/县',
            'detailed_address'=>'详情地址',
        ]);
        $cateId = $request->session()->get('Index');
        $res = $request->all();
        $res['user_id'] = Auth::user()->user_id;
        if(ReceivingAddress::create($res)){
            return view('home.personal.set.address',compact('cateId'))->with(['success'=>'添加成功']);
        }else {
            return back()->withInput();
        }
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
}
