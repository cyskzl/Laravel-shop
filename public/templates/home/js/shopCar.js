/**
 * Created by Garlic on 2017-07-04.
 */
 $(function () {

     $(total());
 });


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
    var price = $(this).parent().prev().find('.uniPrice').text();
    //数量与单价相乘
    var sum = newNum.val() * price;
    //更新小计
    $(this).parent().next().find('#subtotal').text(sum);
    total ()
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
    var price = $(this).parent().prev().find('.uniPrice').text();
    //数量与单价相乘
    var sum = newNum.val() * price;
    //更新小计
    $(this).parent().next().find('#subtotal').text(sum);
    //更新总金额
    total ()
});

//进行总金额统计
function total () {

    var subtotal = $('td #subtotal');
    var sum = 0;

    for (var i=0; i < subtotal.length; i++) {

        sum += parseFloat(subtotal[i].innerHTML);

    }

    $('#allMoney').text(sum + '.00');
}
