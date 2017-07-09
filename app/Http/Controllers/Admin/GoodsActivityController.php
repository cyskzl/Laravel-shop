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
use Illuminate\Support\Facades\Input;

class GoodsActivityController extends Controller
{

    protected $perms;

	public function __construct()
	{
		$this->perms = new Permission;
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function activity(Request $request)
    {

        //判断是否有权限添加
		$this->perms->adminPerms('admin, goods', 'create_goodsactivity');
		// 获取活动类型（1:促销 2:折扣 3:团购 4:超值）
//        $activity_id = Input::get('activity_id');
//        dd($activity_id);
        // 商品表的商品信息获取并分页
        $goodsAll = Goods::orderBy('goods_id','desc')->paginate(3);

//
        return view('admin.main.goodsactivity.activitygoodsadd',compact('goodsAll','request'));
    }

    public function activityGood()
    {

    }
}
