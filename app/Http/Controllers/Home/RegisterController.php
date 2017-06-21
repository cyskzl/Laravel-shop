<?php

namespace App\Http\Controllers\Home;

use App\Models\M3Email;
use App\Models\TempEmail;
use App\Models\UserRegister;
use App\Tool\Validate\ValidateCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;

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

    public function toRegister(Request $request)
    {

        // 邮箱验证
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
            return redirect('home/register')->withInput()->with(['fail'=>'验证码错误']);
        }

        $userregister = new UserRegister();
        $userregister -> email = $email;
        $userregister -> password = $pass;
        $userregister -> register_ip = $request->ip();

        if(!($userregister->save())){
            return back()->withInput()->with(['fail'=>'注册失败']);
        }
        // 生成随机码
        $uuid = Uuid::generate();

        // 生成发送信息
        $m3_email = new M3Email();
//        $m3_email->from = 'nietzsche_nc@163.com';
        $m3_email->to = $email;
        $m3_email->cc = 'nietzsche_nc@163.com';
        $m3_email->subject = '尤为商城注册';
        $m3_email->content = '请于24小时点击该链接完成注册. http://zw1.com/home/register/validate_email' . '?code=' . $uuid;

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

    }

    public function validateEmail(Request $request)
    {
        $email = $request->input('email');
        $user = DB::table('users_register')
            ->where('email','=',$email)
            ->get();

        if($user){
            return 1;
        }else{
            return 2;
        }

    }

    public function validateEmailCode(Request $request)
    {
        $uid = $request->input('user_id');
        $uuid = $request->input('code');
        $temp = TempEmail::where('uuid','=',$uuid)->get()->toArray();
        $name = ['one'=>'qwewqe'];
        
        if(count($temp)){
            UserRegister::where('id','=',$temp[0]['user_id'])->update(['status'=>1]);
            return view('home.validatefail',compact('name'));

        }else{
            return view('home.validatefail');

        }
    }
}
