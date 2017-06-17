<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    /**
     * @return  view    友情链接列表
     */
    public  function index()
    {
        return view('admin.main.link.index');
    }

    /**
     * @return  view    友情链接列表
     */
    public  function edit()
    {
        return view('admin.main.link.edit');
    }

}
