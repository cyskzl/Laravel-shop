window.onload = function () {
    var banner = $('#banner');
    var list = $('#silder-list');
    var round = $('#round').children();
    var prev = $('#prev');
    var next = $('#next');
    var timer;
    var index=1;

    function animate (offset) {

        var newLeft = parseFloat(list.css('margin-left')) + offset;
        list.css('margin-left',newLeft+'px');
        if(newLeft > 0) 
        {
            list.css('margin-left','-4400px');
        }else if(newLeft < -4400){
            list.css('margin-left','0px');
        }
    }
    prev.onclick = function (){
        index -=1;
        if(index<1){
            index=3;
        }
        buttonsShow();
        animate(1100);
    };
    next.onclick = function (){
        index +=1;
        if(index>3){
            index=1;
        }
        buttonsShow();
        animate(-1100);
    };

    function play () {

        timer = setInterval(function () {
            next.onclick();
        },2000)
    };
    function stop () {
        clearInterval(timer);
    };

    function buttonsShow () {
        for (var i=0;i<round.length;i++){
            if(round[i].className =='sel') {
                // console.log(round[i]);
                round[i].className = '';
            } 
        }
        round[index-1].className = 'sel';
    };

    for(var i=0;i<round.length;i++) {

        (function (i) {
            round[i].onclick = function () {
                var checkIndex = parseFloat(this.getAttribute('index'));
                var offset = 1100*(index-checkIndex);
                index = checkIndex;
                animate(offset);
                buttonsShow();
            }
        })(i)
    }
    play();
    banner.mouseout(play);
    banner.mouseover(stop);
}
