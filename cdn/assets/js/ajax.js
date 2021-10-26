/*
 *	Arquivo responsavél pelas req's do site. | Criado por Dut.
 */

var ajax = [];

ajax['login'] = API + '/login';
ajax['register'] = API + '/register';
ajax['reaction'] = API + '/reaction';
ajax['deleteTags'] = API + '/deleteTags';

// select-html
$(document).on('click', '.close-modal', function() {

	$('.modal-container').removeClass('active');

});

$('#html-v').on('click', function () {
	var dataModal = $(this).attr('data-modal');

	$('.modal-container[data-modal="' + dataModal + '"]').addClass('active');	
	
});

// select-flash
$(document).on('click', '.close-modal', function() {

	$('.modal-container').removeClass('active');

});

$('#flash-v').on('click', function () {
	var dataModal = $(this).attr('data-modal');

	$('.modal-container[data-modal="' + dataModal + '"]').addClass('active');	
	
});

//Form
$(document).on('click', '.close-modal', function() {

	$('.modal-container').removeClass('active');
});

$('#news-open-form').on('click', function () {
	var dataModal = $(this).attr('data-modal');

	$('.modal-container[data-modal="' + dataModal + '"]').addClass('active');
});

$(document).on('submit', 'form.form-send', function() {
	var form = $(this),
	lastButton = form.find('button[type="submit"').html(),
	data = {
		order: 'request-form',
		article_id: form.find('input[name="id_news"]').val(),
		username: form.find('input[name="form_username"]').val(),
		message: form.find('input[name="form_message"]').val()
	}

	$.ajax({
		url: '/api/form',
		type: 'POST',
		data: data,
		beforeSend: function() {
			form.find('.form-warns').empty();
			form.find('.error-input').removeClass('error-input');
			form.find('.error-input-warn').empty();

			form.find('button[type="submit"]').attr('disabled', 'disabled');
			form.find('button[type="submit"]').html('<div class="loader-button"></div>');
		},
		dataType: 'json',
		success: function(data) {
			if (data['response'] == 'success') {
				form.find('.form-warns').html(data['append']).hide().slideDown(500);

				form.trigger('reset');

				content.animate({
					scrollTop: 0
				});
			} else {
				form.find(data['input']).addClass('error-input');

				if (data['error']) {
					form.find(data['error']['class']).html(data['error']['text']);
				}
			}

			setTimeout(function() {
				form.find('button[type="submit"]').removeAttr('disabled', 'disabled');
				form.find('button[type="submit"]').html(lastButton);
			}, 500);
		}
	});

	return false;
});


// BADGE
$(document).on('click', '.close-modal', function() {

	$('.modal-container').removeClass('active');

});

$('#modal-open-badge').on('click', function () {
	var dataModal = $(this).attr('data-modal');

	$('.modal-container[data-modal="' + dataModal + '"]').addClass('active');	
	
});

$(document).on('submit', 'form.form-send-badge', function() {
	var form = $(this),
	lastButton = form.find('button[type="submit"').html(),
	data = {
		order: 'send-badge',
		article_id: form.find('input[name="articleBadgeId"]').val(),
		username: form.find('input[name="usernameWin"]').val(),
		badge_code: form.find('input[name="badgeCode"]').val()

	}

	$.ajax({
		url: '/api/badge',
		type: 'POST',
		data: data,
		beforeSend: function() {
			form.find('.form-warns').empty();
			form.find('.error-input').removeClass('error-input');
			form.find('.error-input-warn').empty();

			form.find('button[type="submit"]').attr('disabled', 'disabled');
			form.find('button[type="submit"]').html('<div class="loader-button"></div>');
		},
		dataType: 'json',
		success: function(data) {
			if (data['response'] == 'success') {

				form.find('.form-warns').html(data['append']).hide().slideDown(500);

				form.trigger('reset');

				content.animate({
					scrollTop: 0
				});
			} else {
				form.find(data['input']).addClass('error-input');

				if (data['error']) {
					form.find(data['error']['class']).html(data['error']['text']);
				}
			}

			setTimeout(function() {
				form.find('button[type="submit"]').removeAttr('disabled', 'disabled');
				form.find('button[type="submit"]').html(lastButton);
			}, 500);
		}
	});

	return false;
});


