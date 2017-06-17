<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminListController extends Controller
{
    /**
     * @return  view    管理员列表
     */
    public function index()
    {
        return view('admin.main.administrator.index');
    }

    /**
     * @return  view    添加管理员
     */
    public function create()
    {
        return view('admin.main.administrator.add');
    }

    /**
     * @return  view    修改管理员
     */
    public function edit()
    {
        return view('admin.main.administrator.edit');
    }
}
