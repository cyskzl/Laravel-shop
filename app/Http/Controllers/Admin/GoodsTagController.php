<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GoodsTag;
use App\Permission;

class GoodsTagController extends Controller
{
    protected $perms;

	public function __construct()
	{
		$this->perms = new Permission;
	}

    public function index()
    {
        //判断是否有权限访问列表
        $this->perms->adminPerms('admin, goods', 'goodstag_list');

        $tags  = GoodsTag::orderBy('tag_id', 'desc')->paginate(10);


        return view('admin.main.goodstag.index', compact('tags'));
    }

    public function store(Request $request)
    {
        //判断是否有权限修改
        $this->perms->adminPerms('admin,goods', 'create_goodstag');

        $tag = GoodsTag::create(['tag_name'=>$request->tag_name]);

        if($tag){
            $tag['success'] = 1;
            $tag['info'] = '添加成功';

            return json_encode($tag);
        } else {

            $tag['success'] = 0;
            $tag['info'] = '添加失败';
            return json_encode($tag);
        }

    }

    public function edit($id)
    {
        //判断是否有权限修改
        $this->perms->adminPerms('admin,goods', 'edit_goodstag');

        $tag = GoodsTag::where('tag_id','=', $id)->first();

        return view('admin.main.goodstag.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $tag = GoodsTag::where('tag_id', '=', $id)->first();
        if ($tag) {

            $res = $tag->where('tag_id', '=', $id)
                       ->update(['tag_name'=>$request->tag_name]);
            if ($res){
                $error['success'] = 1;
                $error['info']    = '修改成功！';
                return json_encode($error);
            } else {
                $error['success'] = 0;
                $error['info']    = '修改失败！';
                return json_encode($error);
            }
        } else {
            $error['success'] = 0;
            $error['info']    = '修改失败,未找到相关信息！';
            return json_encode($error);
        }
    }

    public function destroy(Request $request, $id)
    {
        //判断是否有权限删除
        $error = $this->perms->adminDelPerms('admin, goods', 'delete_goodstag');
        if ($error) {
            return $error;
        }

        $tag = GoodsTag::where('tag_id', '=', $id)->first();
        if ($tag) {
            $res = $tag->where('tag_id', '=', $id)->delete();
            if ($res) {
                $error['success'] = 1;
                $error['info']    = '删除成功！';
                return json_encode($error);
            } else {
                $error['success'] = 0;
                $error['info']    = '删除失败,请重新尝试删除！';
                return json_encode($error);
            }
        } else {
            $error['success'] = 0;
            $error['info']    = '删除失败,未找到相关信息！';
            return json_encode($error);
        }
    }

}
