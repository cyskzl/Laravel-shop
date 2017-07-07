<?php

namespace App\Http\Controllers\Admin;

use App\Models\Carousel;
use App\Models\Category;
use App\Models\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission;

class CarouselController extends Controller
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
     * @return  view    轮播图管理列表页
     */
    public function index(Request $request)
    {
        //判断是否有权限访问列表
		$this->perms->adminPerms('admin, goods', 'carouse_list');

        $carousel = Carousel::orderBy('orderby','desc')
            ->where(function($query) use ($request){
                // 搜索关键词
                $keyword = $request->input('keyword');
                if(!empty($keyword)){
                    // 模糊搜索
                    $query->where('desc','like','%'.$keyword.'%');
                }
            })->paginate(5);

        return view('admin.main.carousel.index',compact('carousel','request'));
    }

    /**
     * @return  view    轮播图添加页
     */
    public function create()
    {
        //判断是否有权限添加
		$this->perms->adminPerms('admin, goods', 'create_carouse');

        //获取所有cate_id为0的
        $cates = Category::where('pid', '=', '0')->get();
        return view('admin.main.carousel.add', ['cates' => $cates]);
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
        $carousel->cate_id = $request->input('cate_id');
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
        //判断是否有权限修改
		$this->perms->adminPerms('admin, goods', 'edit_carouse');
        //获取所有cate_id为0的
        $cates = Category::where('pid', '=', '0')->get();
        $carousel =Carousel::find($id);
        return view('admin.main.carousel.edit',compact('carousel','cates'));
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
        $car['cate_id'] = $request->input('cate_id');
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
    public function destroy(Request $request,$id)
    {
        //判断是否有权限删除
		$error = $this->perms->adminDelPerms('admin, goods', 'delete_carousel');
        if ($error){
            return 2;
        }
        //删除id,取单一字段
        $old_img = Carousel::where('id','=',$id)->pluck('img')->first();
        $img = './'.trim($old_img,',');
        unlink($img);
        $del_car = Carousel::where('id','=',$id)->delete();
        if($del_car){
            return 1;
        }else {
            return 2;
        }
    }
}
