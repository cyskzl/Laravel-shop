<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>后台管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="{{asset('templates/admin/css/x-admin.css')}}" media="all">
</head>
<body>
<div class="layui-layout layui-layout-admin">
    <div class="layui-header header header-demo">
        <div class="layui-main">
            <a class="logo" href="{{url('/admin/admin')}}">hello word</a>
            <ul class="layui-nav" lay-filter="">
                <li class="layui-nav-item">

                    <img src="{{ Auth::guard('admin')->user()->pic }}" class="layui-circle" style="border: 2px solid #A9B7B7;" width="35px" alt="">
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">{{ Auth::guard('admin')->user()->nickname}}</a>
                    <dl class="layui-nav-child"> <!-- 二级菜单 -->
                        <dd><a href="">个人信息</a></dd>
                        <dd><a href="">切换帐号</a></dd>
                        <dd><a href="{{ url('admin/loginout') }}">退出</a></dd>
                    </dl>
                </li>
                <!-- <li class="layui-nav-item">
                  <a href="" title="消息">
                      <i class="layui-icon" style="top: 1px;">&#xe63a;</i>
                  </a>
                  </li> -->
                <li class="layui-nav-item x-index"><a href="/" target="_blank">前台首页</a></li>
            </ul>
        </div>
    </div>
    <div class="layui-side layui-bg-black x-side">
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree site-demo-nav" lay-filter="side">
                <li class="layui-nav-item">
                    <a class="javascript:;" href="javascript:;">
                        <i class="layui-icon" style="top: 3px;">&#xe62d;</i><cite>商品管理</cite>
                    </a>
                    <dl class="layui-nav-child">
                        <dd class="">
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/type') }}">
                                <cite>商品类别</cite>
                            </a>
                        </dd>
                        </dd>
                        <dd class="">
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/spec') }}">
                                <cite>商品规格</cite>
                            </a>
                        </dd>
                        </dd>
                        <dd class="">
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/goodsattr') }}">
                                <cite>商品属性</cite>
                            </a>
                        </dd>
                        </dd>
                        <dd class="">
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/brand') }}">
                                <cite>商品品牌</cite>
                            </a>
                        </dd>
                        </dd>
                        <dd class="">
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/goods') }}">
                                <cite>商品列表</cite>
                            </a>
                        </dd>
                        </dd>

                        <dd class="">
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/goodstag') }}">
                                <cite>商品标签</cite>
                            </a>
                        </dd>
                        </dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="javascript:;" href="javascript:;">
                        <i class="layui-icon" style="top: 3px;">&#xe62d;</i><cite>活动管理</cite>
                    </a>
                    <dl class="layui-nav-child">
                        <dd class="">
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/activity') }}">
                                <cite>活动管理</cite>
                            </a>
                        </dd>
                        </dd>
                        <dd class="">
                        <dd class="">
                            <a href="javascript:;" _href="{{url('admin/activity/create')}}">
                                <cite>添加活动</cite>
                            </a>
                        </dd>
                        </dd>

                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="javascript:;" href="javascript:;">
                        <i class="layui-icon" style="top: 3px;">&#xe634;</i><cite>轮播图管理</cite>
                    </a>
                    <dl class="layui-nav-child">
                        <dd class="">
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/carousel') }}">
                                <cite>轮播图列表</cite>
                            </a>
                        </dd>
                        </dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="javascript:;" href="javascript:;">
                        <i class="layui-icon" style="top: 3px;">&#xe642;</i><cite>订单管理</cite>
                    </a>
                    <dl class="layui-nav-child">
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/orders') }}">
                                <cite>订单列表</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/deliveryinfo') }}">
                                <cite>发货单</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/returninfo') }}">
                                <cite>退货单</cite>
                            </a>
                        </dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="javascript:;" href="javascript:;">
                        <i class="layui-icon" style="top: 3px;">&#xe630;</i><cite>分类管理</cite>
                    </a>
                    <dl class="layui-nav-child">
                        <dd class="">
                            <a href="javascript:;" _href="{{url('admin/goodscategory')}}">
                                <cite>分类列表</cite>
                            </a>
                        </dd>
                    </dl>
                    <dl class="layui-nav-child">
                        <dd class="">
                            <a href="javascript:;" _href="{{url('admin/goodscategory/create')}}">
                                <cite>添加分类</cite>
                            </a>
                        </dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="javascript:;" href="javascript:;">
                        <i class="layui-icon" style="top: 3px;">&#xe606;</i><cite>评论管理</cite>
                    </a>
                    <dl class="layui-nav-child">
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/comment') }}">
                                <cite>评论列表</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/feedback') }}">
                                <cite>意见反馈</cite>
                            </a>
                        </dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="javascript:;" href="javascript:;">
                        <i class="layui-icon" style="top: 3px;">&#xe612;</i><cite>会员管理</cite>
                    </a>
                    <dl class="layui-nav-child">
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/member') }}">
                                <cite>会员列表</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/memberrecyclebin') }}">
                                <cite>删除会员</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/memberlevel') }}">
                                <cite>等级管理</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/memberintegral') }}">
                                <cite>积分管理</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/memberbrowselog') }}">
                                <cite>浏览记录</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/membercollection') }}">
                                <cite>商品收藏</cite>
                            </a>
                        </dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="javascript:;" href="javascript:;">
                        <i class="layui-icon" style="top: 3px;">&#xe613;</i><cite>管理员管理</cite>
                    </a>
                    <dl class="layui-nav-child">
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/adminlist') }}">
                                <cite>管理员列表</cite>
                            </a>
                        </dd>

                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/adminrole') }}">
                                <cite>角色管理</cite>
                            </a>
                        </dd>

                        <!-- <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/adminjurisdiction') }}">
                                <cite>权限分类</cite>
                            </a>
                        </dd> -->
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/permission') }}">
                                <cite>权限列表</cite>
                            </a>
                        </dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="javascript:;" href="javascript:;">
                        <i class="layui-icon" style="top: 3px;">&#xe629;</i><cite>系统统计</cite>
                    </a>
                    <dl class="layui-nav-child">
                        <dd class="">
                            <a href="javascript:;" _href="./echarts1.html">
                                <cite>拆线图</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="./echarts2.html">
                                <cite>柱状图</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="./echarts3.html">
                                <cite>地图</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="./echarts4.html">
                                <cite>饼图</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="./echarts5.html">
                                <cite>雷达图</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="./echarts6.html">
                                <cite>k线图</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="./echarts7.html">
                                <cite>热力图</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="./echarts8.html">
                                <cite>仪表图</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="http://echarts.baidu.com/examples.html" target="_blank" _href="./welcome.html">
                                <cite>更多案例</cite>
                            </a>
                        </dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="javascript:;" href="javascript:;">
                        <i class="layui-icon" style="top: 3px;">&#xe614;</i><cite>系统设置</cite>
                    </a>
                    <dl class="layui-nav-child">
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/settings') }}">
                                <cite>系统设置</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="./sys-data.html">
                                <cite>数字字典</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="./sys-shield.html">
                                <cite>屏蔽词</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/systemlog') }}">
                                <cite>系统日志</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="{{ url('admin/link') }}">
                                <cite>友情链接</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="./sys-qq.html">
                                <cite>第三方登录</cite>
                            </a>
                        </dd>
                    </dl>
                </li>
                <li class="layui-nav-item" style="height: 30px; text-align: center">
                </li>
            </ul>
        </div>

    </div>
    <div class="layui-tab layui-tab-card site-demo-title x-main" lay-filter="x-tab" lay-allowclose="true">
        <div class="x-slide_left"></div>
        <ul class="layui-tab-title">
            <li class="layui-this">
                我的桌面
                <i class="layui-icon layui-unselect layui-tab-close">ဆ</i>
            </li>
        </ul>
        <div class="layui-tab-content site-demo site-demo-body">
            <div class="layui-tab-item layui-show">
                <iframe frameborder="0" src="{{ url('admin/welcome') }}" class="x-iframe"></iframe>
            </div>
        </div>
    </div>
    <div class="site-mobile-shade">
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
