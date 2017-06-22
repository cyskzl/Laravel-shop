<?php

namespace App\Http\Controllers\Admin;

use App\Models\ReceivingAddress;
use App\Models\UserInfo;
use App\Models\UserRegister;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * @return  view    会员列表页
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        if(!$keyword) {
            // 查询用户注册表，得到用户注册信息，并按照ID分组，3条数据为一页
            $userData = UserRegister::orderBy('id', 'desc')->paginate(3);
        }else {
            $userData = UserRegister::where('email','like','%'.$keyword.'%')->paginate(3);

        }
        return view('admin.main.member.index', compact('userData','request'));
    }

    /**
     * @return  view    查看会员详情
     */
    public function show($id)
    {
        // 获取会员注册信息
        $user = UserRegister::find($id);
        // 获取会员详细信息
        $userinfo = $user->userInfo;
//        dd($userinfo);
        // 获取积分详情
        $usercode = $user->userCode;
//        dd($usercode);
        return view('admin.main.member.show',compact('userinfo','user','usercode'));
    }

    /**
     * @return  view    会员添加页
     */
    public function create()
    {
        return view('admin.main.member.add');
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function store(Request $request)
    {
        // 获取ajax请求数据
        $res = $request->all();
//        dd($res);
        $userregister = new UserRegister();
        $userregister -> email = $res['email'];
        $userregister -> tel = $res['tel'];
        $userregister -> password = $res['password'];
        $userregister -> register_ip = $request->ip();
//        dd($userregister);
        // 存入数据库
        if( $userregister->save() ){
            return 1;
        } else {
            return 2;
        }
    }

    /**
     * @return  view    会员修改页
     */
    public function edit($id)
    {
        $user = UserRegister::find($id);
        $userinfo = $user->userInfo;
//        dd($userinfo);
        return view('admin.main.member.edit', compact('userinfo','user'));
    }

    /**
     * update   更新修改操作
     *
     * @param   $request    array   获取请求头信息
     *
     * @return  未定义
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * destroy  会员删除
     *
     * @param   $request    array   获取请求头信息
     *
     * 暂时只删除会员详情表与收货地址表，后续其他与用户表关联表的信息也的进行删除
     */
    public function destroy($id)
    {

        UserInfo::where('user_id','=',$id)->delete();
        ReceivingAddress::where('user_id','=',$id)->delete();
        if (UserRegister::destroy($id))
        {
            return 1;
        }
    }


    public function getAddress(Request $request)
    {
        $id = $request->input('id');
        $userAddress = ReceivingAddress::where('user_id','=',$id)->get();
        return view('admin.main.member.receivingaddress',compact('userAddress'));
    }
    /**
     * @return  view    会员密码修改页
     */
    public function memberPassword()
    {
        return view('admin.main.member.password');
    }

    /**
     * @param   $request    获取请求头信息
     *
     */
    public function updatePassword(Request $request)
    {
        //修改会员密码 =》 会员ID
    }

    /**
     * @return  view    会员已删除列表
     */
    public function memberRecycleBin()
    {
        return view('admin.main.member.recyclebin');
    }

    /**
     * @return  view    会员浏览记录
     */
    public function memberBrowseLog()
    {
        return view('admin.main.member.browselog');
    }

    public function memberCollection()
    {
        return view('admin.main.member.collection');
    }



}
