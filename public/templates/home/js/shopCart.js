/**
 * Created by Administrator on 2017/6/29.
 */

$(function () {

    layui.use(['layer', 'form'], function () {
        var layer = layui.layer,
            form = layui.form();

    });

    //全选
    $("#checkAll").click(function () {
        $('input[name="subBox"]').attr("checked", this.checked);

        checkTotal();
    });
    var $subBox = $("input[name='subBox']");

    //单选
    $subBox.click(function () {
        $("#checkAll").attr("checked", $subBox.length == $("input[name='subBox']:checked").length ? true : false);

        checkTotal();

    });

    //删除
    $('.delGoods').click(function () {

        var goods_id = $(this).parent().parent().find($('input[name="subBox"]')).val();
        var goods    = $(this);
        layer.confirm('您确认删除该商品吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){

            var data = shopAjax('shoppingcart/' + goods_id, 'delete', goods_id)

            if (data.success == 1) {
                layer.msg(data.info, {icon: 1});
                goods.parent().parent().remove();

            } else {

                layer.msg(data.info, {icon: 7});
            }
            location.href = location.href;
        });


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


    var token = $("input[name='_token']").val();

    //结算
    $('.settlement').on('click', function () {

        var check          = $('input[name="subBox"]:checked');
        var total          = $('.allMoney');
        var goods_id_arr   = check.parent().prev();
        var goods_name_arr = check.parent().next().children('.cart_img').next();
        var img_arr        = check.parent().next().find('.cart_img');
        var spectwo_arr    = check.parent().next().find('.spectwo');
        var key1_arr       = check.parent().next().find('input[name=key1]');
        var key2_arr       = check.parent().next().find('input[name=key2]');
        var specone_arr    = check.parent().next().find('.specone');
        var price_arr      = check.parent().next().next().find('.uniPrice');
        var num_arr        = check.parent().next().next().next().find('.num');

        if (check.length == 0) {
            layer.alert('请选择需要购买的产品！', {icon: 7});
            return false;
        }

        var str = '{';

        for (var i = 0; i < check.length; i++) {

            var id         = "session_id";
            var num        = "num";
            var img        = "img";
            var key       = "key1_key2";
            // var key2       = "key2";
            var price      = "price";
            var spectwo    = "spectwo";
            var specone    = "specone";
            var goods_id   = "goods_id";
            var goods_name = "goods_name";
            //转为json
            str += "\"" + $(check[i]).val() + "\"" + ':' + '{'
                +  "\"" + id + "\"" + ':' + "\""  + $(check[i]).val() + "\","
                +  "\"" + num + "\"" + ':' + "\"" + $(num_arr[i]).val() + "\","
                +  "\"" + img + "\"" + ':' + "\"" + $(img_arr[i]).attr('src') + "\","
                +  "\"" + key + "\"" + ':' + "\"" + $(key1_arr[i]).val()+'_'+ $(key2_arr[i]).val() + "\","
                // +  "\"" + key2 + "\"" + ':' + "\"" + $(key2_arr[i]).val() + "\","
                +  "\"" + price + "\"" + ':' + "\""  + $(price_arr[i]).text() + "\","
                +  "\"" + specone + "\"" + ':' + "\"" + $(specone_arr[i]).text() + "\","
                +  "\"" + spectwo + "\"" + ':' + "\"" + $(spectwo_arr[i]).text() + "\","
                +  "\"" + goods_id  + "\"" + ':'  + "\"" + $(goods_id_arr[i]).val() + "\","
                +  "\"" + goods_name + "\"" + ':' + "\"" + $(goods_name_arr[i]).text() + "\","
                +  '},';

        }

        str = str.substring(0,str.length -1);
        str += '}';

        //去除多余的逗号
        var reg = /\,\}/g;
        str = str.replace(reg,'}');

        var res = shopAjax('cartToOrder', 'post', str);
        if (res.success == 1) {

            location.href = res.url;
        } else {

            layer.alert(res.info, {icon: 7});
            return false;
        }

    });


    //已选中商品的总金额
    function checkTotal () {

        var checktotal = $('input[name="subBox"]:checked');
        var shop_total = checktotal.parent().siblings('.totalMoney').find('#subtotal');
        var sum = 0;

        for (var i=0; i < shop_total.length; i++) {

            sum += parseFloat(shop_total[i].innerHTML);

        }

        if ( isNaN(sum) ) {
            sum = '00';
        }
        $('#allMoney').text(sum.toFixed(2));

    }



    function shopAjax(url, type, data) {
        var delData = '';
        $.ajax({
            url: url,
            type: type,
            datatype: 'json',
            data: {
                'data': data,
                '_token': token,
            },
            async: false,
            traditional: true,
            success: function (res) {
                delData = JSON.parse(res);
            }

        });

        return delData;
    }
});

//