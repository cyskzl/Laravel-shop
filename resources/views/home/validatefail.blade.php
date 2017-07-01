@extends('home.layouts.layout')

@section('title','注册成功')

@section('style')
    <link rel="stylesheet" href="{{asset('/templates/home/css/registe.css')}}">
@endsection

@section('main')
    {{--前往注册页，然后查询是否存在用户session信息,有则进入首页--}}
    <div class="container" style="height:340px;">
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
                <div>
                     <a herf="javascript:;" onclick="skip();">{{$info or '注册失败,请仔细查看注册信息，是否存在错误'}}</a>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script>

        function skip(){
            window.location.href= 'http://zw1.com/home';
        }
    </script>
@endsection








