<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserLogin;
use App\Models\Userinfo;
use Hash;
class PersonalController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-设置-个人信息
     */
    public function index()
    {
        $user = Userinfo::where('user_id', '=', \Auth::user()->user_id)->first();

        return view('home.personal.set.personalInfo', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-交易管理（浏览记录）
     */
    public function browseLog()
    {
        return view('home.personal.transaction.browseLog');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-交易管理（收藏夹）
     */
    public function favorites()
    {
        return view('home.personal.transaction.favorites');
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-个人中心（积分）
     */
    public function integral()
    {
        return view('home.personal.userinfo.integral');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-个人中心（会员等级）
     */
    public function memberLevel()
    {
        return view('home.personal.userinfo.memberLevel');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-个人中心（优惠劵）
     */
    public function coupon()
    {
        return view('home.personal.userinfo.coupon');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-服务中心（最新消息）
     */
    public function newest()
    {
        return view('home.personal.service.newest');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-服务中心（常见问题）
     */
    public function comProblem()
    {
        return view('home.personal.service.comProblem');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-服务中心（用户手册）
     */
    public function userManual()
    {
        return view('home.personal.service.userManual');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心-服务中心（隐私条款）
     */
    public function privacyClause()
    {
        return view('home.personal.service.privacyClause');
    }

    //修改密码
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


    //修改昵称
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

    //修改真实姓名
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
            if ($user->where('user_id', '=', $id)->update(['realname'=>$request->realname])){
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

    
}
