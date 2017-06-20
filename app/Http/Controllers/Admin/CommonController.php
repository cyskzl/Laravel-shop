<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    /**
     *  上传文件
     *  return $filepath 文件路径
     */
    public function upload()
    {
        //获取上传的对象
        $file = Input::file('Filedata');
        if( $file -> isValid() ){ //判断是否存在
            $entension = $file -> getClientOriginalExtension();//上传文件的后缀

            $newName = date('YmdHis').mt_rand(1000,9999).'.'.$entension;

            $path = $file -> move(public_path().'/Uploads', $newName);

            $filepath = '/Uploads/'.$newName;

            return $filepath;
        }
    }
}
