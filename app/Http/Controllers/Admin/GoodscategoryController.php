<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\Category;
use App\Http\Controllers\Controller;
class GoodscategoryController extends Controller
{
    /**
     * @return  view    商品分类列表页
     */
    public function index(Request $request)
    {
        //分页查询以keyword为搜索关键字
        $cate = Category::select(DB::raw('*, concat(level,",",id) as paths '))->orderBy('paths', 'desc')
                ->where(function($query) use ($request){
                    //关键字
                    $keyword = $request->input('keyword');
                    //检测参数
                    if(!empty($keyword)){
                        $query->where('name','like','%'.$keyword.'%');
                    }
                })->paginate(10);

        //遍历数组 调整分类名称
        $cates =  self::trer($cate);
        return view('admin.main.goodscategory.index', ['cates' => $cates, 'request' => $request]);
    }

    /**
     * 添加数据
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //插入数据
        $data = self::tree($request);
        //保存
        if (DB::table('goods_category')->insert($data)) {
            return redirect('admin/goodscategory');
        } else {
            return back();
        }
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function create()
    {
        //商品分类添加
        $cates = self::getCates();

        return view('admin.main.goodscategory.create', ['cates' => $cates]);
    }

    /**
     * 显示页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $cates = self::getCates();
        return view('admin.main.goodscategory.index', ['cates' => $cates]);
    }

    /**
     * @return  view    商品分类修改页
     */
    public function edit($id)
    {
        $info = Category::find($id);
        //pid路径添加
        $cates = self::getCates();
        return view('admin.main.goodscategory.edit', ['cates' => $cates, 'info' => $info]);
    }

    /**
     * update   更新修改操作
     *
     * @param   $request    array   获取请求头信息
     *
     * @return  未定义
     */
    public function update(Request $request, $id)
    {
        //插入数据
        $data = self::tree($request);
        //保存
        if (DB::table('goods_category')->where('id', $id)->update($data)) {
            return 1;
        } else {
            return 2;
        }
    }

    /**
     * 分类删除
     * @param Request $request
     * @param $id 删除id
     * @return int 返回给页面的ajax
     */
    public function destroy(Request $request, $id)
    {
        //分类删除id
        $cates = Category::findOrFail($id);
        $map = "level like '%.$id.%'";
        $row = Category::where('level', 'like', '%'.$id.'%')->get();

        if(!$row->count()){
            $img = $cates->img;
            if(!empty($img)){
                dd($request->deleteFile($img));
            }
            Category::destroy([$id]);
            //没数据返回给页面ajax
            return 2;
        } else {
            //有子类的不能删除返回给ajax做判断
            return 1;
        }
    }

    /**
     * 分类区别层级
     * @return mixed $cates
     */
    public function getCates()
    {
        //归类\
        $cates = Category::select(DB::raw('*, concat(level,",",id) as paths '))->orderBy('paths')->get();

        return self::trer($cates);

    }

    /**
     *  遍历数组 调整分类名称
     * @param $cates
     * @return mixed
     */
    public function trer($cates){
        //遍历数组 调整分类名称
        foreach ($cates as $key => $value) {
            //判断当前的分类是几级分类
            $tmp = count(explode(',', $value->level)) - 1;
            $prefix = str_repeat('├──', $tmp);
            $value->name = $prefix . $value->name;
        }
        return $cates;
    }

    /**
     * 添加数据和更新数据
     * @param Request $request
     * @return array $data
     */
    public function tree(Request $request)
    {
        //清除put和csfr_field的请求
        $data = $request->except(['_method', '_token']);
        //        dd($data);
        $category = new Category();
        //如果顶级分类，pid和level都是0
        if ($data['pid'] == 0) {
            $data['level'] = '0';
        } else {
            //如果不是顶级分类
            //读取父级分类的信息
            $info = Category::find($data['pid']);
            $data['level'] = $info->level . ',' . $info->id;
        }
        $category->pid = $data['pid'];
        $category->level = $data['level'];
        $category->name = $data['name'];
        $category->img = $data['img'];
        $category->describe = $data['describe'];
        return $data;
    }
}