/**
 * Created by Administrator on 2017/6/29.
 */

$(function () {
    //全选
    $("#checkAll").click(function () {
        $('input[name="subBox"]').attr("checked", this.checked);
    });
    var $subBox = $("input[name='subBox']");

    //单选
    $subBox.click(function () {
        $("#checkAll").attr("checked", $subBox.length == $("input[name='subBox']:checked").length ? true : false);

    });

    //删除
    $('.delGoods').click(function () {
        $(this).parent().parent().remove();
    });


    $('.modify').click(function () {
        $(this).children('.modify_box').css({
            "display": "block"
        });
    });

    $('.modifySave').click(function () {
        event.stopPropagation();
        $(this).parent().parent().css({
            "display": "none"
        });
    });

    $('.modifyCancel').click(function () {
        event.stopPropagation();
        $(this).parent().parent().css({
            "display": "none"
        });
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
    layui.use(['layer', 'form'], function () {
        var layer = layui.layer,
            form = layui.form();

    });
    var token = $('input[name=_token]').val();
    //结算
    // $('.settlement').on('click', function () {
    //
    //     var check = $('input[name="subBox"]:checked');
    //     var goods_name   = $('.cart_img').next();
    //     var spectwo = $('.spectwo');
    //     var specone = $('.specone');
    //     var price   = $('.uniPrice');
    //     var img   = $('.cart_img');
    //     var num   = $('.num');
    //     var total   = $('.allMoney');
    //
    //
    //     // console.log(spectwo);
    //     if (check.length == 0) {
    //         layer.alert('请选择需要购买的产品！', {icon: 7});
    //         return false;
    //     }
    //
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //
    //
    //     var checkArr = new Array();
    //
    //     for (var i = 0; i < check.length; i++) {
    //
    //         checkArr[i] = new Array();
    //         checkArr[i]['goods_id'] = $(check[i]).val();
    //         checkArr[i]['img'] = $(img[i]).attr('src');
    //         checkArr[i]['goods_name'] = $(goods_name[i]).text();
    //         checkArr[i]['spectwo'] = $(spectwo[i]).text();
    //         checkArr[i]['specone'] = $(specone[i]).text();
    //         checkArr[i]['price'] = $(price[i]).text().substr(1);
    //         checkArr[i]['num'] = $(num[i]).val();
    //
    //
    //     }
    //     console.log(checkArr);
    //
    //     var postStr = {}
    //
    //     $(checkArr).each(function (i) {
    //         postStr['goods_id'] = this.goods_id;
    //         postStr['img'] = this.img;
    //
    //     })
    //
    //     // postStr['_token'] = token;
    //
    //     // var postStr = {
    //     //     'json': JSON.stringify(checkArr),
    //     //     '_token': token,
    //     // }
    //
    //     console.log(postStr);
    //
    //     $.ajax({
    //         url: 'shopOrders',
    //         type: 'post',
    //         datatype: 'json',
    //         data: postStr,
    //         traditional: true,
    //         success: function (res) {
    //             console.log(res);
    //         }
    //     });
    //
    //
    // });


    //
    // function shopAjax(url, type, data) {
    //     $.ajax({
    //         url: url,
    //         type: type,
    //         datatype: 'json',
    //         data: {
    //             'json': data,
    //             '_token': token,
    //         },
    //         traditional: true,
    //         success: function (res) {
    //             console.log(res);
    //         }
    //     });
    // }
});

//