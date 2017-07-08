<?php

namespace App\Http\Controllers\Admin;

use App\Models\ReceivingAddress;
use App\Models\Region;
use App\Models\UserInfo;
use App\Models\UserRegister;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Support\Facades\Input;

class MemberController extends Controller
{
    protected $perms;

	public function __construct()
	{
		$this->perms = new Permission;
	}

    /**
     * @return  view    会员列表页
     */
    public function index(Request $request)
    {
        //判断是否有权限修改
		$this->perms->adminPerms('admin, member', 'member_list');

        $keyword = $request->input('keyword');

        if(!$keyword) {
            // 查询用户注册表，得到用户注册信息，并按照ID分组，3条数据为一页
            $userData = UserRegister::orderBy('id', 'desc')->paginate(3);
        }else {
            $userData = UserRegister::where('email','like','%'.$keyword.'%')->paginate(3);

        }
        $type = ['0'=>'未激活','1'=>'已激活'];
        return view('admin.main.member.index', compact('userData','request','type'));
    }

    /**
     * @return  view    查看会员详情
     */
    public function show($id)
    {
        //判断是否有权限查看
        $this->perms->adminPerms('admin, member', 'show_member');

        // 获取会员注册信息
        $user = UserRegister::find($id);
        // 获取会员详细信息
        $userinfo = $user->userInfo;
//        dd($userinfo);
        // 获取积分详情
        $usercode = $user->userCode;
//        dd($usercode);
        $sexType = ['1'=>'男','2'=>'女'];
        return view('admin.main.member.show',compact('userinfo','user','usercode','sexType'));
    }

    /**
     * @return  view    会员添加页
     */
    public function create()
    {
        //判断是否有权限添加
        $this->perms->adminPerms('admin, member', 'create_member');
        return view('admin.main.member.add');
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'email'=>'required |email',
            'password'=>'required',
            'repassword'=>'required',
        ],[
            'required'=> ':attribute必须填写',
            'email'=>':attribute格式不对',
        ],[
            'email'=>'邮箱',
            'password'=>'密码',
            'repassword'=>'确认密码'
        ]);
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
        //判断是否有权限修改
        $this->perms->adminPerms('admin, member', 'edit_member');

        $user = UserRegister::find($id);
        $userinfo = $user->userInfo;
//        dd($userinfo);
        if(!empty($userinfo)){
            return view('admin.main.member.edit', compact('userinfo','user'));
        }

    }

    /**
     * update   更新修改操作
     *
     * @param   $request    array   获取请求头信息
     *
     * @return  未定义
     */
    public function update(Request $request,$id)
    {
        $res = $request->all();
//        dd($res);
        $userinfo['nickname'] = $res['nickname'];
        $userinfo['sex'] = $res['sex'];
        $userinfo['realname'] = $res['realname'];
        $userinfo['id_number'] = $res['id_number'];
        $userinfo['avatar'] = $res['avatar'];
        $userinfo['birthday'] = $res['birthday'];

        if(UserInfo::where('id',$id)->update($userinfo)){
            return $msg = [
                'status'=>0,
                'msg'=>'修改成功'
            ];
        }else {
            return $msg = [
                'status'=>1,
                'msg'=>'修改失败'
            ];
        }

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
        //判断是否有权限删除
		$error = $this->perms->adminDelPerms('admin, member', 'delete_member');
        if ($error){
            //$error json数据  success=>错误码  info=>错误提示信息  如要返回的不是json数据请先转换
            // $json = json_decode($error);

            return 0;
        }

        UserInfo::where('user_id','=',$id)->delete();
        ReceivingAddress::where('user_id','=',$id)->delete();
        if (UserRegister::destroy($id))
        {
            return 1;
        }
    }


    public function getAddress(Request $request)
    {
        $user_id = Input::get('id');
        $address = ReceivingAddress::where('user_id',$user_id)->orderBy('is_default')->paginate(2);
        if(count($address)){
            $province = Region::where('level',1)->pluck('name','id');

            $city = Region::where('level',2)->pluck('name','id');

            $district = Region::where('level',3)->pluck('name','id');

            $twon = Region::where('level',4)->pluck('name','id');

            return view('admin.main.member.receivingaddress',compact('address','request','province','city','district','twon'));
        }
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
