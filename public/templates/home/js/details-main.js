/**
 * Created by dell1 on 2017/6/22.
 */
$(function(){
<<<<<<< HEAD
    // å•†å“è¯¦æƒ…inputåˆ‡æ¢
    $('.details-title li').click(function(){
        $(this).addClass('under').siblings().removeClass('under');
        var index = $(this).index();
        $('.details>div').eq(index).removeClass('none').siblings('div').addClass('none');
    });
    // é¢œè‰²é€‰æ‹©
    $('div.color div').click(function(){
        $(this).css({'background':'#6D6D6D','color':'white'}).siblings().css({'background':'white','color':'black'})
        var index = $(this).index();
        $('div.size>div').eq(index).removeClass('none').siblings('div').addClass('none');
    });
    // å°ºå¯¸é€‰æ‹©
    $ ('div.size div div').click(function(){
        $(this).css({'background':'#6D6D6D','color':'white'}).siblings().css({'background':'white','color':'black'})
    });
    // æ•°é‡é€‰æ‹©
    $('div.number .minus').click(function(){
        var number = parseInt( $('#number').val());
        if(number == 1){
            $('#number').val('1');
        }else{
            number--;
            $('#number').val(number);
        }
    });

    $('div.number .add').click(function(){
        var number = parseInt( $('#number').val());
        number++;
        $('#number').val(number);
    });

    // æŸ¥çœ‹æ¡æ¡†å¼¹å‡ºæ¡†
    $('#clause').click(function(){
        $('#popup').removeClass('none')
    });

    $('#popup').click(function(){
        $(this).addClass('none');
    });
    $('#box').click(function(event){
        event.stopPropagation();
    });
    $('.X').click(function(){
        $('#popup').addClass('none');
    });

    //è¯„è®ºåŒº
    var text = document.getElementById('text');
    var submit = document.getElementById('submit');
    var cFooter = document.getElementById('comment-footer');
    submit.onclick = function(){
        var date = new Date;
        var time = date.getFullYear()+ '-' + date.getMonth()+ 1 + '-' + date.getDate() + '&nbsp;' + date.getHours() + ':' +  date.getMinutes()+':'+date.getSeconds();
        var  value = text.value;
        var  New = "<div class='clearfix'> <ul>"
            + "<li class='iD'>" + "1" + "</li>"
            + "<li class='time'>" + time + "</li>"
            + "<li class='reply'><img src='./public/png/xinxi.png' alt=''/></li>"
            + "</ul>"
            + "<span class='text'>" + value + "</span>"
            + "</div>";
        cFooter.innerHTML += New;
        text.value = '';
    };
=======
        // ÉÌÆ·ÏêÇéinputÇĞ»»
       $('.details-title li').click(function(){
           $(this).addClass('under').siblings().removeClass('under');
           var index = $(this).index();
           $('.details>div').eq(index).removeClass('none').siblings('div').addClass('none');
       });
       // ÑÕÉ«Ñ¡Ôñ
       $('div.color div').click(function(){
           $(this).css({'background':'#6D6D6D','color':'white'}).siblings().css({'background':'white','color':'black'})
           var index = $(this).index();
           $('div.size>div').eq(index).removeClass('none').siblings('div').addClass('none');
       });
       // ³ß´çÑ¡Ôñ
       $ ('div.size div div').click(function(){
           $(this).css({'background':'#6D6D6D','color':'white'}).siblings().css({'background':'white','color':'black'})
       });
       // ÊıÁ¿Ñ¡Ôñ
       $('div.number .minus').click(function(){
           var number = parseInt( $('#number').val());
           if(number == 1){
               $('#number').val('1');
           }else{
               number--;
               $('#number').val(number);
           }
       });

       $('div.number .add').click(function(){
            var number = parseInt( $('#number').val());
                number++;
                $('#number').val(number);
        });

        // ²é¿´Ìõ¿òµ¯³ö¿ò
        $('#clause').click(function(){
            $('#popup').removeClass('none')
        });

        $('#popup').click(function(){
            $(this).addClass('none');
        });
        $('#box').click(function(event){
            event.stopPropagation();
        });
        $('.X').click(function(){
            $('#popup').addClass('none');
        });

        //ÆÀÂÛÇø
        var text = document.getElementById('text');
        var submit = document.getElementById('submit');
        var cFooter = document.getElementById('comment-footer');
        submit.onclick = function(){
            var date = new Date;
            var time = date.getFullYear()+ '-' + date.getMonth()+ 1 + '-' + date.getDate() + '&nbsp;' + date.getHours() + ':' +  date.getMinutes()+':'+date.getSeconds();
            var  value = text.value;
            var  New = "<div class='clearfix'> <ul>"
                + "<li class='iD'>" + "1" + "</li>"
                + "<li class='time'>" + time + "</li>"
                + "<li class='reply'><img src='./public/png/xinxi.png' alt=''/></li>"
                + "</ul>"
                + "<span class='text'>" + value + "</span>"
                + "</div>";
            cFooter.innerHTML += New;
            text.value = '';
        };
>>>>>>> origin/dasuan



});