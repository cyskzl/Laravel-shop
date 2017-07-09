<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Hello Word</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="{{asset('templates/admin/css/x-admin.css')}}" media="all">
    </head>
    <body>
        <div class="x-body">
            <blockquote class="layui-elem-quote">
                欢迎使用x-admin 后台模版！<span class="f-14">v1.0</span>官方交流群： 519492808
            </blockquote>
            <p>登录次数：{{ $request->session()->get('login_num') }} </p>

            <p>上次登录IP：{{ $request->session()->get('last_login_ip') }}  上次登录时间： {{ $request->session()->get('last_login_time') }}</p>
            <fieldset class="layui-elem-field layui-field-title site-title">
              <legend><a name="default">信息统计</a></legend>
            </fieldset>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>统计</th>
                        <th>资讯库</th>
                        <th>图片库</th>
                        <th>产品库</th>
                        <th>用户</th>
                        <th>管理员</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>总数</td>
                        <td>92</td>
                        <td>9</td>
                        <td>{{ $goods_count }}</td>
                        <td>{{ $user_count }}</td>
                        <td>{{ $admin_user }}</td>
                    </tr>
                    <tr>
                        <td>今日</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td></td>

                    </tr>
                    <tr>
                        <td>昨日</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>本周</td>
                        <td>2</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>本月</td>
                        <td>2</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                </tbody>
            </table>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th colspan="2" scope="col">服务器信息</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th width="30%">服务器计算机名</th>
                        <td><span id="lbServerName">{{ $_SERVER['SERVER_NAME'] }}</span></td>
                    </tr>
                    <tr>
                        <td>服务器IP地址</td>
                        <td>{{ $_SERVER['SERVER_ADDR'] }}</td>
                    </tr>
                    <tr>
                        <td>服务器域名</td>
                        <td>{{ $_SERVER["HTTP_HOST"] }}</td>
                    </tr>
                    <tr>
                        <td>服务器端口 </td>
                        <td>{{ $_SERVER['SERVER_PORT'] }}</td>
                    </tr>
                    <!-- <tr>
                        <td>本文件所在文件夹 </td>
                        <td>D:\WebSite\HanXiPuTai.com\XinYiCMS.Web\</td>
                    </tr> -->
                    <tr>
                        <td>服务器操作系统 </td>
                        <td>{{ php_uname() }}</td>
                    </tr>
                    <tr>
                        <td>系统所在文件夹 </td>
                        <td>{{ $_SERVER['DOCUMENT_ROOT'] }}</td>
                    </tr>
                    <!-- <tr>
                        <td>服务器脚本超时时间 </td>
                        <td>30000秒</td>
                    </tr> -->
                    <tr>
                        <td>服务器的语言种类 </td>
                        <td>{{ $_SERVER['HTTP_ACCEPT_LANGUAGE'] }}</td>
                    </tr>
                    <tr>
                        <td>PHP版本 </td>
                        <td>{{ $_SERVER ['SERVER_SOFTWARE'] }}</td>
                    </tr>
                    <tr>
                        <td>服务器当前时间 </td>
                        <td>{{ date("Y-m-d G:i:s") }}</td>
                    </tr>
                    <tr>
                        <td>脚本所占内存 </td>
                        <td>{{ get_cfg_var ("memory_limit")?get_cfg_var("memory_limit"):"无" }}</td>
                    </tr>
                    <tr>
                        <td>当前Session数量 </td>
                        <td>{{ count($request->session()->all()) }}</td>
                    </tr>
                    <tr>
                        <td>当前Cookie数量 </td>
                        <td>{{ count($request->cookie()) }}</td>
                    </tr>
                    <tr>
                        <td>当前系统用户名 </td>
                        <td>{{ \Auth::guard('admin')->user()->nickname }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="layui-footer footer footer-demo">
            <div class="layui-main">
                <p>感谢layui,百度Echarts,jquery</p>
                <p>
                    <a href="/">
                        Copyright ©2017 x-admin v2.3 All Rights Reserved.
                    </a>
                </p>
                <p>
                    <a href="./" target="_blank">
                        本后台系统由X前端框架提供前端技术支持
                    </a>
                </p>
            </div>
        </div>
        <script src="{{asset('templates/admin/lib/layui/layui.js')}}" charset="utf-8"></script>
        <script src="{{asset('templates/admin/js/x-admin.js')}}"></script>
        <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
          var s = document.getElementsByTagName("script")[0];
          s.parentNode.insertBefore(hm, s);
        })();
        </script>
    </body>
</html>
