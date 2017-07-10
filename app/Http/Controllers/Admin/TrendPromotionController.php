<?php

namespace App\Http\Controllers\Admin;

use App\Models\TrendPromotion;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TrendPromotionController extends Controller
{
    /**
     * 显示列表视图
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //分页查询以keyword为搜索关键字
        $trendpromotion = TrendPromotion::orderBy('sort', 'desc')
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
//                dd($keyword);
                //检测参数
                if(!empty($keyword)){
                    $query->where('name','like','%'.$keyword.'%');
                }
            })->paginate(10);

        return view('admin.main.trendpromotion.index', ['request' => $request, 'trendpromotion' => $trendpromotion]);
    }

    /**
     * 显示添加视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $cates = Category::where('pid', '=', '0')->get();
        return view('admin.main.trendpromotion.create',['cates' => $cates]);
    }

    /**
     * 添加品牌
     * @param Request $request
     * @return array|mixed
     */
    public function store(Request $request)
    {
        $data = json_decode($request->json);
        $trendpromotion = new TrendPromotion;
        if($data->name){
            $trendpromotion->name = $data->name;
        } else {
            return self::errorNumb(2,'名称不能为空');
        }
        if($data->top_cate_id){
            $trendpromotion->top_cate_id = $data->top_cate_id;
        } else {
            return self::errorNumb(3,'请选择属于分类');
        }

        $trendpromotion->img = $data->img;
        $trendpromotion->sort = $data->sort;
        $trendpromotion->desc = $data->desc;
        if( $trendpromotion->save() ){
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
//        dd($id);
        $trendpromotion = TrendPromotion::find($id);
        $cates = Category::where('pid', '=', '0')->get();
        return view('admin.main.trendpromotion.edit',['cates' => $cates, 'trendpromotion' => $trendpromotion]);
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
        if($data['img']){
            unset($data['id']);
        } else {
            unset($data['id']);
            unset($data['img']);
        }
//        dd($data);
        if(TrendPromotion::where('id', $id)->update($data)){

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
        $trendpromotion = TrendPromotion::find($id);
        //是否存在，存在则删除图片
        if($trendpromotion->img){

            $trendcom = rtrim($trendpromotion->img, ',');

            $trends  = explode( ',', $trendcom);

            foreach($trends as $trend){

                unlink('.'.$trend);
            }
        }

        if(TrendPromotion::destroy([$id])){

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
