<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\GoodsType;
use DB;

class GoodsTypeController extends Controller
{
    /**
     * 显示类型页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $goodstypes = GoodsType::orderBy('id', 'desc')->paginate(10);

       return view('admin.main.goods.type.index', ['goodstypes' => $goodstypes]);
    }

    /**
     * 插入数据
     * @param Request $request
     */
    public function store(Request $request)
    {
        $goodstype = new GoodsType;
        $goodstype->name = $request->input('name');
        if( $goodstype->save() ){
            $data = [
                'id'     => $goodstype->id,
                'name'     => $goodstype->name,
                'status' => 0,
                'msg'    => '插入成功'
             ];
        } else {
            $data = [
                'status' => 1,
                'msg'    => '插入失败'
            ];
        }
        return $data;
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * 返回修改视图
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $info = GoodsType::find($id);

        return view('admin.main.goods.type.edit', ['info' => $info]);
    }

    /**
     *
     * 更新操作
     * @param Request $request
     * @param $id
     * @return array
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_method', '_token']);

        if (DB::table('goods_type')->where('id', $id)->update($data)) {
            $data = [
                'status' => 0,
                'msg'    => '修改成功'
            ];
        }
        $data = [
            'status' => 1,
            'msg'    => '修改失败'
        ];

        return  $data;
    }

    /**
     * 删除操作
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        if(GoodsType::destroy([$id])){
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

        return $data;
    }
}
