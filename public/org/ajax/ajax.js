/**
*
* @fieldname 表字段
* @tablename 表名
* @id 表id
* @url 请求url  
* @that 对象本省
	<link rel="stylesheet" type="text/css" href="{{asset('org/ajax/ajax.css')}}">
    <script src="{{asset('org/ajax/ajax.js')}}" type="text/javascript"></script>
	onclick="changeTableVal('is_recommend' , 'goods', '{{$good->goods_id}}' ,'{{url('/admin/ajax')}}',this)"
	<div style="text-align: center; width: 50px;">
	 <span class="@if($good->is_recommend == '0') no @else yes @endif" id="is_recommend"  onclick="changeTableVal('is_recommend' , 'goods', '{{$good->goods_id}}' ,'{{url('/admin/ajax')}}',this)">
	 @if($good->is_recommend == '0')<i class=" Wrong">✘</i>否 @else  <i class="fanyes">✔</i>是 @endif
	 </span>
	</div>
	
	//排序
	
   <form class="layui-form" action="">
     <input onkeyup="this.value=this.value.replace(/[^\d]/g,'')" type="text"  name="sort" onchange="changeTableVal('sort','goods','{{$good->goods_id}}','{{url('/admin/ajax')}}',this)" value="{{$good->sort}}"  size="1">
    </form>

*/
function changeTableVal(fieldname , tablename, id, url, that){
	//点击是否
	if($(that).attr('onclick')){
		var data = {"id":id,  "tablename":tablename, 'fieldname':fieldname, 'val': ''}
	}
	//排序
	if($(that).attr('onchange')){
			var data = { 'id': id,  'tablename': tablename, 'fieldname': fieldname, 'val':$(that).val() };
	
	}
		 // console.log(data);
	$.ajax({
		type: 'get',
		url:  url,
		dataType: 'json',
		data: data,
		success:function (data){
			if($(that).attr('onclick')){
				if(data.status == 1){
					if(data.val == 1){
						var str = '';
						str +=  '<i class="fanyes">✔</i>是';
						$(that).removeClass('no').addClass('yes').empty().append(str);
					} else {
						//否
						var str = '';
						str =  '<i class="Wrong">✘</i>否';
						$(that).removeClass('yes').addClass('no').empty().append(str);
					}
					layer.msg('更新成功' ,{icon:1,time:1000});
				} else {
					//失败
					layer.msg('更新失败', {icon: 5,time:1000});
				}	
			}
			//排序
			if($(that).attr('onchange')){
				if(data.status == 1){
                    location.href = location.href;
					layer.msg('更新成功' ,{icon:1,time:1000});

				} else {
					layer.msg('更新失败', {icon: 5,time:1000});
				}
			}
			


		}
	});
}
