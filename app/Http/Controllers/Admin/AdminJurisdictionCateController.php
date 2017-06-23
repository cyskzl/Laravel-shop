<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PermissionClass;

class AdminJurisdictionCateController extends Controller
{
    /**
     * @return  view    权限分类列表
     */
    public function index()
    {
        $class = PermissionClass::get();

        return view('admin.main.adminjurisdictioncate.index', compact('class'));
    }

    /**
     * 添加分类
     *
     * @param Request $request
     * @return int
     */
    public function store(Request $request)
    {
        $class = new PermissionClass;

        $class->class_name = $request->class_name;

        if ($class->save()) {
            $class['success'] = '1';
            return json_encode($class);
        } else {
            $class['success'] = '0';
            return json_encode($class);
        }
    }
    /**
     * @return  view    权限分类修改
     */
    public function edit($id)
    {
        return view('admin.main.adminjurisdictioncate.edit');
    }


    public function update(Request $request, $id)
    {

    }

}
