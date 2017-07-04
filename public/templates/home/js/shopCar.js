/**
 * Created by Administrator on 2017-07-04.
 */
 // $(function () {
 //
 //     $(total());
 // });

$('.plus').click(function () {
    //获取原有的数量
    var oldNUm = $(this).parent().find('input[class*=num]');
    //进行加 1
    oldNUm.val(parseInt(oldNUm.val()) + 1);

    if(isNaN(oldNUm.val())){
		oldNUm.val(1);
	}

    //获取增加后的数量
    var newNum = $(this).parent().find('input[class*=num]');
    //获取单价
    var price = $(this).parent().prev().find('.uniPrice').text();
    //数量与单价相乘
    var sum = newNum.val() * price;
    //更新小计
    $(this).parent().next().find('#subtotal').html(sum + '.00');
    total ()
});


function total () {

    var subtotal = $('td #subtotal');
    var sum = 0;
    console.log(subtotal);
    for (var i=0; i < subtotal.length; i++) {

        sum += parseFloat(subtotal[i].innerHTML);
        console.log(sum);
    }

    $('#allMoney').html(sum + '.00');
}



// $(function () {
//
//     $(total());
// });
//
// var reduce = $('.reduce');
// var plus = $('.plus');
// console.log(reduce);

// //数量与单价相乘
// plus.click(function () {
//
//     //获取购买的数量
//     var oldValue = $(this).prev().val();
//     // console.log(oldValue);
//     oldValue ++;
//
//     //修改加一后的购买数量
//     $(this).prev().attr('value', oldValue);
//
//     //获取单价的金额
//     var price = $(this).parent().prev().html();
//
//     //数量与单价相乘
//     var sum = oldValue * price;
//     // console.log(sum);
//
//     //写入计算后的结果
//     $(this).parent().next().html(Number(sum) + '.00');
//
//     total();
// });
//
//
// //小计中减去单价
// reduce.click(function () {
//
//     //获取购买的数量
//     var oldValue = $(this).next().val();
//     // console.log(oldValue);
//
//     //购买数量减一
//     oldValue --;
//
//     //判断购买数量
//     if (oldValue <= 1) {
//         oldValue = 1;
//     }
//     //修改加一后的购买数量
//     $(this).next().attr('value', oldValue);
//
//     // console.log($(this).parent().prev().html());
//     //获取单价的金额
//     var price = $(this).parent().prev().html();
//
//     //获取小计的金额
//     var Subtotal = $(this).parent().next().html();
//
//     //小计中减去单价
//     var sum = Subtotal - price;
//
//     // console.log(Subtotal);
//
//     //判断结果是否小于单价
//     if (sum <= price) {
//         sum = price;
//     }
//     //写入计算后的结果
//     $(this).parent().next().html(Number(sum) + '.00');
//
//     total();
//
// });
//
//
//
// $('.del').click(function() {
//     // $(this).parent().parent().remove();
//     var id = $(this).parent().parent().find($('.id')).val();
//     // console.log(id);
//     var that = $('.del');
//     $.ajax( {
//         url:'./action.php',
//         type:'get',
//         data:'cart=del&gid='+id,
//
//         success:function (data) {
//             // console.log($(that).parent().parent());
//             // alert(data);
//             if (data == '0') {
//                 $(that).parent().parent().remove();
//
//                 alert('删除成功');
//             }
//         },
//
//          dataType:'json'
//     });
//
//     total();
//
// });
//
//
//
// //计算所有商品的总金额
// function total () {
//
//     var Subtotal = $('.Subtotal');
//     var sum = 0;
//     // console.log(Subtotal);
//     for (var i=0; i < Subtotal.length; i++) {
//
//         sum += parseFloat(Subtotal[i].innerHTML);
//
//     }
//
//     $('.total').html(sum + '.00');
// }
//
//
// $('.orders').click(function() {
//     //商品id
//     var id = $('.id');
//     //购买数量
//     var num = $('.num');
//     //总金额
//     var total = $('.total').html();
//     var price = $('.price');
//     // console.log(price);
//     // console.log(num);
//     var arr = [];
//
//     for (var i=0; i < id.length; i++) {
//         arr.push(id[i].value) ;
//
//     }
//
//     arr.push(total);
//     console.log(arr);
//     $.ajax({
//         traditional: true,
//         url:'./action.php',
//         type:'post',
//         data:arr,
//         success:function (data) {
//             console.log(data);
//         },
//         dataType:'json'
//     });
//
//     // console.log(arr);
//
// });
