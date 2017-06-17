<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * @return  view    商品评论列表页
     */
    public function index()
    {
        return view('admin.main.comment.index');
    }

    /**
     * destroy  商品评论删除
     *
     * @param   $request    array   获取请求头信息
     *
     */
    public function destroy(Request $request)
    {
        //删除id
    }

}
