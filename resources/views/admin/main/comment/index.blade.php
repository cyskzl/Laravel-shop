<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        X-admin v1.0
    </title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="{{ asset('templates/admin/css/x-admin.css') }}" media="all">
    <link rel="stylesheet" href="{{asset('templates/admin/lib/bootstrap/css/bootstrap.css')}}">
    <script src="{{asset('templates/admin/js/jquery.min.js')}}" charset="utf-8"></script>
</head>
<body>
<div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>商品评论列表</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button>
        <span class="x-left" style="line-height:40px;margin-left: 15px;">共有数据：{{$sum}} 条</span>
        <div class="x-right">
            <form action="./comment" method="get" class="form-inline">
                <input type="text" name="content" placeholder="评论内容.."class="form-control">
                <input type="text" name="username" placeholder="搜索用户" class="form-control">
                <button class="btn btn-primary" type="submit">搜索</button>
            </form>
        </div>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <input type="checkbox" name="checkboxall" value="">
            </th>
            <th>
                序号
            </th>
            <th>
                用户
            </th>
            <th>
                评论内容
            </th>
            <th>
                商品名称
            </th>
            <th>
                显示
            </th>
            <th>
                评论时间
            </th>
            <th>
                ip地址
            </th>
            <th>
                操作
            </th>

        </tr>
        </thead>

        @foreach($data as $v)
        <tbody id="x-link" data-id="{{$v->id}}">
        <tr>
            <td>
                <input type="checkbox" value="{{$v->id}}" name="row">
            </td>
            <td>
                {{$v->id}}
            </td>
            <td>
                {{$v->email}}
            </td>
            <td >
                {{$v->comment_info}}
            </td>
            <td >
                {{$v->goods_title}}
            </td>
            <td >
                @if($v->is_show == 1)
                    <button class="layui-btn layui-btn-mini layui-btn-normal" name="is_show" value="1">是</button>
                    @else
                    <button class="layui-btn layui-btn-mini layui-btn-primary" name="is_show" value="0">否</button>
                @endif
            </td>
            <td >
                {{$v->created_at}}
            </td>
            <td >
                {{$v->ip_address}}
            </td>
            <td >
                <a class="btn btn-primary btn-xs" href="javascript:;" onclick="question_edit('评论回复','{{ url('admin/comment/').'/'.$v->id}}','1','','800')">
                    查看
                </a>
                <a class="btn btn-danger btn-xs" role="button" href="javascript:;" onclick="commemt_del(this,'{{$v->id}}')" id="comment_del" >删除</a>
            </td>
        </tr>
        </tbody>

            @endforeach
    </table>

    <div id="page"></div>
</div>
<script src="{{ asset('templates/admin/lib/layui/layui.js') }}" charset="utf-8"></script>
<script src="{{ asset('templates/admin/js/x-layui.js') }}" charset="utf-8"></script>
<script>
    layui.use(['element','laypage','layer','form'], function(){
        $ = layui.jquery;//jquery
        lement = layui.element();//面包导航
        laypage = layui.laypage;//分页
        layer = layui.layer;//弹出层
        form = layui.form();//弹出层


    })



    //以上模块根据需要引入

    //批量删除提交
    function delAll () {
        layer.confirm('确认要删除吗？',function(index){

            var row = $('input[name=row]');

            var id = '';

            for(var i=0;i<row.length;i++){

                if(row[i].checked){
                    id += ',' + row[i].value;
                }
            }

            $.ajax({
                type:'DELETE',
                url:'./comment/destroy',
                data: { '_token':'{{csrf_token()}}', '_method': 'DELETE', 'id': id },
                success:function (data) {
                    if(data == 0){
                        layer.msg('删除成功', {icon: 1,time:1000});
                    }else{
                        layer.msg('删除失败', {icon: 2,time:1000});
                    }
                }
            });

            window.location.reload();
//            layer.msg('删除成功', {icon: 1});
        });
    }


    /*删除*/
    function commemt_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据

           $.ajax({
               type:'DELETE',
               url:'./comment/destroy',
               data:{'_token':'{{csrf_token()}}','id':id,'_method':'DELETE'},
               success:function (data) {
                   if(data == 0){
                       layer.msg('删除成功', {icon: 1,time:1000});
                   }else{
                       layer.msg('删除失败', {icon: 2,time:1000});
                   }
               }
           });
//            $(obj).parents("tr").remove();
//            layer.msg('已删除!',{icon:1,time:1000});
            window.location.reload();
        });
    }

    //编辑
    function question_edit (title,url,id,w,h) {
        x_admin_show(title,url,w,h);
    }

    //修改显示状态
    $('button[name=is_show]').on('click',function () {

        var than = $(this);

        var val = $(this).val();

        var mid = $(this).parent().parent().parent().attr('data-id');

        $.ajax({
            type:'GET',
            url:'./comment/' + mid + '/edit',
            success:function (data){

                var obj = JSON.parse(data);

                if(obj.error == 0){

                    if(val == 0){
                        than.removeClass('layui-btn-primary').addClass('layui-btn-normal').text('是').val('1');
                    }else{
                        than.removeClass('layui-btn-normal').addClass('layui-btn-primary').text('否').val('0');
                    }
                }
            }
        });
    });



//    批量删除
    $('input[name=checkboxall]').on('click',function () {
        
        $('input[type=checkbox]').each( function () {

            var c = $(this).prop('checked');

            $(this).prop('checked',!c);
        });
        var ck = $(this).prop('checked');

        $(this).prop('checked',!ck);
    });
</script>

</body>
</html>