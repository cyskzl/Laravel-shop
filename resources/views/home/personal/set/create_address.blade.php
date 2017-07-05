@extends('home.layouts.layout_two')

@section('title','添加收货地址')

@section('style')
    <link rel="stylesheet" href="{{asset('/templates/home/css/addres.css')}}"/>
    <link rel="stylesheet" href="{{asset('/templates/admin/lib/layui/css/layui.css')}}"/>
@endsection

@section('main')
    <!-- 内容 -->
        <div class="page_block">
            <div class="page_title">收货地址</div>
            <div class="edit_address_from">
                <form class="layui-form layui-form-pane" action="{{url('home/address')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form_title">添加收货地址</div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">收货人姓名</label>
                        <div class="layui-input-block">
                            <input type="text" name="consignee" required  lay-verify="required" placeholder="请输入收货人姓名" autocomplete="off" class="layui-input" value="{{old('consignee')}}">
                            <span style="color: #FF4BC4;">
                                {{$errors->first('consignee')}}
                            </span>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">手机号码</label>
                        <div class="layui-input-block">
                            <input type="text" name="mobile" required  lay-verify="required" placeholder="请输入手机号码" autocomplete="off" class="layui-input" value="{{old('mobile')}}">
                            <span style="color: #FF4BC4;">
                                {{$errors->first('mobile')}}
                            </span>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">邮箱地址</label>
                        <div class="layui-input-block">
                            <input type="text" name="email" required  lay-verify="required" placeholder="请输入邮箱地址" autocomplete="off" class="layui-input" value="{{old('email')}}">
                            <span style="color: #FF4BC4;">
                                {{$errors->first('email')}}
                            </span>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">地区选择</label>
                        <div class="layui-input-inline">
                            <select name="province" id="province" lay-filter="address">
                                <option value="">请选择省</option>
                                @foreach($province as $v)
                                    <option value="{{$v->id}}" >{{$v->name}}</option>
                                @endforeach
                            </select>
                            <span style="color: #FF4BC4;">
                                {{$errors->first('province')}}
                            </span>
                        </div>
                        <div class="layui-input-inline">
                            <select name="city" id="city" lay-filter="address">
                                <option value="">请选择市</option>
                            </select>
                            <span style="color: #FF4BC4;">
                                {{$errors->first('city')}}
                            </span>
                        </div>
                        <div class="layui-input-inline">
                            <select name="district" id="district" lay-filter="address">
                                <option value="">请选择县/区</option>

                            </select>
                            <span style="color: #FF4BC4;">
                                {{$errors->first('district')}}
                            </span>
                        </div>
                        <div class="layui-input-inline">
                            <select name="twon" id="twon" lay-filter="address">
                                <option value="">请选择乡镇</option>
                            </select>
                            <span style="color: #FF4BC4;">
                                {{$errors->first('twon')}}
                            </span>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">详细地址</label>
                        <div class="layui-input-block">
                            <input type="text" name="detailed_address" lay-verify="title" autocomplete="off"
                                   placeholder="请输入详细地址" class="layui-input" value="{{old('detailed_address')}}">
                            <span style="color: #FF4BC4;">
                                {{$errors->first('detailed_address')}}
                            </span>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">邮编</label>
                        <div class="layui-input-block">
                            <input type="text" name="zipcode" autocomplete="off"
                                   placeholder="请输入邮编" class="layui-input" value="{{old('zipcode')}}">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">是否默认</label>
                        <div class="layui-input-block">
                            <input type="checkbox" name="is_default" lay-skin="switch" value="0">
                        </div>
                    </div>

                    <div class="from_row">
                        <input type="submit" value="保存" class="btn_subbmit"/>
                    </div>
                </form>
            </div>
        </div>
@endsection

@section('js')
    <script src="{{asset('/templates/admin/lib/layui/layui.js')}}"></script>
    <script src="{{asset('templates/admin/js/x-layui.js')}}" charset="utf-8"></script>
    <script src="{{asset('templates/admin/js/jquery.min.js')}}" charset="utf-8"></script>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
            var form = layui.form()
                ,layer = layui.layer;

            form.on('select(address)',function(data){
                console.log(1);
                var id = data.elem.id;
                var value = data.value;


                if(id == 'province'){

                    $('#city').html('');
                    $('#district').html('');
                    $('#twon').html('');
                    $('#city').append("<option value='0'>请选择市</option>");
                    $('#district').append("<option value='0'>请选择县/区</option>");
                    $('#twon').append("<option value='0'>请选择乡镇</option>");
                    layui.form('select').render();

                }

                if (id == 'city'){

                    $('#district').html('');
                    $('#twon').html('');
                    $('#district').append("<option value='0'>请选择县/区</option>");
                    $('#twon').append("<option value='0'>请选择乡镇</option>");
                    layui.form('select').render();

                }

                if (id == 'district'){

                    $('#twon').html('');
                    $('#twon').append("<option value='0'>请选择乡镇</option>");
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

                        if (id == 'district'){

                            $('#twon').append(str);
                            layui.form('select').render();

                        }
                    }
                });

            });
        });
    </script>
@endsection