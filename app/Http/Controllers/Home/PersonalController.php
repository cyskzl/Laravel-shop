<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserLogin;
use App\Models\UserInfo;
use Hash;

class PersonalController extends Controller
{
    public function __construct()
    {
        $user = Userinfo::where('user_id', '=', \Auth::user()->user_id)->first();
        view()->share('user', $user);
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-设置-个人信息
     */
    public function index(Request $request)
    {
        $cateId = $request->session()->get('Index');
        return view('home.personal.set.personalInfo',compact('cateId'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-交易管理（浏览记录）
     */
    public function browseLog(Request $request)
    {
        $cateId = $request->session()->get('Index');
        return view('home.personal.transaction.browseLog',compact('cateId'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-交易管理（收藏夹）
     */
    public function favorites(Request $request)
    {
        $cateId = $request->session()->get('Index');
        return view('home.personal.transaction.favorites',compact('cateId'));
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-个人中心（积分）
     */
    public function integral(Request $request)
    {
        $cateId = $request->session()->get('Index');
        return view('home.personal.userinfo.integral',compact('cateId'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-个人中心（会员等级）
     */
    public function memberLevel(Request $request)
    {
        $cateId = $request->session()->get('Index');
        return view('home.personal.userinfo.memberLevel',compact('cateId'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-个人中心（优惠劵）
     */
    public function coupon(Request $request)
    {
        $cateId = $request->session()->get('Index');
        return view('home.personal.userinfo.coupon',compact('cateId'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-服务中心（最新消息）
     */
    public function newest(Request $request)
    {
        $cateId = $request->session()->get('Index');
        return view('home.personal.service.newest',compact('cateId'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-服务中心（常见问题）
     */
    public function comProblem(Request $request)
    {
        $cateId = $request->session()->get('Index');
        return view('home.personal.service.comProblem',compact('cateId'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-服务中心（用户手册）
     */
    public function userManual(Request $request)
    {
        $cateId = $request->session()->get('Index');
        return view('home.personal.service.userManual',compact('cateId'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-服务中心（隐私条款）
     */
    public function privacyClause(Request $request)
    {
        $cateId = $request->session()->get('Index');
        return view('home.personal.service.privacyClause',compact('cateId'));
    }

    /**
     * 修改密码
     *
     * @param  Request $request
     * @param  $id
     * @return string
     */
    public function editPass(Request $request,$id)
    {

        //判断原密码
        if (empty($request->current_pass)) {

            $error['success'] = 0;
            $error['info']    = '原密码不能为空！';
            return json_encode($error);

        //判断新密码
        } elseif (empty($request->newpassword)) {

            $error['success'] = 0;
            $error['info']    = '新密码不能为空！';
            return json_encode($error);

        //判断新密码长度
        } elseif (strlen($request->newpassword) < 6) {

            $error['success'] = 0;
            $error['info']    = '新密码至少需要6个以上的字符!';
            return json_encode($error);

        //判断确认密码
        } elseif (empty($request->confirmation)) {

            $error['success'] = 0;
            $error['info']    = '确认密码不能为空！';
            return json_encode($error);

        //判断确认密码是否一致
        } elseif ($request->confirmation != $request->newpassword) {
            $error['success'] = 0;
            $error['info']    = '两次输入的密码不一致！';
            return json_encode($error);
        }

        //查询用户
        $user = UserLogin::where('user_id', '=', $id)->first();
        //判断是否存在
        if ($user) {

            //验证原密码
            if (!Hash::check($request->current_pass, $user->password)) {
                $error['success'] = 0;
                $error['info']    = '原密码输入错误！';
                return json_encode($error);
            }

            //加密新密码
            $password = array(
                'password' => bcrypt($request->newpassword),
            );

            //执行修改
            if ($user->where('user_id', '=', $id)->update($password)) {

                $error['success'] = 1;
                $error['info']    = '密码修改成功！';
                return json_encode($error);
            }

        } else {
            $error['success'] = 0;
            $error['info']    = '错误！未找到该用户信息！';
            return json_encode($error);
        }
    }


    /**
     * 修改昵称
     *
     * @param  Request $request
     * @param  $id
     * @return string
     *
     */
    public function editName(Request $request, $id)
    {
        $request->nickname    = $request->data;

        //判断是否为空
        if (empty($request->nickname)) {
            $error['success'] = 0;
            $error['info']    = '还未填写昵称！';
            return json_encode($error);
        }

        //查询是否存在
        $user = Userinfo::where('user_id', '=', $id)->first();

        //判断是否存在
        if ($user) {

            //判断是否更新成功
            if ($user->where('user_id', '=', $id)->update(['nickname'=>$request->nickname])){
                $error['success'] = 1;
                $error['info']    = '昵称修改成功！';
                return json_encode($error);
            } else {
                $error['success'] = 0;
                $error['info']    = '昵称修改失败！';
                return json_encode($error);
            }

        } else {
            $error['success'] = 0;
            $error['info']    = '错误！未找到该用户信息！';
            return json_encode($error);
        }
    }

    /**
     * 修改真实姓名
     *
     * @param  Request $request
     * @param  $id
     * @return string
     */
    public function editRealName(Request $request, $id)
    {
        $request->realname  = $request->data;

        //判断是否为空
        if (empty($request->realname)) {
            $error['success'] = 0;
            $error['info']    = '还未填写真实姓名！';
            return json_encode($error);
        }

        //查询用户
        $user = Userinfo::where('user_id', '=', $id)->first();

        //判断是否存在
        if ($user) {

            //判断是否更新成功
            if ( $user->where('user_id', '=', $id)->update(['realname'=>$request->realname]) ){
                $error['success'] = 1;
                $error['info']    = '真实姓名修改成功！';
                return json_encode($error);
            } else {
                $error['success'] = 0;
                $error['info']    = '真实姓名修改失败！';
                return json_encode($error);
            }

        } else {
            $error['success'] = 0;
            $error['info']    = '错误！未找到该用户信息！';
            return json_encode($error);
        }
    }

    /**
     * 修改头像
     *
     * @param  Request $request
     * @param  $id
     * @return string
     */
    public function editAvatar(Request $request, $id)
    {
        if($request->hasFile('file')){
            //获取图片
            $file =  $request  ->   file('file');
            //获取图片原始名称
            $clientName = $file-> getClientOriginalName();
            //获取临时文件夹中的文件名称
            $tmpName    = $file-> getFileName();
            //上传文件原始路径
            $realPath   = $file-> getRealPath();
            //上传文件后缀
            $entension  = $file-> getClientOriginalExtension();
            //文件类型
            $fileType   = $file-> getMimeType();
            //定义新文件名称
            $newName    = date('Ymdhis').rand(00000,99999).'.'.$entension;
            //移动文件
            $path = $file -> move('Uploads/avatar/'.date('Ymd'), $newName);

            if ( Userinfo::where('user_id', $id)->update(['avatar' => $path]) ) {

                $error['success'] = 1;
                $error['url']     = "".url($path)."";
                $error['info']    = '上传成功';
                return json_encode($error);
            } else {
                \Storage::delete(url($path));
                $error['success'] = 0;
                $error['info']    = '上传失败';
                return json_encode($error);
            }

        } else {
            $error['success'] = 0;
            $error['info']    = '没有文件上传';
            return json_encode($error);
        }

    }

    /**
     * 修改性别
     *
     * @param  Request $request
     * @param  $id
     * @return string
     */
    public function editSex(Request $request, $id)
    {

        if ( Userinfo::where('user_id', $id)->update(['sex' => $request->data]) ) {
            $error['success'] = 1;
            $error['info']    = '修改成功';
            return json_encode($error);
        }

        $error['success'] = 0;
        $error['info']    = '修改失败';
        return json_encode($error);
    }

    /**
     * 修改会员生日
     *
     * @param  Request $request
     * @param  $id
     * @return string
     */
    public function editBirthday(Request $request, $id)
    {
        //判断是否为空
        if (empty($request->data)) {
            $error['success'] = 0;
            $error['info']    = '日期不能为空！';
            return json_encode($error);
        }

        //判断是否更新成功
        if ( Userinfo::where('user_id', $id)->update(['birthday' => $request->data]) ) {

            $error['success'] = 1;
            $error['info']    = '修改成功';
            return json_encode($error);
        }

        $error['success'] = 0;
        $error['info']    = '修改失败';
        return json_encode($error);
    }

}
