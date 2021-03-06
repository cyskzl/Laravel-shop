<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <title>订单信息修改</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="{{asset('templates/admin/css/x-admin.css')}}" media="all">
    </head>
    <body>
        <div class="x-body">
            <form class="layui-form layui-form-pane" action="./{{$ordergoods->id}}" method="PUT">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="_method" value="PUT">
                <div class="layui-form-item">
                    <label for="L_title" class="layui-form-label">
                         订单总额
                    </label>
                    <div class="layui-input-block">
                        <span class="layui-input">￥<b>{{$ordergoods->goods_price + $ordergoods->shipping_price}}</b>(商品总价:{{$ordergoods->goods_price}} 运费:{{$ordergoods->shipping_price}})</span>
                        <span style="font-size: 12px;">订单总额=商品总价+运费</span>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="L_title" class="layui-form-label">
                        收货人
                    </label>
                    <div class="layui-input-block">
                        <input type="text" id="L_title" name="consignee" required lay-verify="title" value="{{$ordergoods->consignee}}"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="L_title" class="layui-form-label">
                        手机
                    </label>
                    <div class="layui-input-block">
                        <input type="text" id="L_title" name="mobile" required lay-verify="title" value="{{$ordergoods->mobile}}"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">地区选择</label>
                    <div class="layui-input-inline">
                        <select name="province" id="province" lay-filter="address">
                            <option value="">请选择省</option>
                            @foreach($province as $v)
                                <option value="{{$v->id}}" selected="">{{$v->name}}</option>
                                    @if($v->id == $ordergoods->province)
                                        <option value="{{$v->id}}" selected="selected">{{$v->name}}</option>
                                    @endif
                                @endforeach
                        </select>
                    </div>
                    <div class="layui-input-inline">
                        <select name="city" id="city" lay-filter="address">
                            <option value="">请选择市</option>
                            @foreach($city as $v)
                                <option value="{{$v->id}}" selected="">{{$v->name}}</option>
                                @if($v->id == $ordergoods->city)
                                    <option value="{{$v->id}}" selected="selected">{{$v->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="layui-input-inline">
                        <select name="district" id="district" lay-filter="address">
                            <option value="">请选择县/区</option>
                            @foreach($district as $v)
                                <option value="{{$v->id}}" selected="">{{$v->name}}</option>
                                @if($v->id == $ordergoods->district)
                                    <option value="{{$v->id}}" selected="selected">{{$v->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">详细地址</label>
                    <div class="layui-input-block">
                        <input type="text" name="address" lay-verify="title" autocomplete="off"
                               placeholder="请输入详细地址" class="layui-input" value="{{$ordergoods->address}}">
                    </div>
                </div>

                <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">配送物流</label>
                    <div class="layui-input-inline">
                        <select name="modules" lay-verify="required" lay-search="">
                            <option value="1">顺丰快递</option>
                            <option value="2">圆通快递</option>
                            <option value="3">申通快递</option>
                        </select>
                    </div>
                </div>
                </div>

                <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">支付方式</label>
                    <div class="layui-input-inline">
                        <select name="modules" lay-verify="required" lay-search="">
                            <option value="1">微信支付</option>
                            <option value="2">支付宝支付</option>
                            <option value="3">货到付款</option>
                            <option value="4">银联在线</option>
                        </select>
                    </div>
                </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">发票抬头</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" lay-verify="title" autocomplete="off"
                               placeholder="发票抬头" class="layui-input" value="{{$ordergoods->invoice_title}}">
                    </div>
                </div>

                <table class="layui-table" lay-even="" lay-skin="nob">
                    <colgroup>
                        <col width="150">
                        <col width="150">
                        <col width="200">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th></th>
                        <th>商品名称</th>
                        <th>规格</th>
                        <th>价格</th>
                        <th>数量</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ordergoods->orderDetails as $value)
                        <?php $goodsData = json_decode($value->goods_info,true)?>
                        <tr>
                            <td><img src="{{$goodsData['original_img']}}" alt="" width="50"></td>
                            <td>{{$goodsData['goods_name']}}</td>
                            <td>

                                @foreach(explode('_',$value->spec_key_name) as $v)
                                    <span style="margin-right: 10px;">{{str_replace("@",":",$v)}}</span>
                                    @endforeach
                            </td>
                            <td>{{$value->goods_price}}</td>
                            <td>{{$value->goods_num}}</td>
                            <td><a href="">删除</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="layui-form-item">
                    <label class="layui-form-label">管理员备注</label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入内容" class="layui-textarea">{{$ordergoods->admin_note}}</textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <button class="layui-btn" lay-filter="add" name="btn" lay-submit>
                        保存
                    </button>
                </div>
            </form>
        </div>
        <script src="{{asset('templates/admin/lib/layui/layui.js')}}" charset="utf-8"></script>
        <script src="{{asset('templates/admin/js/x-layui.js')}}" charset="utf-8"></script>
        <script src="{{asset('templates/admin/js/jquery.min.js')}}" charset="utf-8"></script>
        <script>
            layui.use(['form','layer','layedit'], function(){
                $ = layui.jquery;
              var form = layui.form()
              ,layer = layui.layer
              ,layedit = layui.layedit;


                layedit.set({
                  uploadImage: {
                    url: "./upimg.json" //接口url
                    ,type: 'post' //默认post
                  }
                })
  
            //创建一个编辑器
            editIndex = layedit.build('L_content');
            

              //监听提交
              form.on('submit(add)', function(data){
                console.log(data);
                //发异步，把数据提交给php
                layer.alert("保存成功", {icon: 6},function () {
                    // 获得frame索引
                    var index = parent.layer.getFrameIndex(window.name);
                    //关闭当前frame
                    parent.layer.close(index);
                });
                return false;
              });


                form.on('select(address)',function(data){
                    var id = data.elem.id;
                    var value = data.value;


                    if(id == 'province'){

                        $('#city').html('');
                        $('#district').html('');
                        $('#city').append("<option value='0'>请选择市</option>");
                        $('#district').append("<option value='0'>请选择县/区</option>");
                        layui.form('select').render();

                    }

                    if (id == 'city'){

                        $('#district').html('');
                        $('#district').append("<option value='0'>请选择县/区</option>");
                        layui.form('select').render();

                    }


                    if(value == 0){

                        return false;
                    }

                        $.ajax({
                            url:'/admin/region',
                            type:'GET',
                            data:{'id':value},
                            dataType:'json',
                            success:function (data) {

                                var str = "";

                                for(var i=0; i<data.length;i++){

                                    str += '<option value="'+data[i].id+'">'+data[i].name+'</option>';

                                }

                                if(id == 'province'){

                                    $('#city').append(str);
                                    layui.form('select').render();

                                }

                                if (id == 'city'){

                                    $('#district').append(str);
                                    layui.form('select').render();

                                }
                            }
                        });



                });


            });


        </script>

    </body>

</html>