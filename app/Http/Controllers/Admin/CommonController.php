<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
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

}
