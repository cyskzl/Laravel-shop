@extends('home.layouts.layout_two')

@section('title','购物车')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/shopping.css')}}"/>
@endsection

@section('main')
	<!-- 内容 -->
	    <!--购物车为空 start-->
	    <div class="emptyShoppingcar comWidth">
	        <img src="{{asset('/templates/home/uploads/emptyShoppingcar.png')}}" alt=""/>
	        <p>您的购物车里还没有任何商品，快去逛逛吧…</p>
	        <a href="javascript:;">去逛逛</a>
	    </div>
	    <!--购物车为空 end-->
@endsection