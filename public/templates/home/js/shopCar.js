/**
 * Created by Garlic on 2017-07-04.
 */


$('.plus').click(function () {
    //获取已有的数量
    var oldNUm = $(this).parent().find('input[class*=num]');
    //进行加 1
    oldNUm.val( parseFloat( oldNUm.val() ) + 1);

    if( isNaN( oldNUm.val() ) ){
		oldNUm.val(1);
	}

    //获取增加后的数量
    var newNum = $(this).parent().find('input[class*=num]');
    //获取单价

    var price = $(this).parent().prev().find('.uniPrice').text().substr(1);
    //数量与单价相乘
    var sum = newNum.val() * price;
    //更新小计
    $(this).parent().next().find('#subtotal').text(sum.toFixed(2));
    //获取商品id
    var goods_id = $(this).parent().parent().find($('input[name="subBox"]')).val();

    shopAjax('shoppingcart/'+ goods_id, 'put', newNum.val());

    total ();
});

$('.reduce').click(function () {
    //获取已有的数量
    var oldNUm = $(this).parent().find('input[class*=num]');
    //进行减 1
    oldNUm.val( parseFloat( oldNUm.val() ) - 1 );

    if ( oldNUm.val() < 1 ) {
        oldNUm.val(1);
    }

    if( isNaN( oldNUm.val() ) ){
		oldNUm.val(1);
	}

    //获取减去后的数量
    var newNum = $(this).parent().find('input[class*=num]');
    //获取单价
    var price = $(this).parent().prev().find('.uniPrice').text().substr(1);
    //数量与单价相乘
    console.log(price);
    var sum = newNum.val() * price;
    //更新小计
    $(this).parent().next().find('#subtotal').text(sum.toFixed(2));

    //获取商品id
    var goods_id = $(this).parent().parent().find($('input[name="subBox"]')).val();
    shopAjax('shoppingcart/'+ goods_id, 'put', newNum.val());
    
    //更新总金额
    total ();
});

//进行总金额统计
function total () {

    var subtotal = $('td #subtotal');
    var sum = 0;
    for (var i=0; i < subtotal.length; i++) {

        sum += parseFloat(subtotal[i].innerHTML);

    }

    if ( isNaN(sum) ) {
        sum = '00';
    }
    $('#allMoney').text(sum.toFixed(2));
}

var token = $("input[name='_token']").val();

function shopAjax(url, type, data) {

    $.ajax({
        url: url,
        type: type,
        datatype: 'json',
        data: {
            'data': data,
            '_token': token,
        },
        traditional: true,
        success: function (res) {

        }
    });
}