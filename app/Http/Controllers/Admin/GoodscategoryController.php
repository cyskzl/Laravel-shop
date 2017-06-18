<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Models\Category;
use App\Http\Controllers\Controller;

class GoodscategoryController extends Controller
{
    /**
     * @return  view    商品分类列表页
     */
    public function index()
    {
       $cates = self::getCates();
        return view('admin.main.goodscategory.index', ['cates' => $cates]);
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function create(Request $request)
    {
        //商品分类添加
    }



    /**
     * @return  view    商品分类修改页
     */
    public function edit()
    {
        return view('admin.main.goodscategory.edit');
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
     * destroy  商品分类删除
     *
     * @param   $request    array   获取请求头信息
     *
     */
    public function destroy(Request $request)
    {
        //分类删除id
    }

    public function getCates()
    {
        $cates = Category::select(DB::raw('*, concat(level,",",id) as paths '))->orderBy('paths')->get();
        //dd($cates);
        //遍历数组 调整分类名称
        foreach($cates as $key => $value){
            //判断当前的分类是几级分类
            $tmp = count(explode(',', $value->level))-1;
            $prefix = str_repeat('|--', $tmp);
            $value->name = $prefix . $value->name;
        }

        return $cates;
    }
}
