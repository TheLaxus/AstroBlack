//FLASH
$(document).on('submit', 'form.set-client-flash-24', function() {
	var form = $(this),
	lastButton = form.find('button[type="submit"').html(),
	data = {
		order: 'version-24',
		version24: form.find('button[type="submit"').attr('version_24')
	}

	$.ajax({
		url: '/api/client',
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

                window.location = "client"
			} else {
                button.animate({
                    'opacity': '1'
                });
			}

			setTimeout(function() {
				form.find('button[type="submit"]').removeAttr('disabled', 'disabled');
				form.find('button[type="submit"]').html(lastButton);
			}, 500);
		}
	});

	return false;
});

$(document).on('submit', 'form.set-client-flash-60', function() {
	var form = $(this),
	lastButton = form.find('button[type="submit"').html(),
	data = {
		order: 'version-60',
		version60: form.find('button[type="submit"').attr('version_60')
	}

	$.ajax({
		url: '/api/client',
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

                window.location = "client"
			} else {
                button.animate({
                    'opacity': '1'
                });
			}

			setTimeout(function() {
				form.find('button[type="submit"]').removeAttr('disabled', 'disabled');
				form.find('button[type="submit"]').html(lastButton);
			}, 500);
		}
	});

	return false;
});

//BETA

$(document).on('submit', 'form.set-client-beta-24', function() {
	var form = $(this),
	lastButton = form.find('button[type="submit"').html(),
	data = {
		order: 'version-beta-24',
		versionBeta_24: form.find('button[type="submit"').attr('versionBeta_24')
	}

	$.ajax({
		url: '/api/client',
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

                window.location = "html5" 
			} else {
                button.animate({
                    'opacity': '1'
                });
			}

			setTimeout(function() {
				form.find('button[type="submit"]').removeAttr('disabled', 'disabled');
				form.find('button[type="submit"]').html(lastButton);
			}, 500);
		}
	});

	return false;
});

$(document).on('submit', 'form.set-client-beta-60', function() {
	var form = $(this),
	lastButton = form.find('button[type="submit"').html(),
	data = {
		order: 'version-beta-60',
		versionBeta_60: form.find('button[type="submit"').attr('versionBeta_60')
	}

	$.ajax({
		url: '/api/client',
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

                window.location = "html5" 
			} else {
                button.animate({
                    'opacity': '1'
                });
			}

			setTimeout(function() {
				form.find('button[type="submit"]').removeAttr('disabled', 'disabled');
				form.find('button[type="submit"]').html(lastButton);
			}, 500);
		}
	});

	return false;
});

// APLICATIVO E PUFFIN

$(document).on('submit', 'form.download-app', function() {
	var form = $(this),
	lastButton = form.find('button[type="submit"').html(),
	data = {
		order: 'download-app',
	}

	$.ajax({
		url: '/api/client',
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

                window.open('https://mega.nz/file/92R1wKjK#lO4K6Qb8hZ-KSLcXocWfsjfTryc5kWLa66-cUVal93o', '_blank')
			} else {
                button.animate({
                    'opacity': '1'
                });
			}

			setTimeout(function() {
				form.find('button[type="submit"]').removeAttr('disabled', 'disabled');
				form.find('button[type="submit"]').html(lastButton);
			}, 500);
		}
	});

	return false;
});

$(document).on('submit', 'form.download-puffin', function() {
	var form = $(this),
	lastButton = form.find('button[type="submit"').html(),
	data = {
		order: 'download-puffin',
	}

	$.ajax({
		url: '/api/client',
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

                window.open('https://play.google.com/store/apps/details?id=com.cloudmosa.puffinFree&hl=pt_BR&gl=US')
			} else {
                button.animate({
                    'opacity': '1'
                });
			}

			setTimeout(function() {
				form.find('button[type="submit"]').removeAttr('disabled', 'disabled');
				form.find('button[type="submit"]').html(lastButton);
			}, 500);
		}
	});

	return false;
});