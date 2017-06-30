<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;

class BrandController extends Controller
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
     * 显示列表视图
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //判断是否有权限访问列表
        $this->perms->adminPerms('admin,goods', 'brand_list');

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
     * 显示添加视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //判断是否有权限添加
        $this->perms->adminPerms('admin,goods', 'create_brand');
        return view('admin.main.goods.brand.create');
    }

    /**
     * 添加品牌
     * @param Request $request
     * @return array|mixed
     */
    public function store(Request $request)
    {
        $data = json_decode($request->json);
        $brand = new Brand;
        if($data->name){
            $brand->name = $data->name;
        } else {
            return self::errorNumb(2,'品牌名称不能为空');
        }

        $brand->url = $data->url;
        $brand->logo = $data->img;
        $brand->sort = $data->sort;
        $brand->desc = $data->desc;
        if( $brand->save() ){
            $data = self::errorNumb(0,'添加成功');
        } else {
            $data = self::errorNumb(1,'添加失败');
        }
        return $data;
    }

    /**
     * 显示修改视图
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //判断是否有权限修改
        $this->perms->adminPerms('admin,goods', 'edit_brand');

        $brand = Brand::find($id);
        return view('admin.main.goods.brand.edit', [ 'brand' => $brand]);
    }

    /**
     *  更新操作
     * @param Request $request
     * @param $id
     * @return array|mixed
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

            $data = self::errorNumb(0,'修改成功');
        } else {
            $data = self::errorNumb(1,'修改失败');
        }
        return $data;
    }

    public function show(){}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //判断是否有权限删除
		$error = $this->perms->adminDelPerms('admin, goods', 'delete_brand');
        if ($error){
            $json = json_decode($error);
            $data = self::errorNumb($json->success, $json->info);
            return $data;
        }
        $brand = Brand::find($id);
        $logo = '.'.rtrim($brand->logo, ',');
        //删除图片
//        dd($logo);
        if(Brand::destroy([$id])){
            if($brand->logo){
                unlink($logo);
            }
            $data = self::errorNumb(0,'删除成功');
        } else {
            $data = self::errorNumb(1,'删除失败');
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
