var slw = $('.slider').width();
var slc = $('.slider .line > div').length;
var pos = 0;


function sliderSize() {
    $('.slider .line').width(slw * slc);
}

$('#left').on('click', slideLeft);

$('#right').on('click', slideRight);

function slideLeft() {
    if(pos > (slw * slc)-((slw * slc)*2)+slw ) {
        pos -= slw;
        $('.slider .line').animate({'margin-left': pos}, 1000);
    }else{
        pos = 0;
    }
    return false;
}


function slideRight() {
    if(pos<0) {
        pos += slw;
        $('.slider .line').animate({'margin-left': pos}, 1000);
    }
    return false;
}

sliderSize();

setInterval(slideLeft, 3000);