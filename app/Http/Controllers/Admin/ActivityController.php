<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use App\Models\GoodsActivity;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    /**
     * @return  view    活动管理列表页
     */
    public function index(Request $request)
    {
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
            $type = ['1'=>'促销','2'=>'折扣',3=>'团购',4=>'超值'];
            $status = ['0'=>'未开始','1'=>'已开始','2'=>'已结束'];
            return view('admin.main.activity.index',['activities'=>$activities,'request'=>$request,'type'=>$type,'status'=>$status]);
        }
    }

    /**
     * @return  view    活动添加页
     */
    public function create()
    {
        return view('admin.main.activity.add');
    }

    /**
     * 活动详情页
     * 包含活动商品的详细信息
     */
    public function show()
    {
        return view('admin.main.activity.show');
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function store(Request $request)
    {
        //活动添加
        $ $this->validate($request,[
            'name'=>'required',
            'type'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'img'=>'required',
            'desc'=>'required'
        ],[
            'required'=>':attribute不能为空'
        ],[
            'name'=>'活动名称',
            'type'=>'活动类型',
            'start_time'=>'活动开始时间',
            'end_time'=>'活动结束时间',
            'img'=>'图片',
            'desc'=>'活动描述',
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

        return view('admin.main.activity.edit');
    }

    /**
     * update   更新修改操作
     *
     * @param   $request    array   获取请求头信息
     *
     * @return  未定义
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * destroy  活动删除
     *
     * @param   $request    array   获取请求头信息
     *
     */
    public function destroy(Request $request)
    {
        //删除id

        $act_id = $request->input('id');
        $delGoods = GoodsActivity::where('activity_id','=',$act_id)->delete();
        $delAct = Activity::where('id','=',$act_id)->delete();
        return 2;
    }
}
