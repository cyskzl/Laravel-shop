@extends('admin.layouts.layout')

@section('title','系统设置')

@section('x-nav')
    <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>基本设置</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
       href="javascript:location.replace(location.href);" title="刷新">
       <i class="layui-icon" style="line-height:30px">ဂ</i></a>
@endsection

@section('x-body')
    <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
        <ul class="layui-tab-title">
            <li class="layui-this">网站设置</li>
            <li>安全设置</li>
            <li>邮件设置</li>
            <li>关闭网站</li>
            <li>其它设置</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <form class="layui-form layui-form-pane" action="{{url('admin/setchange')}}" method="post">
                    {{csrf_field()}}
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">
                            <span class='x-red'>*</span>网站名称
                        </label>
                        <div class="layui-input-block">
                            <input type="text" name="shop_title" autocomplete="off" placeholder="控制在25个字、50个字节以内" class="layui-input" value="{{$configs['shop_title']}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">
                            <span class='x-red'>*</span>关键词
                        </label>
                        <div class="layui-input-block">
                            <input type="text" name="shop_keyword" autocomplete="off" placeholder="5个左右,8汉字以内,用英文,隔开" class="layui-input" value="{{$configs['shop_keyword']}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">
                            <span class='x-red'>*</span>描述
                        </label>
                        <div class="layui-input-block">
                            <input type="text" name="shop_desc" autocomplete="off" placeholder="空制在80个汉字，160个字符以内" class="layui-input" value="{{$configs['shop_desc']}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">
                            <span class='x-red'>*</span>css、js、images路径配置
                        </label>
                        <div class="layui-input-block">
                            <input type="text" name="shop_mark" autocomplete="off" placeholder="默认为空，为相对路径" class="layui-input" value="{{$configs['shop_mark']}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">
                            <span class='x-red'>*</span>上传目录配置
                        </label>
                        <div class="layui-input-block">
                            <input type="text" name="shop_uploads" autocomplete="off" placeholder="默认为uploadfile" class="layui-input" value="{{$configs['shop_uploads']}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">
                            <span class='x-red'>*</span>底部版权信息
                        </label>
                        <div class="layui-input-block">
                            <input type="text" name="shop_copyright" autocomplete="off" placeholder="&copy; 2016 X-admin" class="layui-input" value="{{$configs['shop_copyright']}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">
                            <span class='x-red'>*</span>备案号
                        </label>
                        <div class="layui-input-block">
                            <input type="text" name="shop_number" autocomplete="off" placeholder="京ICP备00000000号" class="layui-input" value="{{$configs['shop_number']}}">
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">
                            <span class='x-red'>*</span>统计代码
                        </label>
                        <div class="layui-input-block">
                            <textarea placeholder="请输入内容" name='stats_code' class="layui-textarea">{{$configs['stats_code']}}</textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <button class="layui-btn">
                            保存
                        </button>
                    </div>
                </form>
                <div style="height:100px;"></div>
            </div>
            <div class="layui-tab-item">
                <form class="layui-form layui-form-pane" action="{{url('admin/setchange')}}" method="post">
                    {{csrf_field()}}
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">
                            <span class='x-red'>*</span>允许访问后台的IP列表
                        </label>
                        <div class="layui-input-block">
                            <textarea placeholder="请输入内容" name='access_ip' class="layui-textarea">{{$configs['access_ip']}}</textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class='x-red'>*</span>最大次数
                        </label>
                        <div class="layui-input-inline">
                            <input type="number" name="max_num" class="layui-input" value="{{$configs['max_num']}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <button class="layui-btn">
                            保存
                        </button>
                    </div>
                </form>
            </div>
            <div class="layui-tab-item">
                <form class="layui-form layui-form-pane" action="{{url('admin/setchange')}}" method="post">
                    {{csrf_field()}}
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">
                            <span class='x-red'>*</span>邮件发送模式
                        </label>
                        <div class="layui-input-block">
                            <input type="text" name="send_mode" autocomplete="off" placeholder="" class="layui-input" value="{{$configs['send_mode']}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">
                            <span class='x-red'>*</span>SMTP服务器
                        </label>
                        <div class="layui-input-block">
                            <input type="text" name="smtp_server" autocomplete="off" placeholder="smtp.qq.com" class="layui-input" value="{{$configs['smtp_server']}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">
                            <span class='x-red'>*</span>SMTP 端口
                        </label>
                        <div class="layui-input-block">
                            <input type="text" name="smtp_port" autocomplete="off" placeholder="25" class="layui-input" value="{{$configs['smtp_port']}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">
                            <span class='x-red'>*</span>邮箱帐号
                        </label>
                        <div class="layui-input-block">
                            <input type="text" name="smtp_user" autocomplete="off" placeholder="邮件服务商申请的帐号" class="layui-input" value="{{$configs['smtp_user']}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">
                            <span class='x-red'>*</span>邮箱密码
                        </label>
                        <div class="layui-input-block">
                            <input type="text" name="smtp_pwd" autocomplete="off" placeholder="邮件服务商申请的密码" class="layui-input" value="{{$configs['smtp_pwd']}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">
                            <span class='x-red'>*</span>收件邮箱地址
                        </label>
                        <div class="layui-input-block">
                            <input type="text" name="test_eamil" autocomplete="off" placeholder="" class="layui-input" value="{{$configs['test_eamil']}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <button class="layui-btn" >
                            保存
                        </button>
                    </div>
                </form>
            </div>
            <div class="layui-tab-item">
                <form class="layui-form">
                    {{csrf_field()}}
                    <div class="layui-form-item">
                        <label for="AppId" class="layui-form-label">
                            <span class="x-red">*</span>是否开启
                        </label>
                        <div class="layui-input-block">
                            <input  type="checkbox" {{$configs['open']==0?'checked':''}} name="open" value="{{$configs['open']}}"  lay-skin="switch"  lay-filter="open">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label">
                        </label>
                        <button class="layui-btn" lay-submit lay-filter="open">
                            保存
                        </button>
                    </div>
                </form>
            </div>
            <div class="layui-tab-item">
                <form class="layui-form layui-form-pane" action="{{url('admin/setchange')}}" method="post">
                    {{csrf_field()}}
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">
                            <span class='x-red'>*</span>其它功能
                        </label>
                        <div class="layui-input-inline">
                            <input type="text" name="title" autocomplete="off" placeholder="请输入内容"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">
                            <span class='x-red'>*</span>其它功能
                        </label>
                        <div class="layui-input-inline">
                            <input type="text" name="title" autocomplete="off" placeholder="请输入内容"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <button class="layui-btn">
                            保存
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        layui.use(['element', 'layer','form'], function () {
            $ = layui.jquery;//jquery
            lement = layui.element();//面包导航
            layer = layui.layer;//弹出层
            form = layui.form()

            var open;
            form.on('switch(open)', function(data){
                // 当值为开启时，当未选中的时候才是open为1,否则为0;
                if(data.value==0){
                    if(data.elem.checked == false){
                        open = 1;
                    }else {
                        open = 0;
                    }
                }else{
                    if(data.elem.checked == true){
                        open = 0;
                    }else {
                        open = 1;
                    }
                }
//                console.log(data.elem); //得到checkbox原始DOM对象
//                console.log(data.elem.checked); //开关是否开启，true或者false
//                console.log(data.value); //开关value值，也可以通过data.elem.value得到
            });

            form.on('submit(open)', function (data) {
                console.log(data);
                //发异步，把数据提交给php
                $.ajax({
                    type: "POST",
                    url: '{{url('admin/setchange')}}',
                    dataType: 'json',
                    cache: false,
                    data: {'open': open,'_token': "{{csrf_token()}}"},
                    success: function (data){
                        if(data){
                            layer.alert("保存成功", {icon: 6,time:1000});
                        }else {
                            layer.alert("保存失败", {icon: 5,time:1000});
                        }
                    }
                });
            });
            //监听提交
//            form.on('submit(*)', function (data) {
//                console.log(data);
//                //发异步，把数据提交给php
//                layer.alert("保存成功", {icon: 6});
//                return false;
//            });

        });
    </script>
@endsection
