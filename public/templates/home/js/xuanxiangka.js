
 $(function(){
 	$('.menu').children().click(function(){
        // $(this) 就是 li
        // li 的子元素就是 a
        $(this).children();
        // 获取自己的索引值
        var index = $(this).index() ;
        $('.macn li')
            .eq(index).css('display','block')
            .siblings().css('display','none');
    });
 });