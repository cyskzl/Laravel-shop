<?php

namespace App\Http\Controllers\Admin;

use App\Models\Advertisement;
use App\Models\Carousel;
use App\Models\Category;
use App\Models\GoodsTabCate;
use App\Models\TrendPromotion;
use DB;
use App\Models\Brand;
use App\Models\Goods;
use App\Models\Spec;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\GoodsAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

/**
 * Class CommonController
 * @package App\Http\Controllers\Admin
 * method  请求为get的为删除图片 post的为获取路径，文件名
 */
class CommonController extends Controller
{
    /**
     * 上传加删除
     * @param Request $request
     * @return string
     */
    public function upload(Request $request)
    {
        $uploadname = $request->route( 'uploadname' );
        //获取文件名
        if($request->isMethod('post')){
            //获取上传的对象
            $file = Input::file('Filedata');
            if( $file -> isValid() ){ //判断是否存在
                $entension = $file -> getClientOriginalExtension();//上传文件的后缀
                //生成随机命名
                $newName = date('YmdHis').mt_rand(1000,9999).'.'.$entension;
                //移动到uploads文件夹
                $path = $file -> move(public_path().'/Uploads/'.$uploadname.'/', $newName);
                //拼接路径+文件名
                $filepath = '/Uploads/'.$uploadname.'/' .$newName;
                //返回给视图
                return $filepath;
            }

        } else {
            //get请求
           if( $request->isMethod('get') ){
               //获取文件名
               $uppaths = $request->all();
                $upname = $uppaths['data'];
                //删除文件
               if(@unlink('.'.$upname)){
                    $data = [
                          'status' => 1,
                          'msg'   => '图片删除成功',
                          'path'  => $upname,
                    ];
               } else {
                   $data = [
                       'status' => 0,
                       'msg'   => '图片删除失败,请稍后重试',
                       'path'  => $upname,
                   ];
               }

           }
           return $data;
        }

    }

    /**
     * 是否切换ajax请求
     * @param Request $request
     * @return array
     * 详细看org/ajax/ajax.js
     */
    public function ajax(Request $request)
    {
        $data = $request->all();
        //判断表名
//        dd($data);
        switch($data['tablename']){
            case 'spec':
                $specdata = spec::findOrFail($data['id']);
                break;
            case 'goods_attribute':
                $specdata = GoodsAttribute::findOrFail($data['id']);
                break;
            case 'brand':
                $specdata = Brand::findOrFail($data['id']);
                break;
            case 'goods':
                $specdata = Goods::findOrFail($data['id']);
                break;
            case 'carousels':
                $specdata = Carousel::findOrFail($data['id']);
                break;
            case 'goods_tab_cate':
                $specdata = GoodsTabCate::findOrFail($data['id']);
                break;
            case 'advertisement':
                $specdata = Advertisement::findOrFail($data['id']);
                break;
            case 'trendpromotion':
                $specdata = TrendPromotion::findOrFail($data['id']);
                break;
        }

        $fieldname = $data['fieldname'];

        //获取数据库值，并修改
        if($data['val'] == ''){
            switch( $specdata->$fieldname ){
                //成功
                case '1':
                    $specdata->$fieldname = 0;
                    break;
                case '0':
                    $specdata->$fieldname = 1;
                    break;
            }
        } else {
            //onchange 修改排序
            $specdata->$fieldname = $data['val'] ;
        }
        //保存并返回
        if ( $specdata->save() ){
            $data = [
                'status' => 1,
                'msg'    => '插入成功',
                'val'    => $specdata->$fieldname
            ];
        } else {
            $data = [
                'status' => 0,
                'msg' => '插入失败'
            ];
        }
        return $data;
    }

    public function ajaxTwoCate(Request $request)
    {
        $fatcate = $request->input('fatcate');
       
        if($fatcate){

            $data  =  Category::where('level', '=', '0,'.$fatcate)->get();

        } else {
            $data = [
                'status' => 0,
                'msg' => '获取失败'
            ];

        }
        return $data;
    }
    /**
     * 商品添加修改获取分类
     * @param Request $request
     * @return array 失败信息
     */
    public function ajaxCate(Request $request)
    {
       $three = $request->input('three');
       if($three){

           $data  =  Category::where('level', 'like', '0,%,'.$three)->get();
//            dd($data);
       } else {
           $data = [
               'status' => 0,
               'msg' => '获取失败'
           ];
       }
        return $data;
    }

    /**
     * 商品添加修改获取商品规格
     * @param Request $request
     * @return mixed
     */
    public function ajaxModel(Request $request)
    {
        $type = $request->input('type');

        //返回分组规格对应的名称与规格
        $spec = Spec::select(DB::raw('spec.*, spec_item.spec_id, group_concat(spec_item.item) AS specitem , group_concat(spec_item.id) AS specid'))
            ->join('spec_item', 'spec.id', '=', 'spec_item.spec_id')
            ->where('type_id','=',$type)
            ->groupby('spec.name')
            ->get();
        return $spec;
    }

    /**
     * 商品添加修改获取商品属性
     * @param Request $request
     * @return mixed
     */
    public function ajaxAttr(Request $request)
    {
        $type = $request->input('type');
        $attr = GoodsAttribute::where('type_id', '=', $type)
            ->get();
        return $attr;
    }

}
