<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission;

class FeedbackController extends Controller
{

    protected $perms;

	public function __construct()
	{
		$this->perms = new Permission;
	}

    /**
     * @return  view    意见反馈列表页
     */
    public function index()
    {
        //判断是否有权限列表
		$this->perms->adminPerms('admin, feedback', 'feedback_list');

        return view('admin.main.feedback.index');
    }



    /**
     * @return  view    意见反馈修改页
     */
    public function edit()
    {
        //判断是否有权限修改
		$this->perms->adminPerms('admin, feedback', 'edit_feedback');
        return view('admin.main.feedback.edit');
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
     * destroy  意见反馈删除
     *
     * @param   $request    array   获取请求头信息
     *
     */
    public function destroy(Request $request)
    {
        //判断是否有权限删除
		$error = $this->perms->adminDelPerms('admin, feedback', 'delete_feedback');
        if ($error){
            //$error json数据  success=>错误码  info=>错误提示信息  如要返回的不是json数据请先转换
            //json_decode($error);
            return $error;
        }
        //删除id
    }
}
