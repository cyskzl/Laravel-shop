<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MemberLevelController extends Controller
{
    /**
     * @return  view    会员等级管理
     */
    public function index()
    {
        return view('admin.main.memberlevel.index');
    }

    /**
     * @return  view    添加会员等级
     */
    public function create()
    {
        return view('admin.main.memberlevel.add');
    }

    /**
     * @return  view    修改会员等级
     */
    public function edit()
    {
        return view('admin.main.memberlevel.edit');
    }
}
