<?php

namespace App\Http\Controllers\Admin;

use App\Models\Carousel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CarouselController extends Controller
{
    /**
     * @return  view    轮播图管理列表页
     */
    public function index(Request $request)
    {
        $carousel = Carousel::orderBy('orderby')
            ->where(function($query) use ($request){
                // 搜索关键词
                $keyword = $request->input('keyword');
                if(!empty($keyword)){
                    // 模糊搜索
                    $query->where('desc','like','%'.$keyword.'%');
                }
            })->paginate(5);
        $type = ['0'=>'女士','1'=>'男士','2'=>'创意生活'];
        $status = ['0'=>'显示','1'=>'不显示'];
        return view('admin.main.carousel.index',compact('carousel','request','type','status'));
    }

    /**
     * @return  view    轮播图添加页
     */
    public function create()
    {
        return view('admin.main.carousel.add');
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function store(Request $request)
    {
        //轮播图添加
        $carousel = new Carousel();
        $carousel->img = $request->input('img');
        $carousel->type_id = $request->input('type_id');
        $carousel->link = $request->input('link');
        $carousel->desc = $request->input('desc');
        $carousel->orderby = $request->input('orderby');

        if($carousel->save()){
            return 1;
        }else{
            return 2;
        }
    }

    /**
     * @return  view    轮播图修改页
     */
    public function edit()
    {
        return view('admin.main.carousel.edit');
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
     * destroy  轮播图删除
     *
     * @param   $request    array   获取请求头信息
     *
     */
    public function destroy(Request $request)
    {
        //删除id
    }
}
