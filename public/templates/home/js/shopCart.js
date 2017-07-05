/**
 * Created by Administrator on 2017/6/29.
 */

$(function(){
    //全选
    $("#checkAll").click(function() {
        $('input[name="subBox"]').attr("checked",this.checked);
    });
    var $subBox = $("input[name='subBox']");

    //单选
    $subBox.click(function(){
        $("#checkAll").attr("checked",$subBox.length == $("input[name='subBox']:checked").length ? true : false);

    });

    //删除
    $('.delGoods').click(function(){
        $(this).parent().parent().remove();
    });


    $('.modify').click(function(){
        $(this).children('.modify_box').css({"display":"block"});
    });

    $('.modifySave').click(function(){
        event.stopPropagation();
        $(this).parent().parent().css({"display":"none"});
    });

    $('.modifyCancel').click(function(){
        event.stopPropagation();
        $(this).parent().parent().css({"display":"none"});
    });



    //var lis = $('.color_list').children();
    //for(var i = 0; i < lis.length; i++){
    //    console.log(lis[i]);
    //    lis[i].click(function(){
    //       $(this).children().css({"background":"#626161","color":"#fff"});
    //    });
    //}
    /*
     *======================================================
     * edit by Garlic
     * 2017-05
     */
     layui.use(['layer', 'form'], function(){
       var layer = layui.layer,form = layui.form();

     });
    var token = $('input[name=_token]').val();
    //结算
    $('.settlement').on('click', function(){
        var check = $('input[name="subBox"]:checked');

        if ( check.length == 0) {
            layer.alert('请选择需要购买的产品！', {icon: 7});
            return false;
        }
        var checkArr = new Array();
        for (var i = 0; i < check.length; i++) {
            checkArr[i] = $(check[i]).val();
        }

        var url = 'shoppingcart/1';

        shopAjax(url, 'delete', JSON.stringify(checkArr));

    });


    function shopAjax(url, type, data)
    {
        $.ajax({
            url: url,
            type: type,
            datatype: 'json',
            data: {
                'json':data,
                '_token':token,
            },
            success: function(res) {
                console.log(res);
            }
        });
    }
});
