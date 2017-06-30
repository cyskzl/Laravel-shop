<?php

namespace App\Http\Controllers\Admin;


use App\Models\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Permission;

class SystemSettingsController extends Controller
{
    protected $perms;

	public function __construct()
	{
		$this->perms = new Permission;
	}

    public function index()
    {
        //判断是否有权限访问
        $this->perms->adminPerms('admin, system', 'system_list');

        $configs = Config::pluck('value','name')->all();
//        $arr_configs = var_export($configs,true);
        return view('admin.main.settings.index',compact('configs'));
    }

    public function setChange(Request $request)
    {
        $conf_all = $request->all();
//        return $conf_all;
        foreach($conf_all as $name=>$value){
            Config::where('name','=',$name)->update(['value'=>$value]);
        }
        return back()->with(['success'=>'修改网站系统设置成功']);
    }
}
