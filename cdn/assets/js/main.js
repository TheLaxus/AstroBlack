var URL = document.location.origin,
    API = URL + '/api';

$(document).ready(function() {
    var slides = $('.articles-slide-featured').length,
        slideInicial = 1,
        slideContainers = $('.articles-slide-featured'),
        interval = null;

    $('.articles-slide-featured').hide();
    $('.articles-slide-featured:nth-child(' + slideInicial + ')').show();

    var slideAtual = $('.articles-slide-featured:visible');

    if (slides > 1) {
        $(document).on('click', 'button.next', function() {
            var controller = $(this).parent(),
                currentSlide = $('.articles-slide-featured:visible'),
                nextSlide = (currentSlide.next().length) ? currentSlide.next() : $('.articles-slide-featured').first();

            controller.addClass('pointer-none');

            currentSlide.fadeOut(500);
            nextSlide.fadeIn(500, function() {
                controller.removeClass('pointer-none');
            });
        });

        $(document).on('click', 'button.prev', function() {
            var controller = $(this).parent(),
                currentSlide = $('.articles-slide-featured:visible'),
                prevSlide = (currentSlide.prev().length) ? currentSlide.prev() : $('.articles-slide-featured').last();

            controller.addClass('pointer-none');

            currentSlide.fadeOut(500);
            prevSlide.fadeIn(500, function() {
                controller.removeClass('pointer-none');
            });
        });

        $('.articles-slides-featured').mouseover(function() {
            clearInterval(interval);

            $(this).parent().parent().find('.articles-slides-controller').css({
                'visibility': 'visible'
            });
        }).mouseout(function() {
            $(this).parent().parent().find('.articles-slides-controller').css({
                'visibility': 'hidden'
            });

            interval = setInterval(intervalInit, 5000);
        });

        var intervalInit = function() {
            var currentSlide = $('.articles-slide-featured:visible'),
                nextSlide = (currentSlide.next().length) ? currentSlide.next() : $('.articles-slide-featured').first();

            currentSlide.fadeOut(500);
            nextSlide.fadeIn(500);
        }

        interval = setInterval(intervalInit, 5000);
    }
});

function RecaptchaExpired() {
    setTimeout(function() {
        grecaptcha.reset();
    }, 1000);
}

var countDownDate = new Date("Oct 19, 2021 19:00:00").getTime();
var myfunc = setInterval(function() {
var now = new Date().getTime();
var timeleft = countDownDate - now;
var days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
var hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);
document.getElementById("days").innerHTML = days +" dias"
document.getElementById("hours").innerHTML = hours + " horas "
document.getElementById("mins").innerHTML = minutes + " minutos "
document.getElementById("secs").innerHTML = seconds + " segundos "
if (timeleft < 0) {
clearInterval(myfunc);
document.getElementById("days").innerHTML = ""
document.getElementById("hours").innerHTML = "" 
document.getElementById("mins").innerHTML = ""
document.getElementById("secs").innerHTML = ""
document.getElementById("counter-main").innerHTML = '';
document.remove();
}
}, 10);
