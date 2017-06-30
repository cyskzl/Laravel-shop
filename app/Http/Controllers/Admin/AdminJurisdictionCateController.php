<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminJurisdictionCateController extends Controller
{
    /**
     * @return  view    权限分类列表
     */
    public function index()
    {
        return view('admin.main.adminjurisdictioncate.index');
    }

    /**
     * @return  view    权限分类修改
     */
    public function edit()
    {
        return view('admin.main.adminjurisdictioncate.edit');
    }

}
