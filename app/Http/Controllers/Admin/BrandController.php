<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //分页查询以keyword为搜索关键字
        $brands= Brand::orderBy('sort', 'desc')
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('name','like','%'.$keyword.'%');
                }
            })->paginate(10);

        return view('admin.main.goods.brand.index', ['request' => $request, 'brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.main.goods.brand.create');
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
        $brand = new Brand;
        $brand->name = $data->name;
        $brand->url = $data->url;
        $brand->logo = $data->img;
        $brand->sort = $data->sort;
        $brand->desc = $data->desc;
        if( $brand->save() ){
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
        $brand = Brand::find($id);
        return view('admin.main.goods.brand.edit', [ 'brand' => $brand]);
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
        $data = json_decode($request->json, true);
        //如果接收的图片有值就销毁ID加入数据库
        //没有值就删除logo标签不加数据库
        if($data['logo']){
            unset($data['id']);
        } else {
            unset($data['id']);
            unset($data['logo']);
        }
//        dd($data);
        if(Brand::where('id', $id)->update($data)){
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        $logo = '.'.rtrim($brand->logo, ',');
        //删除图片
        if(Brand::destroy([$id]) && unlink($logo)){
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
