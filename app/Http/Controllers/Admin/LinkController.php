<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission;

class LinkController extends Controller
{
    protected $perms;

	public function __construct()
	{
		$this->perms = new Permission;
	}

    /**
     * @return  view    友情链接列表
     */
    public  function index()
    {
        //判断是否有权限访问列表
		$this->perms->adminPerms('admin, link', 'link_list');

        return view('admin.main.link.index');
    }

    /**
     * @return  view    友情链接列表
     */
    public  function edit()
    {
        //判断是否有权限修改
		$this->perms->adminPerms('admin, link', 'edit_link');
        return view('admin.main.link.edit');
    }

}
