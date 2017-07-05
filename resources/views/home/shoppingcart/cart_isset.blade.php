@extends('home.layouts.layout_two')

@section('title','购物车')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/cart.css')}}"/>
	<link rel="stylesheet" href="{{asset('/templates/home/iconfont2/iconfont.css')}}">
	<script src="{{asset('/templates/home/js/jquery-1.7.2.min.js')}}"></script>
	<script src="{{asset('/templates/home/js/header.js')}}"></script>
	<!-- <script src="{{asset('/templates/home/js/dynamic.js')}}"></script> -->
	<script src="{{asset('/templates/admin/lib/layui/layui.js')}}"></script>
	<script src="{{asset('/templates/home/js/shopCart.js')}}"></script>

@endsection

@section('main')
	<!-- 内容 -->
	    <form action="">
	        <table id="car">
	            <thead>
	            <tr>
	                <th><label><input id="checkAll" type="checkbox"/> 全选</label></th>
	                <th>商品信息</th>
	                <th>单价</th>
	                <th>数量</th>
	                <th>小计</th>
	                <th>操作</th>
	            </tr>
	            </thead>
	            <tbody id="goodsBox">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
	                <tr>
						<input type="hidden" name="goods_id" value="1">
	                    <td align="center" width="60">
	                        <input name="subBox" type="checkbox" value="1" />
	                    </td>
	                    <td align="center">
	                        <img src="{{ asset('templates/home/images/wimg_450677010_2817349.jpg') }}" alt="商品一"/>
	                        <a href="#">［闵孝琳、朴寒星原款］狐狸毛绒包吊坠_柠檬黄</a>
	                        <div class="operationInfo">
	                            <div class="operationInfoWrap flex">
	                                <p>颜色: <span>天海蓝</span></p>
	                                <p>尺码: <span>M</span></p>
	                            </div>
	                        </div>

	                    </td>
	                    <td align="center">
	                        <span class="qx">￥<span class="uniPrice">221.5</span></span>
	                    </td>
	                    <td align="center" class="quentIpt">
	                        <a class="reduce" href="javascript:;">-</a>
	                        <input class="num" type="text" value="1" disabled>
	                        <a class="plus" href="javascript:;">+</a>
	                    </td>
	                    <td align="center" class="totalMoney"><span>￥<span id="subtotal">220</span></span></td>
	                    <td align="center"><span class="delGoods iconfont icon-shanchu1 del"></span></td>
	                </tr>
	                <tr>
						<input type="hidden" name="goods_id" value="2">
	                    <td align="center" width="60">
	                        <input name="subBox" type="checkbox" value="2" />
	                    </td>
	                    <td align="center">
	                        <img src="{{ asset('templates/home/images/wimg_450677010_2817349.jpg') }}" alt="商品一"/>
	                        <a href="#">［闵孝琳、朴寒星原款］狐狸毛绒包吊坠_柠檬黄</a>
	                        <div class="operationInfo">
	                            <div class="operationInfoWrap flex">
	                                <p>颜色: <span>天海蓝</span></p>
	                                <p>尺码: <span>M</span></p>
	                            </div>
	                        </div>

	                    </td>
	                    <td align="center">
	                        <span class="qx">￥<span class="uniPrice">228</span></span>
	                    </td>
	                    <td align="center" class="quentIpt">
	                        <a class="reduce" href="javascript:;">-</a>
	                        <input class="num" type="text" value="1" disabled>
	                        <a class="plus" href="javascript:;">+</a>
	                    </td>
	                    <td align="center" class="totalMoney"><span>￥<span id="subtotal">220</span></span></td>
	                    <td align="center"><span class="delGoods iconfont icon-shanchu1 del"></span></td>
	                </tr>
	            </tbody>
	            <tfoot>
	                <tr>
	                    <th colspan="4" class="allMoney-th">商品总金额：<span class="allMoney myf">￥<span id="allMoney" class="allMoney">00.00</span></span></th>
	                    <th colspan="2"><span class="settlement">去结算</span></th>
	                </tr>
	            </tfoot>
	        </table>
	    </form>
	    <div class="cart-notice">
	        <img src="{{ asset('templates/home/uploads/icon_notice.png') }}" alt=""/>
	        多选产品时我们可能会给您分开发货
	    </div>
<script src="{{asset('/templates/home/js/shopCar.js')}}"></script>
@endsection
