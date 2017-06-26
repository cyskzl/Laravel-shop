<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Spec;
use App\Models\SpecItem;
use App\Models\GoodsType;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SpecController extends Controller
{
    public function index(Request $request)
    {
        //分页查询以keyword为搜索关键字
        $specs = Spec::orderBy('order', 'desc')
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('name','like','%'.$keyword.'%');
                }
            })->paginate(10);

//        $specs = Spec::orderBy('id', 'desc')->paginate(10);
        return view('admin.main.goods.spec.index', ['specs' => $specs, 'request' => $request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typeinfos  =  DB::table('goods_type')->select('id', 'name')->get();
        return view('admin.main.goods.spec.create', ['typeinfos' => $typeinfos ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = json_decode($request->json);
//        //规格名称
//        $specname = $data->name;
//        //所属类型
//        $type_id = $data->type_id;
        //规格项
//        $order = $data->order;
        //排序
//        $item = $data->item;

        $spec = new Spec;
        $spec_item = new SpecItem;
        //写入规格表spec
        $spec->name =  $data->name;
        $spec->type_id =  $data->type_id;
        $spec->order =  $data->order;
        //成功后获取id
        if( $spec->save()){
            //写入规格项表spec_item
            $spec_item->spec_id = $spec->id;
            $spec_item->item = $data->item;
            //成功返回信息
            if(  $spec_item->save() ){
                $data = [
                    'status' => 0,
                    'msg'    => '添加成功'
                ];
            } else {

                $data = [
                    'status' => 1,
                    'msg'    => '添加失败'
                ];
            }
        }
        //返回给ajax
        return $data;

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
     * 修改显示
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $info =  Spec::find($id);
        $typeinfos  =  DB::table('goods_type')->select('id', 'name')->get();

        //先获取type_Id的字段再通过远程一对多访问下面spec_item，就获取到3个表的内容
//        $goodstype = GoodsType::find($info->type_id);
//
//        $specitem = $info->specitem->item

        return view('admin.main.goods.spec.edit', ['typeinfos' => $typeinfos , 'info' => $info]);
    }

    /**
     * 更新操作
     * @param Request $request
     * @param $id
     * @return array|mixed
     */
    public function update(Request $request, $id)
    {
        $data = json_decode($request->json);
        //spec 表内容
        $spec = Spec::find($data->id);
        //goods_type表内容
        $goods_type = $spec->spec;

        $spec->order = $data->order;
        $spec->name = $data->name;
        $spec->type_id = $data->type_id;

        //更新spec表
        if( $spec->save() ){
            //更新成功
            if(SpecItem::where('spec_id', $id)->update(['item'=>$data->item])){
                $data = [
                    'status' => 1,
                    'msg'    => '修改成功'
                ];
            }else {
                $data = [
                    'status' => 0,
                    'msg'    => '修改失败'
                ];
            }
        }
        return $data;
    }

    /**
     * 删除
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        $spec = Spec::find($id);
        //获取item表的信息
        $spec_item = GoodsType::find($spec->type_id)->spec_item;
        //进行判断item规格项是否有无值
            if(!empty($spec->specitem->item)){
                $data = [
                    'status' => 2,
                    'msg'    => '请清除规格项内容，在尝试删除'
                ];
            } else {
                //有的话同时删除
                if(Spec::destroy([$id]) && SpecItem::destroy([$spec->specitem->id])){
                    $data = [
                        'status' => 1,
                        'msg'    => '删除成功'
                    ];
                } else {
                    $data = [
                        'status' => 0,
                        'msg'    => '删除失败'
                    ];
                }

            }
             return $data;
    }

}
