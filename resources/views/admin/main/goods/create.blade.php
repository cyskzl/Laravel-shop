@extends('admin.layouts.layout')
@section('style')
    <script id="container" name="content" type="text/plain"></script>
    <!-- 配置文件 -->
    <script type="text/javascript" src="{{asset('templates/admin/ueditor/ueditor.config.js')}}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{asset('templates/admin/ueditor/ueditor.all.js')}}"></script>
    <!-- 实例化编辑器 -->
    <script src="{{asset('templates/admin/js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('org/uploadify/uploadify.css')}}">
    <script src="{{asset('org/uploads/uploadsImg.js')}}" type="text/javascript"></script>
    <style>
        .uploadify {
            display: inline-block;
        }

        .uploadify-button {
            border: none;
            border-radius: 5px;
            margin-top: 8px;
        }

        .type-file-button {
            border-color: rgb(215, 215, 215);
            border-radius: 0px 5px 5px 0px;
            color: rgb(255, 255, 255);
            display: inline-block;
            border-style: solid;
            vertical-align: top;
            border-width: 1px;
            border: none;
            width: 99px;
            height: 38px;
            background-color: #009688;;
        }

        .backclose {
            background: url({{asset('org/uploadify/uploadify-cancel.png')}});
            display: inline-block;
            height: 15px;
            width: 15px;
            position: relative;
            left: 95px;
            top: -36px;
        }
    </style>
