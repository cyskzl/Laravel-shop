<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>权限规则列表</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="{{ asset('templates/admin/css/x-admin.css') }}" media="all">
</head>
<body>
<div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>会员管理</cite></a>
              <a><cite>权限规则</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
       href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon"
                                                                        style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <form class="layui-form x-center" action="" style="width:70%">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="layui-form-pane" style="margin-top: 15px;">
            <div class="layui-form-item">
                {{--<div class="layui-input-inline">--}}
                    {{--<select name="cname">--}}
                        {{--<option value="">请选择角色</option>--}}
                        {{--<option value="评论相关">评论相关</option>--}}
                        {{--<option value="评论相关">评论相关</option>--}}
                        {{--<option value="会员相关">会员相关</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
                <div class="layui-input-inline">
                    <input type="text" name="name" placeholder="模块/控制器/方法" autocomplete="off" class="layui-input" lay-verify="required" required="">
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="display_name" placeholder="权限名称" autocomplete="off" class="layui-input" lay-verify="required">
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="description" placeholder="描述" autocomplete="off" class="layui-input">
                </div>


                {{--<input type="text" id="name" name="display_name1" required="" lay-verify="required" autocomplete="off" class="layui-input">--}}


                <div class="layui-input-inline" style="width:80px">
                    <button class="layui-btn" lay-submit="" lay-filter="*"><i class="layui-icon">&#xe608;</i>添加</button>
                </div>
            </div>
        </div>
    </form>
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button>
        <span class="x-right" style="line-height:40px">共有数据：88 条</span></xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <input type="checkbox" name="" value="">
            </th>
            <th>
                ID
            </th>
            <th>
                权限规则
            </th>
            <th>
                权限名称
            </th>

            <th>
                操作
            </th>
        </tr>
        </thead>
        <tbody id="x-link">
        <tr>
            <td>
                <input type="checkbox" value="1" name="">
            </td>
            <td>
                1
            </td>
            <td>
                admin/user/userlist
            </td>
            <td>
                会员列表
            </td>

            <td class="td-manage">
                <a title="编辑" href="javascript:;" onclick="rule_edit('编辑','{{ url('admin/permission/1/edit') }}','4','','510')"
                   class="ml-5" style="text-decoration:none">
                    <i class="layui-icon">&#xe642;</i>
                </a>
                <a title="删除" href="javascript:;" onclick="rule_del(this,'1')"
                   style="text-decoration:none">
                    <i class="layui-icon">&#xe640;</i>
                </a>
            </td>
        </tr>
        </tbody>
    </table>

    <div id="page"></div>
</div>
<script src="{{ asset('templates/admin/lib/layui/layui.js') }}" charset="utf-8"></script>
<script src="{{ asset('templates/admin/js/x-layui.js') }}" charset="utf-8"></script>
<script>
    layui.use(['element', 'laypage', 'layer', 'form'], function () {
        $ = layui.jquery;//jquery
        lement = layui.element();//面包导航
        laypage = layui.laypage;//分页
        layer = layui.layer;//弹出层
        form = layui.form();//弹出层

        //监听提交
        form.on('submit(*)', function (data) {


            //异步提交数据
            $.ajax({
                url:'/admin/permission',
                type:'POST',
                datatype:'json',
                data:{'json':JSON.stringify(data.field),'_token':data.field._token},
                success:function (res){
//                    console.log(res.parseJSON());
                    if (res) {
                        res = JSON.parse(res);

                        if (res.success == '1') {

                            layer.alert("添加成功", {icon: 1});

                            var str = '<tr><td>';
                                str += '<input type="checkbox"value='+ res.id +'name=""></td>';
                                str += '<td>'+ res.id +'</td>';
                                str += '<td>' + res.name + '</td>';
                                str += '<td>' + data.field.display_name + '</td>';
                                str += '<td class="td-manage">';
                                str += 	'<a title="编辑"href="javascript:;"onclick="rule_edit(\'编辑\',\'/admin/permission/'+ res.id +'/edit\',\'4\',\'\',\'510\')"class="ml-5"style="text-decoration:none">';
                                str += '<i class="layui-icon">&#xe642;</i></a> ';

                                str += '<a title="删除"href="javascript:;"onclick="rule_del(this,\'1\')"style="text-decoration:none">';
                                str += '<i class="layui-icon">&#xe640;</i></a></td></tr>';
                            //写入表格
                            $('#x-link').prepend(str);

                        }

                    } else{

                        layer.alert("添加失败", {icon: 6});
                    }
                }
            });
            //发异步，把数据提交给php




            return false;
        });
    });

    //以上模块根据需要引入

    //批量删除提交
    function delAll() {
        layer.confirm('确认要删除吗？', function (index) {
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
        });
    }


    //-编辑
    function rule_edit(title, url, id, w, h) {
        x_admin_show(title, url, w, h);
    }

    /*删除*/
    function rule_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            //发异步删除数据
            $(obj).parents("tr").remove();
            layer.msg('已删除!', {icon: 1, time: 1000});
        });
    }
</script>

</body>
</html>
