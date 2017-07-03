@extends('home.layouts.layout')

@section('title','注册成功')

@section('style')
    <link rel="stylesheet" href="{{asset('/templates/home/css/registe.css')}}">
@endsection

@section('main')
    {{--前往注册页，然后查询是否存在用户session信息,有则进入首页--}}
    <div class="container" style="width:1100px;height:300px;left:50%;">
        <a herf="javascript:;" onclick="skip();" style="color: #FF2245;left:50%;margin-left:360px;line-height: 200px;">{{$info or '注册失败,请仔细查看注册信息，是否存在错误'}}</a>
    </div>


@endsection

@section('js')
    <script>

        setTimeout(function () {
            window.location.href= 'http://{{ $_SERVER["HTTP_HOST"] }}';
        }, 3000);

        function skip(){
            window.location.href= 'http://{{ $_SERVER["HTTP_HOST"] }}';
        }
    </script>
@endsection








