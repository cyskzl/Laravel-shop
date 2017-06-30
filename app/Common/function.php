<?php

	function test(){
		echo "测试";
	}
	function getCateNameByCateId($id)
	{	
		if($id == 0 ){
			return '顶级分类';
		}
		 $cate = \App\Models\Category::find($id);
		 if(empty($cate)){
			 return '无';
		 }else{
			 return $cate->name;
		 }
	}

    //提示规格类型
    function getSpecType($id){
		
	    $spec = \App\Models\GoodsType::find($id);
		// var_dump($spec);die;
        if(empty($spec)){
            return '无';
        }else{
            return $spec->name;
        }
    }
	
	  //提示规格类型
    function getSpecItem($id){
		
	    $spec = \App\Models\SpecItem::where('spec_id', '=', $id)->get();
		// var_dump($spec);die;
        if(empty($spec)){
            return '无';
        }else{
	
            return $spec;
        }
    }


function getSpecInput($goods_id, $spec_arr)
{
    // <input name="item[2_4_7][price]" value="100" /><input name="item[2_4_7][name]" value="蓝色_S_长袖" />
    /*$spec_arr = array(
        20 => array('7','8','9'),
        10=>array('1','2'),
        1 => array('3','4'),

    );  */
    // 排序
    foreach ($spec_arr as $k => $v)
    {
        $spec_arr_sort[$k] = count($v);
    }
    asort($spec_arr_sort);
    foreach ($spec_arr_sort as $key =>$val)
    {
        $spec_arr2[$key] = $spec_arr[$key];
    }


    $clo_name = array_keys($spec_arr2);
    $spec_arr2 = combineDika($spec_arr2); //  获取 规格的 笛卡尔积

    $spec = M('Spec')->getField('id,name'); // 规格表
    $specItem = M('SpecItem')->getField('id,item,spec_id');//规格项
    $keySpecGoodsPrice = M('SpecGoodsPrice')->where('goods_id = '.$goods_id)->getField('key,key_name,price,store_count,bar_code,sku');//规格项

    $str = "<table class='table table-bordered' id='spec_input_tab'>";
    $str .="<tr>";
    // 显示第一行的数据
    foreach ($clo_name as $k => $v)
    {
        $str .=" <td><b>{$spec[$v]}</b></td>";
    }
    $str .="<td><b>价格</b></td>
               <td><b>库存</b></td>
               <td><b>SKU</b></td>
             </tr>";
    // 显示第二行开始
    foreach ($spec_arr2 as $k => $v)
    {
        $str .="<tr>";
        $item_key_name = array();
        foreach($v as $k2 => $v2)
        {
            $str .="<td>{$specItem[$v2][item]}</td>";
            $item_key_name[$v2] = $spec[$specItem[$v2]['spec_id']].':'.$specItem[$v2]['item'];
        }
        ksort($item_key_name);
        $item_key = implode('_', array_keys($item_key_name));
        $item_name = implode(' ', $item_key_name);

        $keySpecGoodsPrice[$item_key][price] ? false : $keySpecGoodsPrice[$item_key][price] = 0; // 价格默认为0
        $keySpecGoodsPrice[$item_key][store_count] ? false : $keySpecGoodsPrice[$item_key][store_count] = 0; //库存默认为0
        $str .="<td><input name='item[$item_key][price]' value='{$keySpecGoodsPrice[$item_key][price]}' onkeyup='this.value=this.value.replace(/[^\d.]/g,\"\")' onpaste='this.value=this.value.replace(/[^\d.]/g,\"\")' /></td>";
        $str .="<td><input name='item[$item_key][store_count]' value='{$keySpecGoodsPrice[$item_key][store_count]}' onkeyup='this.value=this.value.replace(/[^\d.]/g,\"\")' onpaste='this.value=this.value.replace(/[^\d.]/g,\"\")'/></td>";
        $str .="<td><input name='item[$item_key][sku]' value='{$keySpecGoodsPrice[$item_key][sku]}' />
                <input type='hidden' name='item[$item_key][key_name]' value='$item_name' /></td>";
        $str .="</tr>";
    }
    $str .= "</table>";
    return $str;
}
