/**
 * Created by Administrator on 2017-07-04.
 */

$('.plus').click(function () {
    console.log($(this).prev().val());
    var num = $(this).prev();
    num.val(parseInt(num.val()) + 1);
    var privce = $(this).parent().prev().find($('.uniPrice')).text()
    console.log(privce);

});
