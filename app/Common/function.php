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