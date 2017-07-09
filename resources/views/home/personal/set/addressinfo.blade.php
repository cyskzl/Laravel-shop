@extends('home.layouts.layout')

@section('title','地址管理')

@section('style')
    <link rel="stylesheet" href="{{asset('/templates/home/css/personal.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/home/css/adress.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/admin/lib/layui/css/layui.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/home/bootstrap/css/bootstrap.min.css')}}"/>
    <style>
        #edit a{
            margin-right: 30px;
            font-family:"微软雅黑",sans-serif;
            color:#D30C38;
            font-size: 16px;
        }

    </style>
@endsection

@section('main')
    <!-- 内容 -->
    <!-- breadcrumbs start-->
    <div class="breadcrumbs comWidth clearfix">
        <ul>
            <li><a href="javascript:">首页</a><span>&gt;</span></li>
            <li><a href="javascript:">个人中心</a><span>&gt;</span></li>
            <li><a href="javascript:">地址管理</a></li>
        </ul>
    </div>
    <!-- breadcrumbs end-->

    <!-- personal_center start-->
    <div class="personal_center comWidth clearfix">

        @include('home.personal.left_memu')

        <div class="personal_main fr">
            <ul class="personal_tab_header clearfix">
                <li><a href="{{ url('home/personal')  }}" data-memu="7">个人信息</a></li>
                <li class="on"><a href="{{ url('home/address')  }}" data-memu="8">地址管理</a></li>
            </ul>

            <!-- 地址管理 -->
            <div style="margin-top:15px;">
                <a class="address_btn" href="{{ url('home/address/create')  }}">新增地址</a>
            </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            @foreach($address as $v)

            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                <legend>{{$v->consignee}}{{$v->is_default==0?'(默认地址)':''}}</legend>
            </fieldset>

            <div class="layui-form">
                <table class="layui-table">
                    <colgroup>
                        <col width="10%">
                        <col width="80%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>收货人：</th>
                        <td>{{$v->consignee}}</td>
                    </tr>
                    <tr>
                        <th>所在地区：</th>
                        <td>{{$province[$v->province].$city[$v->city].$district[$v->district].$twon[$v->twon]}}</td>
                    </tr>
                    <tr>
                        <th>详细地址：</th>
                        <td>{{$v->detailed_address}}</td>
                    </tr>
                    <tr>
                        <th>手机：</th>
                        <td>{{$v->mobile}}</td>
                    </tr>
                    <tr>
                        <th>电子邮箱：</th>
                        <td>{{$v->email}}</td>
                    </tr>
                    <tr>
                        <td id="edit" colspan="2">
                            @if($v->is_default == 1)
                                <a href="javascript:;" id="is_default" value="{{$v->id}}" onclick="ajax(this,'PUT',1)">设为默认</a>
                            @endif
                            <a href='{{url('home/address').'/'.$v->id.'/edit'}}' id="update" value="{{$v->id}}" >编辑</a>
                            <a href="javascript:;" id="del" value="{{$v->id}}" onclick="ajax(this,'DELETE',1)">删除</a>
                        </td>
                    </tr>
                    </thead>
                </table>
            </div>
            @endforeach
                    <!-- 地址管理 -->
            <div style="float:left;">
                {{--{{$address->link()}}--}}
                {!! $address->appends($request->only(['keyword']))->render() !!}
            </div>
        </div>

    </div>
    <!-- personal_center end-->
@endsection

@section('shop')
    
@endsection
@section('js')
    <script src="{{asset('/templates/home/js/dynamic.js')}}"></script>
    <script src="{{asset('/templates/home/js/left_memu.js')}}"></script>

    <script>

        function ajax(obj,type,def){
            var id = obj.getAttribute('value');
            $.ajax({
                type: type,
                url: '{{url('home/address')}}/' + id,
                data: {'_token': '{{csrf_token()}}', '_method': type,'default':def},
                dataType: 'json',
                success: function (data) {
                    if (data) {
                        console.log(data);
                        location.href = location.pathname;
                    }
                    return false;
                }
            });
        }



    </script>
@endsection
