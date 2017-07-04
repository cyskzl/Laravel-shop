<?php

namespace App\Http\Controllers\Admin;


use App\Models\Good;
use App\Models\Goods;
use App\Models\Spec;
use App\Models\SpecGoodsPrice;
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
        //存储商品所有规格的空数组
        $allSpec = [];
        // 商品表的商品信息获取并分页
//        $goods = Goods::with('specGoodsPrice')->paginate(3);
//        $good = $goods->toArray();


        $goods_id = Goods::all()->pluck('goods_id');
//        dd($goods_id);
//        $good = [];
        //获取与goods表关联的images表数据
        foreach($goods_id as $id){
            $goods = Goods::find($id);
            $good[] = $goods->specGoodsPrice;
        }
//        dd($good);
        foreach($good as $id=>$spec){
//            dump($k);
//            $a[$goods_id[$k]] = [];
//            dump($a);
            foreach($spec as $a=>$spec_key){
//                dd($spec_key);
                $key = explode('_',$spec_key->key);
//                $price[$goods_id[$k]] = $spec_key->price;

//                dump($price);a[$k]
                $spec_info= '';
                foreach($key as $k){
                    $spec_item = SpecItem::find($k);
//                    dd($spec_item);

                    $specAll = $spec_item->spec;
//                    dump($specAll);
                    $spec_info .= $specAll->name.':'.$spec_item->item;
                }
                $goodSpec[$goods_id[$id]][] = $spec_info.",价格:".$spec_key->price;

            }
        }


        return view('admin.main.goodsactivity.add',compact('goods','request','goodSpec'));
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
