<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use App\Models\Goods;
use App\Models\GoodsActivity;
use App\Models\GoodsType;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Permission;

class ActivityController extends Controller
{

    protected $perms;

    /**
     * AdminRoleController constructor.
     */
    public function __construct()
    {
        $this->perms = new Permission;
    }
    /**
     * @return  view    活动管理列表页
     */
    public function index(Request $request)
    {
        //判断是否有权限访问列表

        $this->perms->adminPerms('admin,activity,goods', 'activity_list');

        // 查询活动并降序排列
        $activities = Activity::orderBy('id','desc')
            ->where(function($query) use ($request){
                // 搜索关键词
                $keyword = $request->input('keyword');
                if(!empty($keyword)){
                    // 模糊查询结果
                    $query->where('name','like','%'.$keyword.'%');
                }
            })->paginate(5);
//        dd($activities);
        if(!empty($activities)){
            $type = ['1'=>'促销','2'=>'折扣'];
            $status = ['0'=>'未开始','1'=>'已开始','2'=>'已结束'];
            return view('admin.main.activity.index',['activities'=>$activities,'request'=>$request,'type'=>$type,'status'=>$status]);
        }
    }

    /**
     * @return  view    活动添加页
     */
    public function create()
    {
        $this->perms->adminPerms('admin,activity,goods', 'create_activity');
        return view('admin.main.activity.add');
    }

    /**
     * 活动详情页
     * 包含活动商品的详细信息
     */

    public function show($id)
    {
        // 关联商品表得到商品的信息
        $act_goods = Activity::where('id',$id)->pluck('goods_id')->first();
        $act_goods = explode(',',$act_goods);
        foreach($act_goods as $k=>$goods_id){
            $goods_info[$k] = Goods::where('goods_id',$goods_id)->select('goods_name','shop_price','store_count')->first();
        }
//        dd($goods_info->paginate(3));
        return view('admin.main.activity.show', compact('goods_info'));
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function store(Request $request)
    {
        //活动添加

        $this->validate($request,[
            'name'=>'required',
            'type'=>'required',
            'act_range'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'img'=>'required',
        ],[
            'required'=>':attribute不能为空'
        ],[
            'name'=>'活动名称',
            'type'=>'活动类型',
            'act_range'=>'优惠范围',
            'start_time'=>'活动开始时间',
            'end_time'=>'活动结束时间',
            'img'=>'图片',
        ]);
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');
        $nowtime = date('Y-m-d H:i:s',time());
        // 活动时间逻辑判断
        if($start_time>$end_time || $end_time<$nowtime){
            return back()->withInput()->with(['fail'=>'活动时间不对，活动添加失败']);
        }
        $activity = new Activity();
        $activity->name = $request->input('name');
        $activity->type = $request->input('type');
        $activity->act_range = $request->input('act_range');
        $activity->start_time = $request->input('start_time');
        $activity->end_time = $request->input('end_time');
        $activity->img = $request->input('img');
        $activity->desc = $request->input('desc');

        if($activity->save()){
            return redirect('/admin/activity')->with(['success'=>'添加成功']);
        }else {
            return back()->withInput();
        }
    }

    /**
     * @return  view    活动修改页
     */
    public function edit($id)
    {
        $this->perms->adminPerms('admin,activity,goods', 'edut_activity');
        $activity = Activity::find($id);
//        dd($activity->name);
        return view('admin.main.activity.edit',compact('activity'));
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
        $status = $request->input('status');
        if($status){
            $activity = DB::table('activities')
                ->where('id','=',$id)
                ->update(['is_over'=>$status]);
            return $activity;
        }
//        dd($request->all());
        $act['name'] = $request->input('name');
        $act['type'] = $request->input('type');
        $act['act_range'] = $request->input('act_range');
        $act['start_time'] = $request->input('start_time');
        $act['end_time'] = $request->input('end_time');
        $act['img'] = $request->input('img');
        $act['desc'] = $request->input('desc');
        $res = Activity::where('id',$id)->update($act);
        if($res){
            return $msg = [
                'status'=>1,
                'msg'=>'修改成功'
            ];
        }else {
            return $msg = [
                'status'=>2,
                'msg'=>'修改失败'
            ];
        }
    }

    /**
     * destroy  活动删除
     *
     * @param   $request    array   获取请求头信息
     *
     */
    public function destroy(Request $request)
    {

        // 删除id
        $act_id = $request->input('id');
        $activity = Activity::find($act_id);
        // 删除上传活动图片
        $img = './'.trim($activity->img,',');
        unlink($img);
        $delAct = Activity::where('id','=',$act_id)->delete();
        return 2;
    }
}
