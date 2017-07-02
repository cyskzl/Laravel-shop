window.onload = function () {

    var container = document.getElementById('banner');
    var list = document.getElementById('silder-list');
    var buttons = document.getElementById('round').getElementsByTagName('i');
    var prev = document.getElementById('prev');
    var next = document.getElementById('next');
    var timer;
    var index = 1;
    // console.log(buttons[0].className);return false;
    function animate(offset) {

        var newLeft = parseFloat(list.style.marginLeft) + offset;
        list.style.marginLeft = newLeft + 'px';
        if (newLeft > 0) {
            list.style.marginLeft = -3300 + 'px';
        } else if (newLeft < -3300) {
            list.style.marginLeft = -1100 + 'px';
        }
    }

    prev.onclick = function () {
        index -= 1;
        if (index < 1) {
            index = 3;
        }
        buttonsShow();
        animate(1100);
    };

    next.onclick = function () {
        index += 1;
        if (index > 3) {
            index = 1;
        }
        buttonsShow();
        animate(-1100);
    };

    function play() {

        timer = setInterval(function () {
            next.onclick();
        }, 1500)
    }

    function stop() {
        clearInterval(timer);
    }

    function buttonsShow() {
        for (var i = 0; i < buttons.length; i++) {

            if (buttons[i].className == 'sel') {
                buttons[i].className = '';
            }
        }
        buttons[index - 1].className = 'sel';
    }

    for (var i = 0; i < buttons.length; i++) {

        (function (i) {
            buttons[i].onclick = function () {
                var checkIndex = parseFloat(this.getAttribute('index'));
                var offset = 1100 * (index - checkIndex);
                index = checkIndex;
                animate(offset);
                buttonsShow();
            }
        })(i)
    }
    play();
    container.onmouseover = stop;
    container.onmouseout = play;


    var left = document.getElementById('left');
    var right = document.getElementById('right');
    var putaway = document.getElementById('putaway');

    function newGoods(offset){
        var putleft = parseFloat(putaway.style.left) + offset;
        putaway.style.left = putleft + 'px';
        if (putleft > 0) {
            putaway.style.left = -1120 + 'px';
        } else if (putleft < -1120) {
            putaway.style.left = 0 + 'px';
        }

    };

    left.onclick = function (){
        newGoods(1120);
    };

    right.onclick = function (){
        newGoods(-1120);
    };

    // $('.right').click(function()
    // {
    //     $('.putaway-around').animate(
    //         {
    //             left:'-1120px'
    //         },1000);
    // })
    // $('.left').click(function()
    // {
    //     $('.putaway-around').animate(
    //         {
    //             left:'0px'
    //         },1000);
    // });


};