@endsection
@section('x-body')
    <div class="layui-tab layui-tab-brief" lay-filter="test">
        <ul class="layui-tab-title">
            <li id="one" class="select">通用信息</li>
            <li id="two" class="select">商品相册</li>
            <li id="three" class="select">商品模型</li>
            <li id="four" class="select">商品物流</li>
        </ul>
    </div>
    <div class="layui-tab-content" style="height: 1900px;">
        <form class="layui-form layui-form-pane" action="{{url('/admin/goods')}}" method="post">
            {{csrf_field()}}
            <div class="layui-tab-item goods">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 100px">商品名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="goods_name" required="" lay-verify="required" placeholder="请输入商品名称"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">商品简介</label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入商品简介" name='goods_remark' class="layui-textarea"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 100px">商品货号</label>
                    <div class="layui-input-block">
                        <input type="text" name="goods_sn" required="" lay-verify="required" placeholder="如果不填会自动生成"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                {{--<div class="layui-form-item">--}}
                {{--<label class="layui-form-label" style="width: 100px">SPU</label>--}}
                {{--<div class="layui-input-block">--}}
                {{--<input type="text" name="name" required="" lay-verify="required" placeholder="请输入SPU" autocomplete="off" class="layui-input">--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 100px">SKU</label>
                    <div class="layui-input-block">
                        <input type="text" name="sku" required="" lay-verify="required" placeholder="请输入SKU"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 100px">商品分类</label>
                    <div class="layui-input-inline" style="margin-left: 10px">
                        <select name="cat_id" id="cat_id" lay-filter="filter">
                            <option value="">请选择商品分类</option>
                            @foreach($fatcates as $fatcate)
                                <option value="{{$fatcate->id}}">{{$fatcate->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="layui-input-inline">
                        <select name="cat_id_02" lay-filter="cate_02">
                            <option value="">请选择商品分类</option>
                            <option value="">请选择商品分类</option>
                        </select>
                    </div>
                    <div class="layui-input-inline">
                        <select name="cat_id_03">
                            <option value="">请选择商品分类</option>
                            <option value="">请选择商品分类</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 100px">商品品牌</label>
                    <div class="layui-input-block">
                        <select name="brand_id" lay-filter="aihao">
                            <option value="">请选择商品品牌</option>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 100px">供应商</label>
                    <div class="layui-input-inline" style="margin-left: 10px">
                        <select name="">
                            <option value="">不指定供应商属于本店商品</option>
                            <option value="">不指定供应商属于本店商品</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 100px">本店售价
                    </label>
                    <div class="layui-input-inline" style="margin-left: 10px">
                        <input type="text" name="shop_price" lay-verify="required" placeholder="请输入本店售价"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label" style="width: 100px">价格阶梯</label>
                        <div class="layui-input-inline" style="width: 140px;margin-left: 10px">
                            <input type="text" name="price_ladder[]" placeholder="单次购买个数达到" autocomplete="off"
                                   class="layui-input">
                        </div>
                        <div class="layui-form-mid">价格</div>
                        <div class="layui-input-inline" style="width: 140px;margin-left: 10px">
                            <input type="text" name="price_ladder[]" placeholder="￥" autocomplete="off"
                                   class="layui-input">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 100px">市场价
                    </label>
                    <div class="layui-input-inline" style="margin-left: 10px">
                        <input type="text" name="market_price" lay-verify="required" placeholder="请输入市场价"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 100px">成本价
                    </label>
                    <div class="layui-input-inline" style="margin-left: 10px">
                        <input type="text" name="cost_price" lay-verify="required" placeholder="请输入成本价"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>


                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 100px">总库存
                    </label>
                    <div class="layui-input-inline" style="margin-left: 10px">
                        <input type="text" name="store_count" lay-verify="required" placeholder="请输入总库存"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 100px">商品关键字</label>
                    <div class="layui-input-block">
                        <input type="text" name="keywords" required="" lay-verify="required" placeholder="请输入商品关键字"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width:100px">
                        商品详情描述
                    </label>
                    <div class="layui-input-block">
                        <textarea id="editor" name="goods_content" style="width:1080px;height:500px;"
                                  type="text/plain"></textarea>
                        <script>
                            //实例化编辑器
                            //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                            var ue = UE.getEditor('editor');
                        </script>
                    </div>
                </div>
            </div>
            <div lay-percent="0%" lay-filter="demo" class="layui-tab-item goods" style="display: none;">

                <div class="layui-form-item">
                    <div id="queue"></div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 100px">图片</label>
                        <div class="layui-input-inline" style="margin-left:10px;">
                            <input type="text" name="original_img" id="img" autocomplete="off" class="layui-input">
                        </div>
                        <input id="file_upload" type="file" multiple="true">

                    </div>
                    <div class="layui-form-item" id='thumbnail'>
                        <label class="layui-form-label" style="width: 100px">缩略图
                        </label>
                        <div id='layer-photos-demo' class='layer-photos-demo' style='width: 660px;'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-tab-item goods" style="display: none;">内容3</div>
            <div class="layui-tab-item goods" style="display: none;">内容4</div>

        </form>
    </div>

    <center>
        <div style='margin-top: -280px'>
            <a class="layui-btn" lay-filter="add" lay-submit href="javascript:;" onclick="onGoods();">立即发布</a>
        </div>
    </center>

@endsection

@section('js')
    <script>
        //        <select name="cat_id" onchange="get_category(this.value,'cat_id_2','0')">
        $('.goods').eq(0).show();
        $('.goods').eq(1).hide();
        $('.goods').eq(2).hide();
        $('.goods').eq(3).hide();
        $('.select').click(function (event) {
            if ($(this).attr('id') == 'one') {
                console.log($('.layui-show').eq(0));
                $('.goods').eq(0).show();
                $('.goods').eq(1).hide();
                $('.goods').eq(2).hide();
                $('.goods').eq(3).hide();
            }
            if ($(this).attr('id') == 'two') {
                $('.goods').eq(0).hide();
                $('.goods').eq(1).show();
                $('.goods').eq(2).hide();
                $('.goods').eq(3).hide();
            }
            if ($(this).attr('id') == 'three') {
                $('.goods').eq(0).hide();
                $('.goods').eq(1).hide();
                $('.goods').eq(2).show();
                $('.goods').eq(3).hide();
            }
            if ($(this).attr('id') == 'four') {
                $('.goods').eq(0).hide();
                $('.goods').eq(1).hide();
                $('.goods').eq(2).hide();
                $('.goods').eq(3).show();
            }
        });
        function onGoods() {
            console.log(1);
            layui.use(['form', 'element', 'layer', 'layedit'], function () {
                $ = layui.jquery;
                var form = layui.form()
                    , layer = layui.layer
                    , layedit = layui.layedit;
                $form = $('form');

                form.on('select(filter)', function (data) {
                    if (data.value !== null) {
                        $form.find('select[name=cat_id_02]').children().remove();
                        $.ajax({
                            type: 'post',
                            url: '/admin/ajaxCate',
                            dataType: 'json',
                            data: {'_token': '{{csrf_token()}}', 'fatcate': data.value},
                            success: function (data) {

                                for (var i = 0; i < data.length; i++) {
                                    var id = data[i]['id'];
                                    var name = data[i]['name'];
                                    var str = '';
                                    var char = '';
                                    char += '<option value="">请选择商品分类</option>';
                                    str += '<option value="' + id + '">' + name + '</option>';
                                    $form.find('select[name=cat_id_02]').prepend(char).append(str);
                                }
                                form.render();
                            }
                        });

                    }
                });
                form.on('select(cate_02)', function (data) {
                    if (data.value !== null) {
                        $form.find('select[name=cat_id_03]').children().remove();
                        $.ajax({
                            type: 'post',
                            url: '/admin/ajaxCate',
                            dataType: 'json',
                            data: {'_token': '{{csrf_token()}}', 'three': data.value},
                            success: function (data) {

                                for (var i = 0; i < data.length; i++) {
                                    var id = data[i]['id'];
                                    var name = data[i]['name'];
                                    var str = '';
                                    var char = '';
                                    char += '<option value="">请选择商品分类</option>';
                                    str += '<option value="' + id + '">' + name + '</option>';
                                    $form.find('select[name=cat_id_03]').prepend(char).append(str);
                                }
                                form.render();

                            }
                        });

                    }
                });
            });
        }


        //logo 图实例
        var token = '{{csrf_token()}}';
        var uploadPath = "{{url('admin/upload/goods')}}"
        //实例化上传函数
        upload(uploadPath, token)
        //实例化删除函数
        delimg(uploadPath)
    </script>
@endsection