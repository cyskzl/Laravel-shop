<?php

namespace App\Http\Controllers\Admin;

use App\Models\GoodsComment;
use App\Models\GoodsCommentReply;
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
        $data = GoodsComment::all();

//        dd($data);
        return view('admin.main.comment.index',compact('data'));
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

    public function show($id)
    {

       $data =  GoodsCommentReply::where('comment_id', '=', $id)->get();

       dd($data);

    }

}
