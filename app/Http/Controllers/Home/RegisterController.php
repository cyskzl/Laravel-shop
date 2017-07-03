<?php

namespace App\Http\Controllers\Home;

use App\Models\M3Email;
use App\Models\TempEmail;
use App\Models\UserInfo;
use App\Models\UserLogin;

use App\Models\UserRegister;
use App\Tool\Validate\ValidateCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use iscms\Alisms\SendsmsPusher as Sms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 返回登录视图
     */
    public function register()
    {
        return view('home.register');
    }

    /**
     * @param Request $request
     * 返回验证码
     */
    public function createCode(Request $request)
    {
        $validateCode = new ValidateCode();
        $request->session()->put('validate_code', $validateCode->getCode());
        return $validateCode->doimg();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * 进行服务器端端的邮箱注册填写信息验证
     * 完成验证将信息存入users_register
     * 发送邮件给注册用户邮箱
     */
    public function toEmailRegister(Request $request)
    {

        // 邮箱注册填写信息验证

//        dd($request->all());
        $this->validate($request,[
            'email'=>'required | email',
            'password'=>'required | between:6,16',
            'repassword'=>'required | between:6,16 | same:password',
            'validate_code'=>'required | size:4',
            'check'=>'accepted',
        ],[
            'required'=>':attribute必须填写',
            'email'=>':attribute格式不正确',
            'between'=>':attribute长度必须介于6和16之间',
            'same'=>'密码与:attribute不符 ',
            'size'=>':attribute长度不对',
            'accepted'=>'请勾选:attribute',
        ],[
            'email'=>'邮箱',
            'password'=>'密码 ',
            'repassword'=>'确认密码',
            'validate_code'=>'验证码',
            'check'=>'服务条款',
        ]);

        $email = $request->input('email');
        $pass = $request->input('password');
        $pass_again = $request->input('repassword');
        $validate_code = $request->input('validate_code');
        $code = $request->session()->get('validate_code');

        //验证验证码是否输入正确
        if($validate_code != $code) {
            return redirect('home/register')->withInput()->with(['fail'=>'验证码错误','id'=>'email']);
        }

        $userregister = new UserRegister();
        $userregister -> email = $email;
        $userregister -> password = Hash::make($pass);
        $userregister -> register_ip = $request->ip();

        if(!($userregister->save())){
            return back()->withInput()->with(['fail'=>'注册失败,请您重新填写用户信息']);
        }
        // 生成随机码
        $uuid = Uuid::generate();

        // 生成发送信息
        $m3_email = new M3Email();
//        $m3_email->from = 'nietzsche_nc@163.com';
        $m3_email->to = $email;
        $m3_email->cc = 'nietzsche_nc@163.com';
        $m3_email->subject = '尤为商城注册';
        $m3_email->content = '请于24小时点击该链接完成注册. http://zw1.com/home/email_register/validate_email' . '?code=' . $uuid;

        $tempEmail = new TempEmail();
        $tempEmail->user_id = $userregister->id;
//        dd($userregister->id);
        $tempEmail->uuid = $uuid;
        $tempEmail->deadline = date('Y-m-d H-i-s', time() + 24*60*60);
        $tempEmail->save();

        Mail::send('home.email_register', ['m3_email' => $m3_email], function ($m) use ($m3_email) {
            // $m->from('hello@app.com', 'Your Application');
            $m->to($m3_email->to, '尊敬的用户')
                ->cc($m3_email->cc)
                ->subject($m3_email->subject);
        });

        return view('home.validatefail',['info'=>'注册成功，请您到邮箱激活']);

    }

    /**
     * @param Request $request
     * @return int
     * 注册页的邮箱名ajax验证
     */
    public function validateEmail(Request $request)
    {
        $email = $request->input('email');

        $phone = $request->input('phone');

        $user = DB::table('users_register')
            ->where('email','=',$email)
            ->where('tel',$phone)
            ->get();

        if($user){
            return 1;
        }else{
            return 2;
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 处理邮件内部的信息
     * 判断连接是否失效
     * 信息对应则修改用户注册表的状态
     * 删除临时存储的验证信息
     * 增加用户详情表的片段信息
     * 返回视图提示注册成功并跳转到网站首页（暂时缺少将信息存入SESSION中实现登录）
     */
    public function validateEmailCode(Request $request)
    {
        $uuid = $request->input('code');
        $temp = TempEmail::where('uuid','=',$uuid)->get()->toArray();
//        $name = ['one'=>'qwewqe'];
        $deadline = $temp[0]['deadline'];
        $nowtime = date('Y-m-d H:i:s',time());
        $uid = $temp[0]['user_id'];

        // 判断链接是否失效
        if($deadline>$nowtime) {
            if (count($temp)) {
                // 修改注册表信息
                $register = UserRegister::where('id', '=', $uid)->update(['status' => 1]);
                if (!$register) {
                    return view('home.validatefail',['info'=>'邮箱激活失败，请重回邮箱点击链接重试激活']);
                }
                // 对应增加users_info表的信息
                $uinfo = UserRegister::find($uid);
                $userinfo = new UserInfo();
                $userinfo->user_id = $uid;
//                $userinfo->nickname = $uinfo->email;
                $userinfo->email = $uinfo->email;
//                $userinfo->avatar = '';
                $infoId = $userinfo->save();
                if (!$infoId) {
                    return view('home.validatefail',['info'=>'回到首页']);
                }

                // 增加用户登录表信息
                $userlogin = new UserLogin();
                $userlogin->user_id = $uid;
                $userlogin->login_name = $uid;
                $userlogin->password = $uinfo->password;
                $userlogin->last_login_ip = $request->ip();
                $userlogin->last_login_at = $nowtime;
                if(!$userlogin->save()){
                    return view('home.validatefail',['info'=>'回到首页']);
                }

                // 删除邮箱注册的临时信息
                $delTemp = TempEmail::where('user_id', '=', $uid)->delete();
                if (!$delTemp) {
                    return view('home.validatefail',['info'=>'回到首页']);
                }
                return view('home.validatefail', ['info' => '用户名已激活，3秒后跳转到网站首页或者点击立即跳转']);

            } else {
                return view('home.validatefail',['info' => '用户名已激活，3秒后跳转到网站首页或者点击立即跳转']);

            }
        } else {
            // 连接失效，删除临时信息表和用户注册表中的信息

            $delTemp = TempEmail::where('user_id', '=', $uid)->delete();
            $deluser = UserRegister::where('id','=',$uid)->delete();
//
//            $deluser = UserRegister::where('id','=',$uid)->delete();
//            $delTemp = TempEmail::where('user_id', '=', $uid)->delete();

            if (!$delTemp || !$deluser) {
                return view('home.validatefail',['info'=>'该链接已失效，请重新注册']);
            }
            return view('home.validatefail',['info'=>'该链接已失效，请重新注册']);
        }
    }

    public function phoneRegister()
    {
        return view('home.phone_register');
    }

    public function validatePhone(Request $request)
    {
        //
    }

    //获取短信验证码
    public function phoneCode(Request $request,Sms $sms)
    {
        $phone = $request->input('phone');

        $pattern  =  '/^[1][34578]\d{9}$/' ;

        $bool = preg_match($pattern,$phone);

        if(!$bool){

            return '{"error":1}';
        }

        $isuser = UserRegister::where('tel',$phone)->get();

        if (empty($isuser)){

            return '{"error":2}';
        }

        $phonecode = $this->get_mobile_code($phone);

        $name = 'xybeta注册验证';

        $content = '{code:"'. $phonecode .'",name:"xxx"}';

        $code = 'SMS_71285782';

        $result = $sms->send("$phone","$name","$content","$code");

        return array('err_code'=>'0');

        return get_object_vars($result);
    }


    //生成手机验证码
    protected function get_mobile_code($phone = 0)
    {

        $data = TempEmail::where('user_id',$phone)->get()->toArray();

        if (!empty($data)){

            $code = $data[0]['uuid'];

            if (date('Y-m-d H:i:s',time($data[0]['created_at']) + 600) < date('Y-m-d H:i:s')){

                return $code;
            }else{

                TempEmail::where('user_id',$phone)->delete();
            }
        }

        $code = mt_rand(10001,99999);

        $status = TempEmail::create(['user_id' => $phone, 'uuid' => $code]);

        if ($status){

            return $code;
        }
    }

    //手机注册提交
    public function toPhoneRegister(Request $request)
    {
        $this->validate($request,[
            'tel'=>'required | regex:/^1[34578][0-9]{9}$/',
            'password'=>'required | between:6,16',
            'repassword'=>'required | between:6,16 | same:password',
            'phone_code'=>'required | size:5',
            'check'=>'accepted',
        ],[
            'required'=>':attribute必须填写',
            'email'=>':attribute格式不正确',
            'between'=>':attribute长度必须介于6和16之间',
            'same'=>'密码与:attribute不符 ',
            'size'=>':attribute长度不对',
            'accepted'=>'请勾选:attribute',
        ],[
            'tel'=>'手机',
            'password'=>'密码 ',
            'repassword'=>'确认密码',
            'phone_code'=>'验证码',
            'check'=>'服务条款',
        ]);


        $phoneCode = $request->input('phone_code');

        $phone = $request->input('tel');

        $tempData = TempEmail::where('user_id',$phone)->get();

        $date = $tempData[0]->created_at;

        $code = $tempData[0]->uuid;

        $pass = $request->input('password');

        $pattern  =  '/^[1][34578]\d{9}$/' ;

        $bool = preg_match($pattern,$phone);

        $isuser = UserRegister::where('tel',$phone)->get();

        if (!empty($isuser)){

            return back()->withInput()->with(['fail'=>'该手机号码已注册!']);
        }

        if(!$bool){

            return back()->withInput()->with(['fail'=>'手机号非法!']);
        }

        if(date('Y-m-d H:i:s',time($date) + 1200) < date('Y-m-d H:i:s')){
            return back()->withInput()->with(['fail'=>'验证码过时，请重新获取']);
        }

        if ($phoneCode != $code ){

            return back()->withInput()->with(['fail'=>'验证码不正确']);
        }

        if ($pass != $request->input('repassword')){
            return back()->withInput()->with(['fail'=>'密码与确认密码不相同']);
        }

        $user = new UserRegister;

        $user->tel = $phone;

        $user->password =  Hash::make($pass);

        $user->status = 1;

        $user->register_ip = $request->ip();

        if ($user->save()){

            return view('home.validatefail',['info'=>'回到首页']);

        }else{

            return back()->withInput()->with(['fail'=>'注册失败,请您重新填写用户信息']);
        }



    }
}
