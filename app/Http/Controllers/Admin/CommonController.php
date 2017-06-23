<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
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
                          'status' => 0,
                          'msg'   => '图片删除成功',
                          'path'  => $upname,
                    ];
               } else {
                   $data = [
                       'status' => 1,
                       'msg'   => '图片删除失败,请稍后重试',
                       'path'  => $upname,
                   ];
               }

           }
           return $data;
        }

    }

    /**
     *  ajax请求一个字段修改数据库值
     * 字段名就是路由的名字/ajax/{fieldname}/{tablename}
     * @param Request $request
     * @param $tablename  表名
     * @param $fieldname 传入字段名
     * @return array
     */
    public function ajax(Request $request, $fieldname, $tablename)
    {
        $fieldname = $request->route('fieldname');
        $tablename = $request->route('tablename');
//        dd($tablename);
        $data = $request->all();
//        dd($data);
        //判断表名
        switch($tablename){
            case 'spec':
                $specdata = spec::findOrFail($request->id);
                break;
            case 'goods_attribute':
                $specdata = GoodsAttribute::findOrFail($request->id);
                break;
            case 'brand':
                $specdata = Brand::findOrFail($request->id);
                break;
        }

        $specdata->$fieldname = $request->value;
        if ( $specdata->save() ){
            $data = [
                'status' => 1,
                'msg'    => '插入成功'
            ];
        } else {
            $data = [
                'status' => 0,
                'msg' => '插入失败'
            ];
        }
        return $data;
    }
}