$(document).on('click', '.login-area > button.login-button', function() {

	var base = $(this).parent(),
		button = $(this),
		data = {
			type: 'normal',
			username: base.find('input[name="username"]').val(),
			password: base.find('input[name="password"]').val(),
			remember: base.find('input[name="remember"]').val()
		};

		

	$.ajax({
		method: 'POST',
		url: ajax['login'],
		data: data,
		dataType: 'json',
		beforeSend: function() {
			button.addClass('pointer-none').animate({
				'opacity': '0.7'
			});
		},
		success: function(data) {
			if (data['response'] == 'success') {
				document.location.href = '/me';

			} else if (data['response'] == 'error') {
				if (base.find('.errors-area > .error-box').length > 0) {
					base.find('.errors-area').slideUp(500, function() {
						$(this).find('.error-box').remove();
						base.find('.errors-area').html(data['append']).hide().slideDown(500);
					});
				} else {
					base.find('.errors-area').html(data['append']).hide().slideDown(500);
				}

				button.removeClass('pointer-none').animate({
					'opacity': '1'
				});
			}
		}
	});

	return false;
});

$(document).on('click', '.login-staff > button.staff-login', function() {
	var base = $(this).parent(),
		button = $(this),
		data = {
			type: 'staff',
			username: base.find('input[name="username"]').val(),
			password: base.find('input[name="password"]').val(),
		};

	$.ajax({
		method: 'POST',
		url: ajax['login'],
		data: data,
		dataType: 'json',
		beforeSend: function() {
			button.addClass('pointer-none').animate({
				'opacity': '0.7'
			});
		},
		success: function(data) {
			if (data['response'] == 'success') {
				document.location.href = '/me';
			} else if (data['response'] == 'error') {
				if (base.find('.errors-area > .error-box').length > 0) {
					base.find('.errors-area').slideUp(500, function() {
						$(this).find('.error-box').remove();
						base.find('.errors-area').html(data['append']).hide().slideDown(500);
					});
				} else {
					base.find('.errors-area').html(data['append']).hide().slideDown(500);
				}

				button.removeClass('pointer-none').animate({
					'opacity': '1'
				});
			}
		}
	});

	return false;
});

$(document).on('keyup', '.register-area input' , function() {
	if ($(this).hasClass('error-input')) {
		$(this).removeClass('error-input');
	}
})

$(document).on('click', '.register-area > .flex-column:last-child > .flex > button.register-button', function() {
	var base = $(this).parent().parent().parent(),
		button = $(this),
		hcaptchaVal = $('[name=h-captcha-response]').val()
		data = {
			username: base.find('input[name="username"]').val(),
			email: base.find('input[name="email"]').val(),
			password: base.find('input[name="password"]').val(),
			password_c: base.find('input[name="password_c"]').val(),
			captcha: hcaptchaVal
		};

	$.ajax({
		method: 'POST',
		url: ajax['register'],
		data: data,
		dataType: 'json',
		beforeSend: function() {
			button.addClass('pointer-none').animate({
				'opacity': '0.7'
			});

			base.find('.error-input').removeClass('error-input');

			console.log(data);
		},
		success: function(data) {
			if (data['response'] == 'success') {
				document.location.href = '/me';
			} else if (data['response'] == 'error') {
				if (base.find('.register-errors > .register-error-box').length > 0) {
					base.find('.register-errors').slideUp(500, function() {
						base.find('.register-errors').empty();
						base.find('.register-errors').html(data['label']['append']).hide().slideDown(500);
						base.find(data['label']['input']).addClass('error-input');
					});
				} else {
					base.find('.register-errors').html(data['label']['append']).hide().slideDown(500);

					if (data['label']['input']) {
						base.find(data['label']['input']).addClass('error-input');
					}
				}

				button.removeClass('pointer-none').animate({
					'opacity': '1'
				});
			}
		}
	});

	return false;
});

