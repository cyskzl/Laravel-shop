<?php

namespace App\Http\Controllers\admin;

use App\Models\GoodsTabCate;
use Illuminate\Http\Request;
use App\Permission;
use App\Http\Requests;
use App\Models\Category;
use App\Http\Controllers\Controller;

class GoodsTabCateController extends Controller
{
    protected $perms;

    public function __construct()
    {
        $this->perms = new Permission;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //判断是否有权限访问列表
        $this->perms->adminPerms('admin, goods', 'goods_tab_cate_list');

        $goodstabcate= GoodsTabCate::orderBy('id', 'desc')
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('name','like','%'.$keyword.'%');
                }
            })->paginate(10);


        return view('admin.main.goods.tabcate.index', compact('goodstabcate','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fatcates   =  Category::where('pid', '=', '0')->select()->get();
        return view('admin.main.goods.tabcate.create', compact('fatcates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = json_decode($request->json,true);
        $goodstabcate = new GoodsTabCate();
        $goodstabcate->name = $data['name'];

        //3级分类不能为空
        if(!empty($data['cat_id_03'])){
            if($data['cat_id_03'] !== ''){
                //拼接
                $cate = $data['cat_id'].'_'.$data['cat_id_02'].'_'.$data['cat_id_03'];
            }
        } else if(!empty($data['cat_id_02'])){
            //2级分类不能为空
            if($data['cat_id_02'] !== ''){
                $cate = $data['cat_id'].'_'.$data['cat_id_02'];
            }
        } else {
            $cate = $data['cat_id'];
        }

        $goodstabcate->cat_id = $cate;

        if($goodstabcate->save()){
            $data = [
                'status' => 1,
                'msg'    => '添加成功'
            ];
        } else {
            $data = [
                'status' => 2,
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
        //判断是否有权限修改
        $this->perms->adminPerms('admin,goods', 'edit_goods_tab_cate');

        $goodscate = GoodsTabCate::find($id);
        //查询所有的顶级id
        $fatcates   =  Category::where('pid', '=', '0')->select()->get();
        //获取3级id的信息
        $threecate = Category::find($goodscate->cat_id);
        //通过3级id查pid上一级的信息
        $twocates = Category::where('id','=',$threecate->pid)->first();

        $one = $twocates->pid;
        $two = $twocates->id;
        $three = $goodscate->cat_id;

        return view('admin.main.goods.tabcate.edit', compact('one','two','three', 'fatcates','goodscate'));

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
        //判断是否有权限删除
        $error = $this->perms->adminDelPerms('admin, goods', 'delete_goods_tab_cate');
        if ($error) {
            return $error;
        }
        if (GoodsTabCate::destroy([$id])) {
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
