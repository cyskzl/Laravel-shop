<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Spec;
use App\Models\SpecItem;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SpecController extends Controller
{
    public function index(Request $request)
    {

        $specs = Spec::orderBy('id', 'desc')->paginate(10);
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