function deleteTags(id) {

	timeout = setTimeout(function() {
		$.ajax({
			type: "POST",
			url: ajax['deleteTags'],
			async: true,
			data: {
				'tag_id' : id
			},
			success: function(response) {

				if (response.success) {
					console.log("Sucesso ao deletar a tag");
				}
			},
			error: function (error) {
				console.log("Erro ao deletar a tag");
			},
			complete: function() {}
		})
	}, 250);
}


$(document).on('click', '.article-content-react > button', function() {
	var button = $(this),
	data = {
		type: 'article',
		post_id: button.parent().attr('data-article-id'),
		state: button.attr('data-state')
	}

	$.ajax({
		url: ajax['reaction'],
		type: 'POST',
		data: data,
		dataType: 'json',
		beforeSend: function() {
			$('.article-content-react').addClass('pointer-none');
		},
		success: function(data) {
			if (data['response'] == 'success') {
				button.addClass('active');

				$(data['append']).prependTo('.article-content-reactions').hide().fadeIn(250);
				$('.article-content-reactions').show();
			} else if (data['response'] == 'edit') {
				if (data['action'] == 'delete') {
					button.removeClass('active');

					$('.article-content-reactions').find('.article-content-reaction[title="' + data['label']['username'] + '"]').fadeOut(250, function() {
						$(this).remove();

						if ($('.article-content-reactions > .article-content-reaction').length == 0) {
							$('.article-content-reactions').hide();
						}
					});
				} else {
					$('.article-content-react > button.active').removeClass('active');
					$('.article-content-react').find('button[data-state="' + data['label']['state'] + '"]').addClass('active');
					$('.article-content-reactions > .article-content-reaction[title="' + data['label']['username'] + '"]').attr('state', data['label']['state']);
				}
			} else {
				return false;
			}

			$('.article-content-react').removeClass('pointer-none');
		}
	});
});


$(document).on('submit', 'form.form-others-settings', function(e) {
	var form = $(this),
	lastButton = form.find('button[type="submit"]').html(),
	data = {
		order: 'settings/account',
		motto: form.find('input[name="motto"]').val(),
		version: form.find('select[name="version"]').val(),
		version_beta: form.find('select[name="version_beta"]').val(),
		hideonline: form.find('input[name="online"]:checked').toArray().map(function(check) { 
			return $(check).val(); 
		}),
		lastOnline: form.find('input[name="last_online"]:checked').toArray().map(function(check) { 
			return $(check).val(); 
		}),
		amizade: form.find('input[name="amizade"]:checked').toArray().map(function(check) { 
			return $(check).val(); 
		}),
		seguir: form.find('input[name="seguir"]:checked').toArray().map(function(check) { 
			return $(check).val(); 
		}),
		copiar: form.find('input[name="copy"]:checked').toArray().map(function(check) { 
			return $(check).val(); 
		}),
		negociar: form.find('input[name="trade"]:checked').toArray().map(function(check) { 
			return $(check).val(); 
		}),
		sussurrar: form.find('input[name="sussurros"]:checked').toArray().map(function(check) { 
			return $(check).val(); 
		}),
		sexo: form.find('input[name="allow_sex"]:checked').toArray().map(function(check) { 
			return $(check).val(); 
		}),
	}

	$.ajax({

		url: '/api/settings',
		type: 'POST',
		data: data,
		beforeSend: function() {
			form.find('.form-warns').empty();
			form.find('.error-input').removeClass('error-input');
			form.find('.error-input-warn').empty();

			form.find('button[type="submit"]').attr('disabled', 'disabled');
			form.find('button[type="submit"]').html('<div class="loader-button"></div>');
		},
		dataType: 'json',
		success: function(data) {
			if (data['response'] == 'success') {

				form.find('.form-warns').html(data['append']).hide().slideDown(700);

				window.scrollTo(0,0);

			} else {
				form.find(data['input']).addClass('error-input');

				if (data['error']) {
					form.find(data['error']['class']).html(data['error']['text']);
				}
			}

			setTimeout(function() {
				form.find('button[type="submit"]').removeAttr('disabled', 'disabled');
				form.find('button[type="submit"]').html(lastButton);
			}, 500);
		}
	});

	return false;
});


