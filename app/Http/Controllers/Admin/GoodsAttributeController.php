<?php
namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\GoodsAttribute;
use App\Http\Controllers\Controller;
use App\Permission;

class GoodsAttributeController extends Controller
{

    protected $perms;

	public function __construct()
	{
		$this->perms = new Permission;
	}

    /**
     * 显示商品属性列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //判断是否有权限访问列表
		$this->perms->adminPerms('admin, goods', 'goodsAttribute_list');

        //type模型表查询
        $typeinfos = DB::table('goods_type')->select('id', 'name')->get();
        //分页查询以keyword为搜索关键字
        $goodsattrs = GoodsAttribute::orderBy('order', 'desc')->where(function ($query) use($request) {
            //分类检索
            $typename = $request->input('typename');
            if (!empty($typename)) {
                $query->where('type_id', 'like', '%' . $typename . '%');
            }
            //关键字
            $keyword = $request->input('keyword');
            //检测参数
            if (!empty($keyword)) {
                $query->where('attr_name', 'like', '%' . $keyword . '%');
            }
        })->paginate(10);
        return view('admin.main.goods.goodsattribute.index', ['request' => $request, 'goodsattrs' => $goodsattrs, 'typeinfos' => $typeinfos]);
    }

    /**
     * 显示添加商品属性模板
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //判断是否有权限添加
		$this->perms->adminPerms('admin, goods', 'create_goodsAttribute');

        $typeinfos = DB::table('goods_type')->select('id', 'name')->get();
        return view('admin.main.goods.goodsattribute.create', ['typeinfos' => $typeinfos]);
    }

    /**
     *
     * 添加商品属性
     * @param Request $request
     * @return array|mixed
     */
    public function store(Request $request)
    {
        $data = json_decode($request->json);
        $goodsattribute = new GoodsAttribute();
        if ($data->type_id) {
            $goodsattribute->type_id = $data->type_id;
        } else {
            return self::errorNumb(2, '所属类型不能为空');
        }
        $goodsattribute->attr_index = $data->attr_index;
        $goodsattribute->attr_input_type = $data->attr_input_type;
        $goodsattribute->attr_values = $data->attr_values;
        if ($data->attr_name) {
            $goodsattribute->attr_name = $data->attr_name;
        } else {
            return self::errorNumb(3, '属性名称不能为空');
        }
        //待修改
        $goodsattribute->attr_type = 0;
        if ($goodsattribute->save()) {
            return self::errorNumb(0, '添加成功');
        } else {
            return self::errorNumb(1, '添加失败');
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }
    /**
     * 显示修改商品属性模板
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //判断是否有权限添加
		$this->perms->adminPerms('admin, goods', 'edit_goodsAttribute');

        $typeinfos = DB::table('goods_type')->select('id', 'name')->get();
        $goodsattribute = GoodsAttribute::find($id);
        //        dd($goodsattribute);
        return view('admin.main.goods.goodsattribute.edit', ['typeinfos' => $typeinfos, 'goodsattribute' => $goodsattribute]);
    }

    /**
     *
     * 更新商品属性模板
     * @param Request $request
     * @param $id
     * @return array|mixed
     */
    public function update(Request $request, $id)
    {
        $data = json_decode($request->json, true);
        //过滤id
        unset($data['attr_id']);
        if (GoodsAttribute::where('attr_id', $id)->update($data)) {
            $data = self::errorNumb(0, '修改成功');
        } else {
            $data = self::errorNumb(1, '修改失败');
        }
        return $data;
    }

    /**
     * 删除商品属性
     * @param $id
     */
    public function destroy($id)
    {
        //判断是否有权限删除
		$error = $this->perms->adminDelPerms('admin, goods', 'delete_goodsAttribute');
        if ($error){
            //$error json数据  success=>错误码  info=>错误提示信息  如要返回的不是json数据请先转换
            $json = json_decode($error);
            $data = self::errorNumb($json->success, $json->info);
            return $data;
        }

        if (GoodsAttribute::destroy([$id])) {
            $data = self::errorNumb(0, '删除成功');
        } else {
            $data = self::errorNumb(1, '删除失败');
        }
        return $data;
    }

    /**
     * 错误信息
     * @param $status
     * @param $msg
     * @return array
     */
    public function errorNumb($status, $msg)
    {
        $data = ['status' => $status, 'msg' => $msg];
        return $data;
    }

}
