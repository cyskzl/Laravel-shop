@extends('admin.layouts.layout')

@section('x-nav')
    <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>添加选项卡</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
@endsection
@section('x-body')
    <form class="layui-form layui-form-pane"  action='' style="width:100%">
        <div class="layui-form-item" style="width: 400px">
            <label class="layui-form-label" style="width: 100px">选项卡名称</label>
            <div class="layui-input-block">
                <input type="text" value="{{$tabcate->name}}" name="name"  lay-verify="required" placeholder="选项卡名称" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label" style="width: 100px">商品分类</label>
            <div class="layui-input-inline" style="margin-left: 10px">
                <select name="cat_id" id="cat_id" lay-filter="filter" data-key='{{$tab[0]}}'>
                    <option value="">请选择商品分类</option>
                    @foreach($topscate as $fatcate)
                        <option  @if($fatcate->id == $tab[0] ) selected @endif value="{{$fatcate->id}}">{{$fatcate->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="layui-input-inline" >
                <select name="cat_id_02" id="cat_id_02" lay-filter="cate_02" data-key='{{$tab[1]}}'>
                    <option value="">请选择商品分类</option>
                    {{--<option value="">请选择商品分类</option>--}}
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="cat_id_03" >
                    <option value="">请选择商品分类</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn"  lay-filter="add" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
        {{csrf_field()}}
    </form>

@endsection
@section('js')
    {{--上传插件引入--}}
    <script>
        layui.use(['form', 'layer', 'layedit', 'upload'], function () {
            $ = layui.jquery;
            var form = layui.form()
                    , layer = layui.layer;
            $form = $('form');
//            var $ = layui.jquery, layer = layui.layer; //独立版的layer无需执行这一句

//            $form.find('select[name=cat_id_02]').children().remove();
                var val = $('#cat_id').attr('data-key');
                var two = $('#cat_id_02').attr('data-key');
                {{--one ={{$two}}--}}
                if(val !== null){

                    $form.find('select[name=cat_id_02]').children().remove();

                    $.ajax({
                        type     : 'post',
                        url      : '/admin/ajaxTwoCate',
                        dataType : 'json',
                        data     :  { '_token': '{{csrf_token()}}', 'fatcate': val },
                        success:function (data){
                            var str = '';
                            for(var i=0; i<data.length; i++){
                                var id = data[i]['id'];
                                var name = data[i]['name'];
                                    if(id == two){
                                        str += '<option id="fuck" data-id='+id+' selected="selected"  value="'+id+'">'+name+'</option>';
//                                        str += '<input type="hidden" data-id='+id+' id="fuck">'
                                    } else {
                                        str += '<option data-id='+id+' value="'+id+'">'+name+'</option>';
                                    }

                            }
                            var char = '';
                            char += '<option value="">请选择商品分类</option><option value="">请选择商品分类</option>';
                            $form.find('select[name=cat_id_02]').prepend(char).append(str);
                            form.render();
                        }
                    });

                }
//            });
//            form.render();
            //获取三级分类信息
//            $('#testSelect option:selected')
            console.log($('#fuck'))
            var val2 = $('#fuck').attr('data-id');
//            console.log(val2);
//            console.log($('#fuck'));
//            form.on('select(cate_02)', function(data){
//            console.log(data.value);
//                var cate_02 = data.value;
//                $form.find('select[name=cat_id_03]').children().remove();
                $.ajax({
                    type     : 'post',
                    url      : '/admin/ajaxCate',
                    dataType : 'json',
                    data     :  {'_token': '{{csrf_token()}}', 'three': 12},
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
//                        if(data.status == 0){
////                                alert(1);
//                            $form.find('select[name=cat_id_03]').children().remove();
//                        }
//                            console.log(char);
                        $form.find('select[name=cat_id_03]').prepend(char).append(str);
                        form.render();
                    }
                });

//                }
//            });



            form.on('submit(add)', function(data){
                //发异步，把数据提交给php
                $.ajax({
                    type: 'post',
                    url:  '/admin/goodstabcate',
                    dataType: 'json',
                    data: { '_token':'{{csrf_token()}}',  'json': JSON.stringify(data.field) },
                    success:function (data){
//                        console.log(data);
                        //失败
                        if(data.status == 2){
                            layer.msg(data.msg, {icon: 5,time:1000});
                        } else if(data.status == 1 ){
                            //成功
                            layer.alert(data.msg, {icon: 6},function () {
                                //获得frame索引
                                var index = parent.layer.getFrameIndex(window.name);
                                //关闭当前frame
                                parent.layer.close(index);
                            });
                        }

                    }
                });

                return false;
            });

        });

    </script>
@endsection
