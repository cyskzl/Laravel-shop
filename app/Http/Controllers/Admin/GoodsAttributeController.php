<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\GoodsAttribute;
use App\Http\Controllers\Controller;

class GoodsAttributeController extends Controller
{
    /**
     * 显示商品属性列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
//        var_dump($request->all());
        //type模型表查询
        $typeinfos  =  DB::table('goods_type')->select('id', 'name')->get();
        //分页查询以keyword为搜索关键字
        $goodsattrs = GoodsAttribute::orderBy('order', 'desc')
            ->where(function($query) use ($request){
                //分类检索
                $typename= $request->input('typename');
                if(!empty($typename)){
                    $query->where('type_id','like','%'.$typename.'%');
                }
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('attr_name','like','%'.$keyword.'%');
                }
            })->paginate(10);
       return view('admin.main.goods.goodsattribute.index', ['request' => $request, 'goodsattrs' => $goodsattrs, 'typeinfos' => $typeinfos]);
    }

    /**
     * 显示添加商品属性模板
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $typeinfos  =  DB::table('goods_type')->select('id', 'name')->get();
        return view('admin.main.goods.goodsattribute.create', ['typeinfos' => $typeinfos]);
    }

    /**
     *
     * 添加商品属性
     * @param Request $request
     * @return array|mixed
     */
    public function store(Request $request)
    {
        $data = json_decode($request->json);

        $goodsattribute = new GoodsAttribute;
        $goodsattribute->type_id = $data->type_id;
        $goodsattribute->attr_index = $data->attr_index;
        $goodsattribute->attr_input_type = $data->attr_input_type;
        $goodsattribute->attr_values = $data->attr_values;
        $goodsattribute->attr_name = $data->attr_name;
        //待修改
        $goodsattribute->attr_type = 0;

        if($goodsattribute->save()){
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

    }

    /**
     * 显示修改商品属性模板
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $typeinfos  =  DB::table('goods_type')->select('id', 'name')->get();
        $goodsattribute  = GoodsAttribute::find($id);
//        dd($goodsattribute);
        return view('admin.main.goods.goodsattribute.edit', ['typeinfos' => $typeinfos, 'goodsattribute' => $goodsattribute]);
    }

    /**
     *
     * 更新商品属性模板
     * @param Request $request
     * @param $id
     * @return array|mixed
     */
    public function update(Request $request, $id)
    {
        $data = json_decode($request->json, true);
        //过滤id
        unset($data['attr_id']);
        if(GoodsAttribute::where('attr_id', $id)->update($data)){
            $data = [
                'status' => 0,
                'msg'    => '修改成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'msg'    => '修改失败'
            ];
        }
        return $data;
    }


    /**
     * 删除商品属性
     * @param $id
     */
    public function destroy($id)
    {
       if(GoodsAttribute::destroy([$id])){
           $data = [
               'status' => 0,
               'msg'    => '删除成功'
           ];
       } else {
           $data = [
               'status' => 1,
               'msg'    => '删除失败'
           ];
       }
       return $data;
    }
}
