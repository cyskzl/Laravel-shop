<?php

namespace App\Http\Controllers\Admin;

use App\Models\Carousel;
use App\Models\Config;
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
    public function edit($id)
    {
        $carousel =Carousel::find($id);
        return view('admin.main.carousel.edit',compact('carousel'));
    }

    /**
     * update   更新修改操作
     *
     * @param   $request    array   获取请求头信息
     *
     * @return  未定义
     */
    public function update(Request $request,$id)
    {
        $img = './'.trim($request->input('old_img'),',');
        unlink($img);
        $car['img'] = $request->input('img');
        $car['type_id'] = $request->input('type_id');
        $car['link'] = $request->input('link');
        $car['desc'] = $request->input('desc');
        $car['orderby'] = $request->input('orderby');

        $bool = Carousel::where('id','=',$id)->update($car);
        if($bool){
            return 1;
        }else{
            return 2;
        }
    }

    public function show(){}
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

    // 修改轮播图排序
    public function orderBy(Request $request)
    {
        $orderby = $request->input('orderby');
        $id = $request->input('id');
        $bool = Carousel::where('id','=',$id)->update(['orderby'=>$orderby]);
        if($bool){
            return 1;
        }else{
            return 2;
        }
    }

    // 修改轮播图状态
    public function status(Request $request)
    {
        $status = $request->input('status');
        $id = $request->input('id');
        $bool = Carousel::where('id','=',$id)->update(['status'=>$status]);
        if($bool){
            return 1;
        }else{
            return 2;
        }
    }
}
