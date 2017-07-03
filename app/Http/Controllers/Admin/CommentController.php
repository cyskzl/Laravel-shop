<?php

namespace App\Http\Controllers\Admin;

use App\Models\GoodsComment;
use App\Models\GoodsCommentReply;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Permission;

class CommentController extends Controller
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
     * @return  view    商品评论列表页
     */
    public function index(Request $request)
    {
        //判断是否有权限访问列表
		$this->perms->adminPerms('admin, comment', 'comment_list');

        //获取搜索提交过来的会员名
        $username = $request->input('username');

        //获取搜索提交过来的内容
        $content = $request->input('content');

        //查询评论信息
            $data = GoodsComment::where('users_register.email','like','%'.$username.'%')
                ->where('users_register.tel','like','%'.$username.'%')
                ->where('goods_comment.comment_info','like','%'.$content.'%')
                ->join('users_register','goods_comment.user_id','=','users_register.id')
                ->join('goods','goods_comment.goods_id','=','goods.goods_id')
                ->select('goods_comment.*','users_register.email','goods.goods_name')
                ->get();

        //统计总数
            $sum = count($data);

        return view('admin.main.comment.index',compact('data','sum'));
    }

    /**
     * destroy  商品评论删除
     *
     * @param   $request    array   获取请求头信息
     *
     */
    public function destroy(Request $request)
    {
        //判断是否有权限删除
        $error = $this->perms->adminDelPerms('admin, comment', 'delete_comment');
        if ($error){
            $status = 0;
            return $status;
        }

        $id = trim($request->input('id'),',');


//        foreach (explode(',',$id) as $value){
//
//            $commentlist = GoodsComment::find($value)->reply->toArray();
//
//
//        }

        $arrid = explode(',',$id);

        $status = 0;

        foreach ($arrid as $value){

           $sta = GoodsComment::where('id',$value)->delete();

           $stat = GoodsCommentReply::where('comment_id',$value)->delete();

           if(!$sta){
               $status = 1;
           }

        }

        return $status;
    }

    public function show($id)
    {

//       $data =  GoodsCommentReply::join('users_register','goods_comment_reply.user_id','users_register.id')
//                                    ->where('comment_id', '=', $id)->get();

       return view('admin.main.comment.show');

    }

    public function store(Request $request)
    {


    }


    public function edit($id)
    {
        //判断是否有权限修改
		$this->perms->adminPerms('admin, comment', 'edit_comment');

        $data = GoodsComment::findOrfail($id);

        $show = $data->is_show;

        switch ($show){
            case 0:
                $show = 1;
                break;
            case 1:
                $show = 0;
                break;
            default:
                return '{"error":"1"}';
                break;
        }

        $result = GoodsComment::where('id','=',$id)->update(['is_show'=>$show]);

        if($result == 0){
            return '{"error":"2"}';
        }

        return '{"error":"0"}';
    }
}
