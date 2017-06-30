<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission;

class MemberLevelController extends Controller
{
    protected $perms;

	public function __construct()
	{
		$this->perms = new Permission;
	}

    /**
     * @return  view    会员等级管理
     */
    public function index()
    {
        //判断是否有权限访问列表
		$this->perms->adminPerms('admin, member', 'memberlevel_list');
        return view('admin.main.memberlevel.index');
    }

    /**
     * @return  view    添加会员等级
     */
    public function create()
    {
        //判断是否有权限添加
		$this->perms->adminPerms('admin, member', 'create_memberlevel');
        return view('admin.main.memberlevel.add');
    }

    /**
     * @return  view    修改会员等级
     */
    public function edit()
    {
        //判断是否有权限修改
		$this->perms->adminPerms('admin, member', 'edit_memberlevel');

        return view('admin.main.memberlevel.edit');
    }
}
