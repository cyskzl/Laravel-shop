<?php

namespace App\Http\Controllers\Admin;

use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdvertisementController extends Controller
{
    /**
     * 显示列表视图
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //分页查询以keyword为搜索关键字
        $advertisements = Advertisement::orderBy('sort', 'desc')
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
//                dd($keyword);
                //检测参数
                if(!empty($keyword)){
                    $query->where('name','like','%'.$keyword.'%');
                }
            })->paginate(10);

        return view('admin.main.advertisement.index', ['request' => $request, 'advertisements' => $advertisements]);
    }

    /**
     * 显示添加视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $cates = Category::where('pid', '=', '0')->get();
        return view('admin.main.advertisement.create',['cates' => $cates]);
    }

    /**
     * 添加品牌
     * @param Request $request
     * @return array|mixed
     */
    public function store(Request $request)
    {
        $data = json_decode($request->json);
        $advertisement = new Advertisement;
        if($data->name){
            $advertisement->name = $data->name;
        } else {
            return self::errorNumb(2,'广告名称不能为空');
        }
        if($data->top_cate_id){
            $advertisement->top_cate_id = $data->top_cate_id;
        } else {
            return self::errorNumb(3,'请选择属于分类');
        }
        $advertisement->url = $data->url;
        $advertisement->logo = $data->img;
        $advertisement->sort = $data->sort;
        $advertisement->desc = $data->desc;
        if( $advertisement->save() ){
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
        $advertisement = Advertisement::find($id);
        $cates = Category::where('pid', '=', '0')->get();
        return view('admin.main.advertisement.edit',['cates' => $cates, 'advertisement' => $advertisement]);
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
//        dd($data);
        if($data['logo']){
            unset($data['id']);
        } else {
            unset($data['id']);
            unset($data['logo']);
        }
//        dd($data);
        if(Advertisement::where('id', $id)->update($data)){

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
        $advertisement = Advertisement::find($id);
        $logo = '.'.rtrim($advertisement->logo, ',');
        //删除图片
//        dd($logo);
        if(Advertisement::destroy([$id])){
            if($advertisement->logo){
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