$(document).on('submit', 'form.form-change-email', function(e) {
	var form = $(this),
	lastButton = form.find('button[type="submit"]').html(),
	data = {
		order: 'settings/email',
		password: form.find('input[name="currentPassword"]').val(),
		email: form.find('input[name="email"]').val()
	}

	$.ajax({

		url: '/api/settings',
		type: 'POST',
		data: data,
		beforeSend: function() {
			form.find('.form-warns').empty();
			form.find('.error-input').removeClass('error-input');
			form.find('.error-input-warn').empty();

			form.find('button[type="submit"]').attr('disabled', 'disabled');
			form.find('button[type="submit"]').html('<div class="loader-button"></div>');
		},
		dataType: 'json',
		success: function(data) {
			if (data['response'] == 'success') {

				form.find('.form-warns').html(data['append']).hide().slideDown(700);


				window.scrollTo(0,0);

			} else {
				form.find(data['input']).addClass('error-input');

				if (data['error']) {
					form.find(data['error']['class']).html(data['error']['text']);
				}
			}

			setTimeout(function() {
				form.find('button[type="submit"]').removeAttr('disabled', 'disabled');
				form.find('button[type="submit"]').html(lastButton);
			}, 500);
		}
	});

	return false;
});

$(document).on('submit', 'form.form-change-password', function(e) {
	var form = $(this),
	lastButton = form.find('button[type="submit"]').html(),
	data = {
		order: 'settings/password',
		currentpassword: form.find('input[name="currentpassword"]').val(),
		new_password: form.find('input[name="password"]').val()
	}

	$.ajax({

		url: '/api/settings',
		type: 'POST',
		data: data,
		beforeSend: function() {
			form.find('.form-warns').empty();
			form.find('.error-input').removeClass('error-input');
			form.find('.error-input-warn').empty();

			form.find('button[type="submit"]').attr('disabled', 'disabled');
			form.find('button[type="submit"]').html('<div class="loader-button"></div>');
		},
		dataType: 'json',
		success: function(data) {
			if (data['response'] == 'success') {

				form.find('.form-warns').html(data['append']).hide().slideDown(700);


				window.scrollTo(0,0);

				setTimeout(function () {    
					window.location = window.location.href; 
				}, 5000); // 5 seconds

			} else {
				form.find(data['input']).addClass('error-input');

				if (data['error']) {
					form.find(data['error']['class']).html(data['error']['text']);
				}
			}

			setTimeout(function() {
				form.find('button[type="submit"]').removeAttr('disabled', 'disabled');
				form.find('button[type="submit"]').html(lastButton);
			}, 500);
		}
	});

	return false;
});

$(document).on('submit', 'form.form-addtag', function(e) {
	var form = $(this),
	lastButton = form.find('button[type="submit"]').html(),
	data = {
		order: 'add/tags',
		tag_add: form.find('input[name="tag-add"]').val()
	}

	$.ajax({

		url: '/api/tags',
		type: 'POST',
		data: data,
		beforeSend: function() {
			form.find('.form-warns').empty();
			form.find('.error-input').removeClass('error-input');
			form.find('.error-input-warn').empty();

			form.find('button[type="submit"]').attr('disabled', 'disabled');
			form.find('button[type="submit"]').html('<div class="loader-button"></div>');
		},
		dataType: 'json',
		success: function(data) {
			if (data['response'] == 'success') {

				form.find('.form-warns').html(data['append']).hide().slideDown(700);


			} else {
				form.find(data['input']).addClass('error-input');

				if (data['error']) {
					form.find(data['error']['class']).html(data['error']['text']);
				}
			}

			setTimeout(function() {
				form.find('button[type="submit"]').removeAttr('disabled', 'disabled');
				form.find('button[type="submit"]').html(lastButton);
			}, 500);
		}
	});

	return false;
});
