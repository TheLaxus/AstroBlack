console.log("%cAVISO IMPORTANTE", "font: bold 40px sans-serif;color: rgb(237, 28, 28);text-shadow: 2px 0 0 rgb(0, 0, 0), -2px 0 0 rgb(0, 0, 0), 0 2px 0 rgb(0, 0, 0), 0 -2px 0 rgb(0, 0, 0), 1px 1px rgb(0, 0, 0), -1px -1px 0 rgb(0, 0, 0), 1px -1px 0 rgb(0, 0, 0), -1px 1px 0 rgb(0, 0, 0)");
console.log("%cO console, é uma ferramenta de desenvolvimento. Caso alguém peça para que você cole algo aqui dizendo que você pode ganhar qualquer tipo de moeda, não acredite, do contrário você vai estar comprometendo o acesso da sua conta através de algo que você colou aqui.\n\nTudo que você fizer através do console, será de total responsabilidade sua!\n\n\Equipe CrazzY\n", "bold 20px sans-serif");



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

var intervalOnlineCount = null,
intervalOnlineCountInit = function() {
	$.post(API + '/get/online.php', function(data) {
		$('.online-count-box').html(data['count']);
	});
}

function SetIntervals() {
	/* ---------------------------------------------- */
	intervalOnlineCount = setInterval(intervalOnlineCountInit, 10000);
	/* ---------------------------------------------- */
}

SetIntervals();