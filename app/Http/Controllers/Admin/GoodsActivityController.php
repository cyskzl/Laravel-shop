<?php

namespace App\Http\Controllers\Admin;


use App\Models\Good;
use App\Models\Goods;
use App\Models\Spec;
use App\Models\SpecItem;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission;

class GoodsActivityController extends Controller
{

    protected $perms;

	public function __construct()
	{
		$this->perms = new Permission;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //判断是否有权限访问列表
		$this->perms->adminPerms('admin, goods', 'goodsactivity_list');

        return view('admin.main.goodsactivity.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        //判断是否有权限添加
		$this->perms->adminPerms('admin, goods', 'create_goodsactivity');
//        $spec_item = [];
//        $key = [];
        //
        $all = [];
        $goods = Goods::with('specGoodsPrice')->paginate(3);
        $good = $goods->toArray();
//        dump($good['data'][0]['spec_goods_price']);
        foreach($good['data'] as $k=>$spec_goods_price){
//            dd($spec_goods_price);
            foreach($spec_goods_price['spec_goods_price'] as $key){
//                dd($key);
                $spec_item_id = explode('_',$key['key']);
//                dump($spec_item_id);
                foreach($spec_item_id as $id){
//                    dump($id);
                    $spec_id = SpecItem::where('id',$id)->pluck('item','spec_id');
                    foreach($spec_id as $id=>$item){
                        $spec = Spec::where('id',$id)->pluck('name')->first();
                        $all[$key['goods_id']][]4 = $spec.$item;
                    }

                }
            }
        }
        dd($all);
//        return view('admin.main.goodsactivity.add',compact('goods','request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $chk_value = trim($request->input('chk_value'),',');

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
        //判断是否有权限修改
		$this->perms->adminPerms('admin, goods', 'edit_goodsactivity');
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
        //判断是否有权限删除
		$error = $this->perms->adminDelPerms('admin, feedback', 'delete_feedback');
        if ($error){
            //$error json数据  success=>错误码  info=>错误提示信息  如要返回的不是json数据请先转换
            //json_decode($error);
            return $error;
        }


    }
}
