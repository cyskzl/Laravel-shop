@extends('admin.layouts.layout')
@section('style')
     <script src="{{asset('templates/admin/js/jquery.min.js')}}" type="text/javascript"></script>
@endsection
@section('x-body')

    <form class="layui-form"  action=''>

        <input type="hidden" name="id" value="{{$payMethod->id}}">
        <div class="layui-inline">
            <label class="layui-form-label">名称</label>
            <div class="layui-input-block">
                <input type="text" name="name"  lay-verify="required" placeholder="支付名称" autocomplete="off" class="layui-input" value="{{$payMethod->pay_name}}">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">显示</label>
            <div class="layui-input-block">
                <input type="checkbox" name="enabled" lay-skin="switch" lay-text="开启|关闭" value="0" {{($payMethod->enabled == 0) ?'checked':""}}>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">描述</label>
            <div class="layui-input-block">
                    <textarea name="desc" placeholder="请输入描述" class="layui-textarea" style="
resize: none;">{{$payMethod->pay_desc}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn"  lay-filter="save" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
        {{csrf_field()}}
    </form>


@endsection
@section('js')
    <script>
        layui.use(['form', 'layer', 'upload'], function () {
            $ = layui.jquery;
            var form = layui.form()
                , layer = layui.layer
                , layedit = layui.layedit;
            form.on('submit(save)', function(data){

                console.log(data);
                $.ajax({
                    type: 'PUT',
                    url:  "/admin/paymethod/"+data.field.id,
                    dataType: 'json',
                    data: { '_token':'{{csrf_token()}}', '_method':'PUT' ,  'json': JSON.stringify(data.field) },
                    success:function (data){
                        //失败
                        console.log(data);
                        if(data.status == 1){
                            layer.msg(data.msg, {icon: 5,time:1000});
                        } else if(data.status == 3){
                            layer.msg(data.msg, {icon: 5,time:1000});
                        } else if(data.status == 4 ){
                            layer.msg(data.msg, {icon: 5,time:1000});
                        }
                        //成功
                        layer.alert(data.msg, {icon: 6},function () {
                            //获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前frame
                            parent.layer.close(index);
                        });

                    }
                });

                return false;
            });

        });
    </script>
@endsection