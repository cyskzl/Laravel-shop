<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminRuleController extends Controller
{
    /**
     * @return  view    权限规则列表
     */
    public function index()
    {
        return view('admin.main.adminrule.index');
    }

    /**
     * @return  view    权限规则修改
     */
    public function edit()
    {
        return view('admin.main.adminrule.edit');
    }
}
