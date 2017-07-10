<?php

namespace App\Http\Controllers\Admin;


use App\Models\Activity;
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
        $activity_id = $request->input('activity_id');
//        dd($activity_id);
        return view('admin.main.goodsactivity.activitygoodsadd',compact('goodsAll','request','activity_id'));
    }

    public function activityGoods(Request $request)
    {
        $good_id = $request->input('goods_id');
        $activity_id = $request->input('id');
        $goods_id = Activity::where('id',$activity_id)->pluck('goods_id')->first();
        $good_id = explode(',',$goods_id.','.$good_id);
        $good_id = implode(',',array_unique(array_filter($good_id)));
        $bool = Activity::where('id',$activity_id)->update(['goods_id'=>$good_id]);
        if($bool){
            return $msg = [
                'status'=>0,
                'msg'=>'添加商品成功'
            ];
        }else{
            return $msg =[
                'status'=>1,
                'msg'=>'添加商品失败'
            ];
        }
    }
}
