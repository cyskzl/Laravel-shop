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

        $spec = new Spec;
        $spec_item = new SpecItem;
        //写入规格表spec
        //判断规格名称不能为空
        if($data->name){
            $spec->name =  $data->name;
        } else {
            return self::errorNumb(2,'规格名称不能为空');
        }
        //判断所属于类型为空
        if($data->type_id){
            $spec->type_id =  $data->type_id;
        } else {
            return self::errorNumb(3,'所属于类型为空');
        }
        $spec->order =  $data->order;
        //成功后获取id
        if( $spec->save()){
            $item = $data->item;
            $itemstrs = explode(',',$item);
                foreach ($itemstrs as $itemstr){
                    if(DB::table('spec_item')->insert(
                        [
                             'item'=> $itemstr,
                              'spec_id' => $spec->id,
                        ]
                    )){
                        $data = self::errorNumb(0,'添加成功');
                    } else {
                        $data = self::errorNumb(1,'添加失败');
                    }
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
        //获取规格所有的   select GROUP_CONCAT(item) from  spec_item where spec_id = 9
        $specitem = SpecItem::select( DB::raw('GROUP_CONCAT(item) AS specitem') )->where('spec_id', '=', $id)->get();

        $typeinfos  =  DB::table('goods_type')->select('id', 'name')->get();

        //先获取type_Id的字段再通过远程一对多访问下面spec_item，就获取到3个表的内容

        return view('admin.main.goods.spec.edit', ['specitem' => $specitem, 'typeinfos' => $typeinfos , 'info' => $info]);
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
        $spec = Spec::find($id);
        //写入规格表spec
        //判断规格名称不能为空
        if($data->name){
            $spec->name =  $data->name;
        } else {
            return self::errorNumb(2,'规格名称不能为空');
        }
        //判断所属于类型为空
        if($data->type_id){
            $spec->type_id =  $data->type_id;
        } else {
            return self::errorNumb(3,'所属于类型为空');
        }
        $spec->order =  $data->order;
        //成功后获取id
        if( $spec->save()){

            $item = $data->item;

            $itemstrs = explode(',',$item);

            $specmod = SpecItem::where( 'spec_id', $id )->get();

            foreach($itemstrs as $k=>$v){
                //不为空就修改
                if(!empty($specmod[$k])){

                    $specmod[$k]->item = $v;
                    $specmod[$k]->save();

                }else{
                    //不然就添加
                    DB::table('spec_item')->insert(
                        [
                            'item'=> $v,
                            'spec_id' => $id,
                        ]
                    );
                }

            }
            $data = self::errorNumb(1,'修改成功');
        } else {
            $data = self::errorNumb(0,'修改失败');
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
        //同时删除
        if (SpecItem::where('spec_id', $id)->delete() &&  Spec::destroy([$id])){

              $data = self::errorNumb(1,'删除成功');

        }else {

            $data = self::errorNumb(0,'删除失败');
        }
             return $data;
    }
    /**
     * 错误信息
     * @param $status
     * @param $msg
     * @return array
     */
    public function errorNumb( $status ,$msg)
    {
        $data = [
            'status' => $status,
            'msg'    => $msg
        ];
         return $data;
    }
}
