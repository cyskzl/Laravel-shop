/**
 * Created by Administrator on 2017/6/29.
 */

$(function(){
    //ȫѡ
    $("#checkAll").click(function() {
        $('input[name="subBox"]').attr("checked",this.checked);
    });
    var $subBox = $("input[name='subBox']");
    $subBox.click(function(){
        $("#checkAll").attr("checked",$subBox.length == $("input[name='subBox']:checked").length ? true : false);
    });

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
});
