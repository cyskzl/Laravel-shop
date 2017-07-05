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

    public function index(Request $request)
    {
        //判断是否有权限访问列表
        $this->perms->adminPerms('admin, goods', 'goodstag_list');

        $tags  = GoodsTag::orderBy('tag_id', 'desc')->paginate(10);


        return view('admin.main.goodstag.index', compact('tags','request'));
    }

    public function create()
    {

        return  view('admin.main.goodstag.create' );
    }
    public function store(Request $request)
    {
        //判断是否有权限修改
        $this->perms->adminPerms('admin,goods', 'create_goodstag');
        $data = json_decode($request->json,true);
        $tags = new GoodsTag();
        $tags->tag_name = $data['tag_name'];
        if($tags->save()){
            $data = [
                'status' => 1,
                'msg'    => '添加成功'
            ];
        } else {
            $data = [
                'status' => 2,
                'msg'    => '添加失败'
            ];
        }
        return $data;

    }

    public function edit($id)
    {
        //判断是否有权限修改
        $this->perms->adminPerms('admin,goods', 'edit_goodstag');

        $tag = GoodsTag::find($id);


        return view('admin.main.goodstag.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        if ($id) {
            $data = json_decode($request->json,true);
            $tags = GoodsTag::find($id);
            $tags->tag_name = $data['tag_name'];
            if($tags->save()){
                $msg = [
                    'status'  => '0',
                    'success' => '修改成功'
                ];
            } else {
                $msg = [
                    'status'  => '1',
                    'success' => '修改失败'
                ];
            }
        } else {
            $msg = [
                'status'  => '2',
                'success' => '修改失败,请稍后再试!'
            ];
        }
        return $msg;
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
