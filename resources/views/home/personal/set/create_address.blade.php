@extends('home.layouts.layout_two')

@section('title','添加收货地址')

@section('style')
    <link rel="stylesheet" href="{{asset('/templates/home/css/addres.css')}}"/>
@endsection

@section('main')
    <!-- 内容 -->
        <div class="page_block">
            <div class="page_title">收货地址</div>
            <div class="edit_address_from">
                <form action="">
                    <div class="form_title">添加收货地址</div>
                    <div class="from_row">
                        <label>收货人姓名</label>
                        <input type="text" placeholder="请填写收货人姓名"/>
                    </div>
                    <div class="from_row">
                        <label>手机号码</label>
                        <input type="text" placeholder="请填写手机号码"/>
                    </div>
                    <div class="from_row">
                        <label>收货地址</label>
                        <select name="region" id="region_province" class="validate-select"></select>
                        <select name="region" id="region_city" class="validate-select"></select>
                        <select name="region" id="region_district" class="validate-select"></select>
                    </div>
                    <div class="from_row">
                        <label>详细地址</label>
                        <textarea name="" id="street" placeholder="请填写详细地址" cols="30" rows="10"></textarea>
                    </div>
                    <div class="from_row">
                        <label></label>
                        <input type="checkbox" checked/>
                        <span>设为默认收货地址</span>
                    </div>
                    <div class="from_row">
                        <label>身份证号码</label>
                        <input type="text" placeholder="请填写身份证号码"/>
                        <br/>
                        <p class="iTips">(注：购买直邮/跨境通/行邮商品，请记得填写身份证号码)</p>
                        <div class="certifyArea">
                            <div class="idcardsubmit">
                                <div class="certifyItem clearfix">
                                    <label class="fl">身份证号码</label>
                                    <a class="fl" href="javascript:;">
                                        <em>+</em>
                                        上传图片
                                    </a>
                                    <div class="fl demonstration">
                                        <img src="./uploads/positive_model.png" alt=""/>
                                        <p>正面示范</p>
                                    </div>
                                </div>
                                <div class="certifyItem clearfix">
                                    <label class="fl">身份证号码</label>
                                    <a class="fl" href="javascript:;">
                                        <em>+</em>
                                        上传图片
                                    </a>
                                    <div class="fl demonstration">
                                        <img src="./uploads/negative_model.png" alt=""/>
                                        <p>正面示范</p>
                                    </div>
                                </div>
                            </div>
                            <div class="certifyItem">
                                <ul>
                                    <li>根据中国海关要求，入境走个人行邮通道的物品，购买者必须提供清晰的身份证正反面照片，如下几种情况包裹将不能正常清关：</li>
                                    <li>1、没有提供上传的图片的姓名，身份证号和上面填写不符时；</li>
                                    <li>2、身份证姓名和收件人姓名不符；</li>
                                    <li>3、上传图片不清晰，以能看到身份证底纹为标准；</li>
                                    <li>4、身份证图片不全。</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="from_row">
                        <input type="submit" value="保存" class="btn_subbmit"/>
                    </div>
                </form>
            </div>
        </div>
@endsection