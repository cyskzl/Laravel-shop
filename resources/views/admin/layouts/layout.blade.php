<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title'){{ config('config.inc.shop_title') }}</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="{{asset('templates/admin/css/x-admin.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('templates/admin/lib/bootstrap/css/bootstrap.css')}}">
    <script src="{{asset('templates/admin/js/jquery.min.js')}}"></script>
    @yield('style')
</head>
<body>
<div class="x-nav">
@yield('x-nav')
</div>
@yield('x-box')
<div class="x-body">
@yield('x-body')
</div>
    <script src="{{asset('templates/admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script src="{{asset('templates/admin/js/x-layui.js')}}" charset="utf-8"></script>
   @yield('js')
</body>
</html>
