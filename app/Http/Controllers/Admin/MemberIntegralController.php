<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission;

class MemberIntegralController extends Controller
{
    protected $perms;

	public function __construct()
	{
		$this->perms = new Permission;
	}

    /**
     * @return  view    会员积分规则列表
     */
    public function index()
    {
        //判断是否有权限修改
		$this->perms->adminPerms('admin, member', 'memberintegral_list');

        return view('admin.main.memberintegral.index');
    }

    /**
     * @return  view    会员积分规则添加
     */
    public function create()
    {
        //判断是否有权限添加
		$this->perms->adminPerms('admin, member', 'createt_memberintegral');
        return view('admin.main.memberintegral.add');
    }

    /**
     * @return  view    会员积分规则修改
     */
    public function edit()
    {
        //判断是否有权限修改
		$this->perms->adminPerms('admin, member', 'edit_memberintegral');
        return view('admin.main.memberintegral.edit');
    }


}
