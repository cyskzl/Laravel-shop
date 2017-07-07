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
    function getSpecType($id)
	{
		
	    $spec = \App\Models\GoodsType::find($id);
		// var_dump($spec);die;
        if(empty($spec)){
            return '无';
        }else{
            return $spec->name;
        }
    }
	
	  //提示规格类型
    function getSpecItem($id)
	{
		
	    $spec = \App\Models\SpecItem::where('spec_id', '=', $id)->get();
		// var_dump($spec);die;
        if(empty($spec)){
            return '无';
        }else{
	
            return $spec;
        }
    }

	//返回品牌名称
	function getBrand($id)
	{
		// echo '123';die;
		$brand = \App\Models\Brand::find($id);
		
		if(!empty($brand)){
			return $brand->name;
		}
	}