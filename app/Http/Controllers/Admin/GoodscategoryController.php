<?php
namespace App\Http\Controllers\Admin;

use App\Models\CateMiddleGoods;
use Illuminate\Http\Request;
use DB;
use Storage;
use App\Http\Requests;
use App\Models\Category;
use App\Models\GoodsTag;
use App\Http\Controllers\Controller;
class GoodscategoryController extends Controller
{
    /**
     * @return  view    商品分类列表页
     */
    public function index(Request $request)
    {
        //分页查询以keyword为搜索关键字
        $cate = Category::select(DB::raw('*, concat(level,",",id) as paths '))->orderBy('paths', 'asc')
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
        if(!empty($cates)){
            return view('admin.main.goodscategory.index', ['cates' => $cates, 'request' => $request]);
        }

    }

    /**
     * 添加数据
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $tags = json_decode($request->tags, true);

        //插入数据
        $data = self::tree($request);
//        $cate = new Category();
        //是否有status这个键
        if(array_key_exists('status', $data)){
            return $data;
        }
            //保存
        $id = DB::table('goods_category')->insertGetId($data);
            if ($id) {
                $cate =Category::find($id);
                if(!empty($tags)){
                    //添加关联表tags_id  cate_middle_tags
                    $cate->tags()->sync($tags);
                }

                $data = [
                    'status' => 0,
                    'msg'    => '添加成功'
                ];
            } else {
                $data = [
                    'status' => 1,
                    'msg'    => '添加失败'
                ];
            }

        return $data;
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function create()
    {
        //商品分类添加
        $cates = self::getCates();
        $tags = GoodsTag::all();

        return view('admin.main.goodscategory.create', ['tags' => $tags,'cates' => $cates]);
    }

    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {

    }

    /**
     * @return  view    商品分类修改页
     */
    public function edit($id)
    {
        $info = Category::find($id);

        //pid路径添加
        $cates = self::getCates();
        $img = rtrim($info->img, ',');
        //所有的标签
        $tags = GoodsTag::all();
        //已有的值
        $catemiddle = CateMiddleGoods::where( 'cate_id', '=', $id)->get();

        return view('admin.main.goodscategory.edit', ['catemiddle' => $catemiddle,'tags' => $tags,'tags' => $tags,'cates' => $cates, 'info' => $info, 'img' => $img]);
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

        $tags = json_decode($request->tags, true);
//        dd($tags);
        //是否有status这个键
        if(array_key_exists('status', $data)){
            return $data;
        }
        //保存
        if(Category::where('id', $id)->update($data)){
            $cate =Category::find($id);
            if(!empty($tags)){
                //添加关联表tags_id  cate_middle_tags
                $cate->tags()->sync($tags);
            }
            $data = [
                'status' => 0,
                'msg'    => '添加成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'msg'    => '添加失败'
            ];
        }
        return $data;
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

        $row = Category::where('level', 'like', '%'.$id.'%')->get();

        if(!$row->count()){
            $img = $cates->img;
            if(!empty($img)){
                @unlink('./'.date('Ymd').$img);
            }
            Category::destroy([$id]);
            //删除标签表
            CateMiddleGoods::where('cate_id','=', $id)->delete();
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
        $data = json_decode($request->json,true);

        if( array_key_exists('_token', $data) ||  array_key_exists('_method', $data) ||  array_key_exists('tag_id[]', $data)){
            unset($data['_token']);
            unset($data['_method']);
            unset($data['tag_id[]']);
        }

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

        if(!empty($data['name']) ){
            $category->name = $data['name'];
        } else {
            $data = [
                'status' => 3,
                'msg'    => '分类名称不能为空'
            ];
            return $data;
        }
        $category->pid = $data['pid'];
        $category->level = $data['level'];
        $category->img = $data['img'];
        $category->describe = $data['describe'];
        return $data;
    }
}