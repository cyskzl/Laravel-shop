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
    <script src="{{asset('org/uploads/uploadsOneImg.js')}}" type="text/javascript"></script>
    <style>
        .uploadify{ display: inline-block;}
        .uploadify-button{border:none;border-radius:5px;margin-top:8px;}
        .type-file-button{
            border-color: rgb(215, 215, 215);
            border-radius:0px 5px 5px 0px;
            color: rgb(255, 255, 255);
            display: inline-block;
            border-style: solid;
            vertical-align: top;
            border-width: 1px;
            border:none;
            width: 99px;
            height: 38px;
            background-color: #009688;;
        }
        .backclose{
            background:url({{asset('org/uploadify/uploadify-cancel.png')}});display: inline-block;height: 15px;width: 15px; position:relative;left: 95px;top:-36px;
        }
        .model{
            width:700px;
            height:700px;
            /*border:1px solid red;*/
            float: left;

        }
        .attribute{
            margin-left:30px;
            width:400px;
            height:700px;
            float: left;
            /*border:1px solid red;*/
        }
    </style>
@endsection
@section('x-body')
    {{--<form class="layui-form layui-form-pane">--}}
    <form class="layui-form layui-form-pane" action="{{url('/admin/goods')}}" method="post" >
        {{csrf_field()}}
        <div class="layui-tab layui-tab-brief" lay-filter="test"  >
            <ul class="layui-tab-title">
                <li class="layui-this">通用信息</li>
                <li>商品相册</li>
                <li>商品模型</li>
                <li>商品物流</li>
            </ul>
            <div class="layui-tab-content" style="height: 1900px;">

                <div class="layui-tab-item  layui-show">

                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 100px">商品名称</label>
                        <div class="layui-input-block">
                            <input type="text" value="{{$good->goods_name}}" name="goods_name" required="" lay-verify="required" placeholder="请输入商品名称" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">商品简介</label>
                        <div class="layui-input-block">
                            <textarea placeholder="请输入商品简介" name='goods_remark' class="layui-textarea">{{$good->goods_remark}}</textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 100px">商品货号</label>
                        <div class="layui-input-block">
                            <input type="text" value="{{$good->goods_sn}}"  name="goods_sn"  placeholder="如果不填会自动生成" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 100px">SKU</label>
                        <div class="layui-input-block">
                            <input type="text" value="{{$good->sku}}" name="sku" required="" lay-verify="required" placeholder="请输入SKU" autocomplete="off" class="layui-input">
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
                        <div class="layui-input-inline" >
                            <select name="cat_id_02" lay-filter="cate_02">
                                <option value="">请选择商品分类</option>
                                <option value="">请选择商品分类</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <select name="cat_id_03">
                                {{--<option value="">请选择商品分类</option>--}}
                                <option value="">请选择商品分类</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"  style="width: 100px">商品品牌</label>
                        <div class="layui-input-block">
                            <select name="brand_id" lay-filter="aihao">
                                <option value="">请选择商品品牌</option>
                                @foreach($brands as $brand)
                                    <option value="{{$brand->id}}" @if($good->brand_id == $brand->id) selected @endif>{{$brand->name}}</option>
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
                            <input type="text" value="{{$good->shop_price}}" name="shop_price" lay-verify="required" placeholder="请输入本店售价" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label" style="width: 100px">价格阶梯</label>
                            <div class="layui-input-inline" style="width: 140px;margin-left: 10px">
                                <input  type="text" name="price_ladder[]" placeholder="单次购买个数达到" autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-form-mid">价格</div>
                            <div class="layui-input-inline" style="width: 140px;margin-left: 10px">
                                <input type="text" name="price_ladder[]" placeholder="￥" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 100px">市场价
                        </label>
                        <div class="layui-input-inline" style="margin-left: 10px">
                            <input value="{{$good->market_price}}" type="text" name="market_price" lay-verify="required" placeholder="请输入市场价" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 100px">成本价
                        </label>
                        <div class="layui-input-inline" style="margin-left: 10px">
                            <input value="{{$good->cost_price}}" type="text" name="cost_price" lay-verify="required" placeholder="请输入成本价" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item" >
                        <div id="queue"></div>
                        <div class="layui-form-item" >
                            <label class="layui-form-label">图片</label>
                            <div class="layui-input-inline" style="margin-left:30px;">
                                <input type="text" name="img" placeholder="不修改默认为空" id="imgone" autocomplete="off" class="layui-input">
                            </div>
                            <input id="file_oneupload"  type="file" multiple="true">

                        </div>
                        <div class="layui-form-item" id = 'thumbnail'>
                            <label class="layui-form-label">缩略图
                            </label>
                            <div id='uploadone' class='uploadone' style='width: 660px;'>
                            </div>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 100px">总库存
                        </label>
                        <div class="layui-input-inline" style="margin-left: 10px">
                            <input type="text" value="{{$good->store_count}}" name="store_count" lay-verify="required" placeholder="请输入总库存" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 100px">商品关键字</label>
                        <div class="layui-input-block">
                            <input type="text" name="keywords" value="{{$good->keywords}}" required="" lay-verify="required" placeholder="请输入商品关键字" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px">
                            商品详情描述
                        </label>
                        <div class="layui-input-block">
                            <textarea id="editor" name="goods_content" style="width:1080px;height:500px;" type="text/plain">{{$good->goods_content}}</textarea>
                            <script >
                                //实例化编辑器
                                //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                                var ue = UE.getEditor('editor');
                            </script>
                        </div>
                    </div>


                </div>
                <div lay-percent="0%" lay-filter="demo" class="layui-tab-item ">

                    <div class="layui-form-item" >
                        <div id="queue"></div>
                        <div class="layui-form-item" >
                            <label class="layui-form-label" style="width: 100px">图片</label>
                            <div class="layui-input-inline" style="margin-left:10px;">
                                <input type="text" name="image_url" id="img" autocomplete="off" class="layui-input">
                            </div>
                            <input id="file_upload"  type="file" multiple="true">

                        </div>
                        <div class="layui-form-item" id = 'thumbnail'>
                            <label class="layui-form-label" style="width: 100px">缩略图
                            </label>
                            <div id='layer-photos-demo' class='layer-photos-demo' style='width: 660px;'>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-tab-item">
                    {{--商品模型--}}
                    <div class="layui-form-item">
                        <label class="layui-form-label"  style="width: 100px">商品模型</label>
                        <div class="layui-input-block">
                            {{--<select name="type_id" lay-filter="choice-mod" data-key="{{$key}}">--}}
                                {{--<option value="">请选择模型</option>--}}
                                {{--<option value="0">请选择模型</option>--}}
                                {{--@foreach($types as $type)--}}
                                    {{--<option value="{{$type->id}}" @if($type->id == $good->goods_type) selected @endif>{{$type->name}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    </div>
                    <div id="model" class="model">
                        <table id="attr" class="layui-table attr" lay-skin="row">
                            <th>商品规格</th>
                        </table>
                        <table id="mod" class="layui-table mod" lay-skin="row">

                        </table>
                        <div id="goods_spec_table2" style="height: 500px;display: inline-block;width: 700px;">
                            <table id="table-mod" class="layui-table" >

                            </table>
                            <div>
                            </div>
                        </div>
                    </div>
                    <div id="attribute" class="attribute">
                        <table id="attr" class="layui-table attr" lay-skin="row">
                            <th>商品属性</th>
                        </table>
                        <div class="content"></div>
                    </div>
                    <div class="layui-tab-item">内容4</div>
                </div>
            </div>
            <center>
                <div class="layui-form-item">
                    <button class="layui-btn" lay-filter="add" lay-submit>立即发布</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </center>
    </form>
@endsection

@section('js')
    <script>

        layui.use(['form','element','layer','layedit'], function(){
            $ = layui.jquery;
            var form = layui.form()
                ,layer = layui.layer
                ,layedit = layui.layedit;
            var element = layui.element();
            $form = $('form');
            //获取商品分类信息
            form.on('select(filter)', function(data){
//                console.log(data.value);
                if(data.value !== null){
                    $form.find('select[name=cat_id_02]').children().remove();
                    $.ajax({
                        type     : 'post',
                        url      : '/admin/ajaxCate',
                        dataType : 'json',
                        data     :  {'_token': '{{csrf_token()}}', 'fatcate': data.value},
                        success:function (data){
                            for(var i=0; i<data.length; i++){
                                var id = data[i]['id'];
                                var name = data[i]['name'];
                                var str = '';
                                var char = '';
                                char += '<option value="">请选择商品分类</option>';
                                str += '<option value="'+id+'">'+name+'</option>';
                                $form.find('select[name=cat_id_02]').prepend(char).append(str);
                            }
                            form.render();
                        }
                    });

                }
            });
            //获取三级分类信息
            form.on('select(cate_02)', function(data){
//            console.log(data.value);
                var cate_02 = data.value;
                $form.find('select[name=cat_id_03]').children().remove();
                $.ajax({
                    type     : 'post',
                    url      : '/admin/ajaxCate',
                    dataType : 'json',
                    data     :  {'_token': '{{csrf_token()}}', 'three': data.value},
                    success:function (data){
                        var str = '';
                        var char = '';
                        for(var i=0; i<data.length; i++){
                            var id = data[i]['id'];
                            var name = data[i]['name'];
//                                console.log(id);
//                                console.log();

                            str += '<option value="'+id+'">'+name+'</option>';
                        }

                        char += '<option value="">请选择商品分类</option><option value="">请选择商品分类</option>';
//                    console.log(data);
                        if(data.status == 0){
//                                alert(1);
                            $form.find('select[name=cat_id_03]').children().remove();
                        }
//                            console.log(char);
                        $form.find('select[name=cat_id_03]').prepend(char).append(str);
                        form.render();
                    }
                });

//                }
            });
            //先获取val值
            $typeval = $('select[name="type_id"]  option:selected').val();
            var key = $('select[name="type_id"]').attr('data-key');
            if($typeval !== ''){
                var newType = $('select[name="type_id" ]').attr('type_id', $typeval);
                if($('select[name="type_id" ]').attr('type_id') !== newType){
                    $('#table-mod').children().remove();
                }
                if($typeval == 0){
                    $('#table-mod').children().remove();
                }

                if($typeval !== 0){
                    $('.mod').children().remove();
                    $.ajax({
                        type     : 'post',
                        url      : '/admin/ajaxModel',
                        dataType : 'json',
                        data     :  {'_token': '{{csrf_token()}}', 'type': $typeval},
                        success:function (data){
                            //全局变量

                            var keycom = key.split('_');

                            var keysrt = '';
                            var str = '';
                            for(var i=0; i<data.length; i++){

                                var strss ='';
                                var strs = data[i]['specitem'].split(',');
                                var specidsplit = data[i]['specid'].split(',');
                                var specid = data[i]['id'];
                                var spec_id = data[i]['spec_id'];
                                var spec_name = data[i]['name'];
                                for(var j=0; j< strs.length;j++){
                                    for(var m=0; m<keycom.length;m++){
                                        keysrt += keycom[m];
                                        if( keycom[m] == specidsplit[j]){
                                            strss +=  '<input name="rose[]" type="checkbox" checked="checked" lay-filter="spec_che" data-spec_name='+spec_name+' id="spec_but"  class="layui-btn  layui-btn-normal spec_but" data-item_id='+spec_id+'  data-spec-id='+specidsplit[j]+' value='+strs[j]+'_'+specidsplit[j]+'>'+strs[j]+'';
                                        }
                                    }
                                    strss +=  '<input name="rose[]"    type="checkbox" lay-filter="spec_che" data-spec_name='+spec_name+' id="spec_but"  class="layui-btn  layui-btn-normal spec_but" data-item_id='+spec_id+'  data-spec='+strs[j]+' value='+strs[j]+'_'+specidsplit[j]+'>'+strs[j]+'';
                                }

                                var name = data[i]['name'];
                                str += '<tr class="Father"><td class="item_name">'+name+'</td><td id="tableitem">'+strss+'</td></tr>';
                            }
                            $('.mod').append(str);
                            form.render();

                        }
                    });
                    //商品属性
                    $('.content').children().remove();
                    $.ajax({
                        type: 'post',
                        url: '/admin/ajaxAttr',
                        dataType: 'json',
                        data: {'_token': '{{csrf_token()}}', 'type': $typeval},
                        success: function (data) {
                            var str = '';
                            for(var i=0;i<data.length;i++){
                                var com = '';
                                var strtext = '';
                                var strtextarea = '';
                                if(data[i]['attr_input_type'] == '1' ){

                                    var strs = data[i]['attr_values'].split(',');

                                    for(var j=0; j< strs.length;j++){

                                        com += '<option value='+strs[j]+'>'+strs[j]+'</option>';
                                    }
                                    //当  attr_input_type == 1 下拉框
                                    str += '<div class="layui-form-item">';
                                    str += '<label class="layui-form-label"  style="width: 100px"> '+data[i]['attr_name']+'</label>';
                                    str +=  '<div class="layui-input-block">';
                                    str +=   '<select name="attr_'+data[i]['attr_id']+'['+data[i]['attr_id']+']">'+com+'</select>';
                                    str +=  '</div></div>';
                                    $('.content').append(str);
                                    //  0  就是text的
                                } else if(data[i]['attr_input_type'] == '0'){
                                    //                                    console.log(data[i]['attr_name']);
                                    strtext += '<div class="layui-form-item">';
                                    strtext += '<label class="layui-form-label"  style="width: 100px">'+data[i]['attr_name']+'</label>';
                                    strtext +=  '<div class="layui-input-inline" style="margin-left:12px">';
                                    strtext +=   '<input placeholder="请输入内容" class="layui-input" type="text" value="" name="attr_'+data[i]['attr_id']+'['+data[i]['attr_id']+']" >';
                                    strtext +=  '</div></div>';
                                    $('.content').append(strtext);
                                    //2  就是textarea的
                                }else if(data[i]['attr_input_type'] == '2'){
                                    //                                    console.log(data[i]['attr_name']);
                                    strtext += '<div class="layui-form-item">';
                                    strtext += '<label class="layui-form-label"  style="width: 100px">'+data[i]['attr_name']+'</label>';
                                    strtext +=  '<div class="layui-input-inline" style="margin-left:12px;width:270px">';
                                    strtext +=   '<textarea placeholder="请输入内容" class="layui-textarea" name="attr_'+data[i]['attr_id']+'['+data[i]['attr_id']+']"></textarea>';
                                    strtext +=  '<input type="hidden" value='+data[i]['attr_id']+' name="attr_id">';
                                    strtext +=  '</div></div>';
                                    $('.content').append(strtext);
                                }
                                form.render();

                            }

                        }
                    });
                    //模型添加
                    form.on('checkbox(spec_che)', function(data){

                        var step = {
                            createSku:function(){
                                var skuObj = $(".Father").has("input[type='checkbox']:checked");

                                if (skuObj.length < 1) {
                                    // 如果没有选中的情况下，情况table2里面的内容
                                    step.clearTable();
                                    return false; //后面的代码没必要进行下去
                                };
                                //=====================
                                // 要获取 选中了规格值的 规格名：性别、网络...
                                var arrayTitle = new Array();
                                // 要获取 规格值和对应的id : 男_1 、 女_2...
                                var arrayItem = new Array();
                                // 保存所有的信息
                                var arrayInfo = new Array();
                                $.each(skuObj, function(i, item){

                                    // 压入要生成标题数组中
                                    arrayInfo[i] = new Array();
                                    arrayInfo[i].push($(this).find("td").first().html());
                                    // 要获取 规格值和对应的id
                                    var order = new Array();
                                    $(this).find("input[type='checkbox']:checked").each(function (){
                                        order.push($(this).val()); // 这里将当前规格下的规格项 写入数组order
                                    });
                                    arrayInfo[i].push(order);

                                });

                                /**
                                 * 这个函数是sort的排序规格
                                 * arr，arr2 是数组中的相邻的两个
                                 */
                                function countArr(arr, arr2){
                                    if (arr[1].length >  arr2[1].length) {
                                        return 1;
                                    }else {
                                        return -1
                                    }
                                }

                                // 对收集到的数组排序
                                arrayInfo.sort(countArr);

                                // 分离标题  和  规格值
                                for (var i = 0; i < arrayInfo.length; i ++) {
                                    arrayTitle[i] = arrayInfo[i][0];  // 标题数组
                                    arrayItem[i] = arrayInfo[i][1];
                                };

                                // 获取到了 笛卡尔积 数组
                                var arrayDkej = step.combine(arrayItem);
                                var row = [];
                                // arrayDkej = 6    arrayItem =  1 * 2 * 3
                                // 对应的td 的colspan = 3 、2 、1
                                rowspan = arrayDkej.length;

                                for(var n=arrayItem.length-1; n>-1; n--) {
                                    //总条数除以arr2内每个数组的长度
                                    row[n] = parseInt(rowspan/arrayItem[n].length);
                                    rowspan = row[n];
                                }

                                row.reverse();
                                var str = "";
                                var len = arrayDkej[0].length;
                                for (var i=0; i<arrayDkej.length; i++) {
                                    var tmp = "";
                                    var itemsId = "";  // 用来做对应的price和sotre的input框的name值
                                    for(var j=0; j<len; j++) {
                                        var item = arrayDkej[i][j].split("_");
                                        if (itemsId == "") {
                                            itemsId = itemsId +""+item[1];

                                        } else {
                                            itemsId = itemsId + "_"+ item[1];

                                        }

                                        if(i%row[j]==0 && row[j]>1) {
                                            tmp += "<td rowspan='"+ row[j] +"'>"+item[0]+"</td>";
                                        }else if(row[j]==1){
                                            tmp += "<td>"+item[0]+"</td>";
                                        }
                                    }
                                    str += "<tr>" + tmp + "<td><input type='text' name='items["+itemsId+"][price]'/></td>" + "<td><input type='text' name='it["+itemsId+"][store_count]'/></td>" + "</tr>";
                                }
                                // 创建标题
                                step.clearTable();
                                table = $("#table-mod");
                                var thead = $("<thead></thead>");
                                thead.appendTo(table);
                                var trHead = $("<tr></tr>");
                                trHead.appendTo(thead);
                                //创建表头
                                $.each(arrayTitle, function (index, item) {
                                    var td = $("<th>" + item + "</th>");
                                    td.appendTo(trHead);
                                });
                                var itemColumHead = $("<th>价格</th><th>库存</th>");
                                itemColumHead.appendTo(trHead);
                                var tbody = $("<tbody></tbody>");
                                tbody.appendTo(table);
                                tbody.html(str);
                            },

                            clearTable:function(){
                                $("#table-mod").html("");
                            },
                            //求出笛卡尔乘积的函数
                            combine:function (arr) {
                                var r = [];
                                (function f(t, a, n) {
                                    if (n == 0) return r.push(t);
                                    for (var i = 0; i < a[n-1].length; i++) {
                                        f(t.concat(a[n-1][i]), a, n - 1);
                                    }
                                })([], arr, arr.length);
                                return r;
                            },
                        };
                        //调用
                        step.createSku();


                    });
                }
            }












            //获取规格列表
            form.on('select(choice-mod)',function(data){

                //                console.log(data.elem); //得到select原始DOM对象
                //                console.log(data.value); //得到被选中的值
                var newType = $('select[name="type_id" ]').attr('type_id', data.value);
                if($('select[name="type_id" ]').attr('type_id') !== newType){
                    $('#table-mod').children().remove();
                }
                if(data.value == 0){
                    $('#table-mod').children().remove();
                }
                if(data.value !== 0){
                    $('.mod').children().remove();
                    $.ajax({
                        type     : 'post',
                        url      : '/admin/ajaxModel',
                        dataType : 'json',
                        data     :  {'_token': '{{csrf_token()}}', 'type': data.value},
                        success:function (data){
                            //全局变量
                            var str = '';
                            for(var i=0; i<data.length; i++){
                                var strss ='';
                                var strs = data[i]['specitem'].split(',');
                                var specidsplit = data[i]['specid'].split(',');
                                var specid = data[i]['id'];
                                var spec_id = data[i]['spec_id'];
                                var spec_name = data[i]['name'];
                                for(var j=0; j< strs.length;j++){
                                    for(var m=0; m<keycom.length;m++){
                                        keysrt += keycom[m];
                                        if( keycom[m] == specidsplit[j]){
                                            strss +=  '<input name="rose[]" type="checkbox" checked="checked" lay-filter="spec_che" data-spec_name='+spec_name+' id="spec_but"  class="layui-btn  layui-btn-normal spec_but" data-item_id='+spec_id+'  data-spec-id='+specidsplit[j]+' value='+strs[j]+'_'+specidsplit[j]+'>'+strs[j]+'';
                                        }
                                    }
                                    strss +=  '<input name="rose[]"  type="checkbox" lay-filter="spec_che" data-spec_name='+spec_name+' id="spec_but"  class="layui-btn  layui-btn-normal spec_but" data-item_id='+spec_id+'  data-spec='+strs[j]+' value='+strs[j]+'_'+specidsplit[j]+'>'+strs[j]+'';
                                }

                                var name = data[i]['name'];
                                str += '<tr class="Father"><td class="item_name">'+name+'</td><td id="tableitem">'+strss+'</td></tr>';
                            }
                            $('.mod').append(str);
                            form.render();

                        }
                    });
                    //商品属性
                    $('.content').children().remove();
                    $.ajax({
                        type: 'post',
                        url: '/admin/ajaxAttr',
                        dataType: 'json',
                        data: {'_token': '{{csrf_token()}}', 'type': data.value},
                        success: function (data) {
                            var str = '';
                            for(var i=0;i<data.length;i++){
                                var com = '';
                                var strtext = '';
                                var strtextarea = '';
                                if(data[i]['attr_input_type'] == '1' ){

                                    var strs = data[i]['attr_values'].split(',');

                                    for(var j=0; j< strs.length;j++){

                                        com += '<option value='+strs[j]+'>'+strs[j]+'</option>';
                                    }
                                    //当  attr_input_type == 1 下拉框
                                    str += '<div class="layui-form-item">';
                                    str += '<label class="layui-form-label"  style="width: 100px"> '+data[i]['attr_name']+'</label>';
                                    str +=  '<div class="layui-input-block">';
                                    str +=   '<select name="attr_'+data[i]['attr_id']+'['+data[i]['attr_id']+']">'+com+'</select>';
                                    str +=  '</div></div>';
                                    $('.content').append(str);
                                    //  0  就是text的
                                } else if(data[i]['attr_input_type'] == '0'){
                                    //                                    console.log(data[i]['attr_name']);
                                    strtext += '<div class="layui-form-item">';
                                    strtext += '<label class="layui-form-label"  style="width: 100px">'+data[i]['attr_name']+'</label>';
                                    strtext +=  '<div class="layui-input-inline" style="margin-left:12px">';
                                    strtext +=   '<input placeholder="请输入内容" class="layui-input" type="text" value="" name="attr_'+data[i]['attr_id']+'['+data[i]['attr_id']+']" >';
                                    strtext +=  '</div></div>';
                                    $('.content').append(strtext);
                                    //2  就是textarea的
                                }else if(data[i]['attr_input_type'] == '2'){
                                    //                                    console.log(data[i]['attr_name']);
                                    strtext += '<div class="layui-form-item">';
                                    strtext += '<label class="layui-form-label"  style="width: 100px">'+data[i]['attr_name']+'</label>';
                                    strtext +=  '<div class="layui-input-inline" style="margin-left:12px;width:270px">';
                                    strtext +=   '<textarea placeholder="请输入内容" class="layui-textarea" name="attr_'+data[i]['attr_id']+'['+data[i]['attr_id']+']"></textarea>';
                                    strtext +=  '<input type="hidden" value='+data[i]['attr_id']+' name="attr_id">';
                                    strtext +=  '</div></div>';
                                    $('.content').append(strtext);
                                }
                                form.render();

                            }

                        }
                    });
                    //模型添加
                    form.on('checkbox(spec_che)', function(data){

                        var step = {
                            createSku:function(){
                                var skuObj = $(".Father").has("input[type='checkbox']:checked");

                                if (skuObj.length < 1) {
                                    // 如果没有选中的情况下，情况table2里面的内容
                                    step.clearTable();
                                    return false; //后面的代码没必要进行下去
                                };
                                //=====================
                                // 要获取 选中了规格值的 规格名：性别、网络...
                                var arrayTitle = new Array();
                                // 要获取 规格值和对应的id : 男_1 、 女_2...
                                var arrayItem = new Array();
                                // 保存所有的信息
                                var arrayInfo = new Array();
                                $.each(skuObj, function(i, item){

                                    // 压入要生成标题数组中
                                    arrayInfo[i] = new Array();
                                    arrayInfo[i].push($(this).find("td").first().html());
                                    // 要获取 规格值和对应的id
                                    var order = new Array();
                                    $(this).find("input[type='checkbox']:checked").each(function (){
                                        order.push($(this).val()); // 这里将当前规格下的规格项 写入数组order
                                    });
                                    arrayInfo[i].push(order);

                                });

                                /**
                                 * 这个函数是sort的排序规格
                                 * arr，arr2 是数组中的相邻的两个
                                 */
                                function countArr(arr, arr2){
                                    if (arr[1].length >  arr2[1].length) {
                                        return 1;
                                    }else {
                                        return -1
                                    }
                                }

                                // 对收集到的数组排序
                                arrayInfo.sort(countArr);

                                // 分离标题  和  规格值
                                for (var i = 0; i < arrayInfo.length; i ++) {
                                    arrayTitle[i] = arrayInfo[i][0];  // 标题数组
                                    arrayItem[i] = arrayInfo[i][1];
                                };

                                // 获取到了 笛卡尔积 数组
                                var arrayDkej = step.combine(arrayItem);
                                var row = [];
                                // arrayDkej = 6    arrayItem =  1 * 2 * 3
                                // 对应的td 的colspan = 3 、2 、1
                                rowspan = arrayDkej.length;

                                for(var n=arrayItem.length-1; n>-1; n--) {
                                    //总条数除以arr2内每个数组的长度
                                    row[n] = parseInt(rowspan/arrayItem[n].length);
                                    rowspan = row[n];
                                }

                                row.reverse();
                                var str = "";
                                var len = arrayDkej[0].length;
                                for (var i=0; i<arrayDkej.length; i++) {
                                    var tmp = "";
                                    var itemsId = "";  // 用来做对应的price和sotre的input框的name值
                                    for(var j=0; j<len; j++) {
                                        var item = arrayDkej[i][j].split("_");
                                        if (itemsId == "") {
                                            itemsId = itemsId +""+item[1];

                                        } else {
                                            itemsId = itemsId + "_"+ item[1];

                                        }

                                        if(i%row[j]==0 && row[j]>1) {
                                            tmp += "<td rowspan='"+ row[j] +"'>"+item[0]+"</td>";
                                        }else if(row[j]==1){
                                            tmp += "<td>"+item[0]+"</td>";
                                        }
                                    }
                                    str += "<tr>" + tmp + "<td><input type='text' name='items["+itemsId+"][price]'/></td>" + "<td><input type='text' name='it["+itemsId+"][store_count]'/></td>" + "</tr>";
                                }
                                // 创建标题
                                step.clearTable();
                                table = $("#table-mod");
                                var thead = $("<thead></thead>");
                                thead.appendTo(table);
                                var trHead = $("<tr></tr>");
                                trHead.appendTo(thead);
                                //创建表头
                                $.each(arrayTitle, function (index, item) {
                                    var td = $("<th>" + item + "</th>");
                                    td.appendTo(trHead);
                                });
                                var itemColumHead = $("<th>价格</th><th>库存</th>");
                                itemColumHead.appendTo(trHead);
                                var tbody = $("<tbody></tbody>");
                                tbody.appendTo(table);
                                tbody.html(str);
                            },

                            clearTable:function(){
                                $("#table-mod").html("");
                            },
                            //求出笛卡尔乘积的函数
                            combine:function (arr) {
                                var r = [];
                                (function f(t, a, n) {
                                    if (n == 0) return r.push(t);
                                    for (var i = 0; i < a[n-1].length; i++) {
                                        f(t.concat(a[n-1][i]), a, n - 1);
                                    }
                                })([], arr, arr.length);
                                return r;
                            },
                        };
                        //调用
                        step.createSku();


                    });
                }
            });
        });

        //logo 图实例
        var token ='{{csrf_token()}}';
        var uploadPath = "{{url('admin/upload/goods')}}"
        //实例化上传函数
        upload(uploadPath,token);
        //实例化删除函数
        delimg(uploadPath);
        // 实例化上传函数
        oneUpload(uploadPath,token);
        // 实例化删除函数
        delOneImg(uploadPath)
    </script>
    <script>

    </script>

@endsection