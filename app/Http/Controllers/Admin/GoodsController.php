<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Goods;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    /**
     * @return  view    商品列表页
     */
    public function index(Request $request)
    {
        //分页查询以keyword为搜索关键字
        $goods= Goods::orderBy('sort', 'desc')
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('goods_name','like','%'.$keyword.'%');
                }
            })->paginate(10);
        return view('admin.main.goods.index', ['request' => $request, 'goods' =>$goods ]);
    }

    /**
     * @return  view    商品添加页
     */
    public function create()
    {
        $fatcates   =  DB::table('goods_category')->where('pid', '=', '0')->select()->get();
        $brands  =  DB::table('brand')->select()->get();
        return view('admin.main.goods.create', ['brands' => $brands, 'fatcates' => $fatcates]);
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function store(Request $request)
    {

        dd($request->all());
    }

    /**
     * @return  view    商品修改页
     */
    public function edit()
    {
        return view('admin.main.goods.edit');
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
     * destroy  商品删除
     *
     * @param   $request    array   获取请求头信息
     *
     */
    public function destroy(Request $request)
    {
        //删除id
    }




}
