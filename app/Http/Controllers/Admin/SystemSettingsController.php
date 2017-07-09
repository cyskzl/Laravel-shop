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

        //更新网站配置信息文件
        $res = $this->webConfig();
        if ($res) {
            return back()->with(['success' => $res ]);
        }

        return back()->with(['success'=> $res ]);
    }

    /**
     * 写入网站信息配置文件
     *
     * @return string
     */
    public function webConfig()
    {
        //获取网站信息
        $configs = Config::pluck('value','name')->all();
        $str = "<?php \r\n return".'  '.var_export($configs,true).";";

        $path = config_path('config.inc.php');
        if (!file_put_contents($path, $str)) {

            return '保存成功，配置文件写入失败!';
        }

        return '修改网站系统设置成功';

    }
}
