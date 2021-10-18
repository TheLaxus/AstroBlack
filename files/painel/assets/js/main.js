var content = $('.content');

$(document).on('submit', 'form.form-login-panel', function() {
	var form = $(this),
	lastButton = form.find('button[type="submit"]').html(),
	data = {
		order: 'login',
		pin: form.parent().find('input[name="pin"]').val()
	}

	$.ajax({
		url: '/api/panel',
		type: 'POST',
		data: data,
		dataType: 'json',
		beforeSend: function() {
			form.find('button[type="submit"]').attr('disabled', 'disabled');
			form.find('button[type="submit"]').html('<div class="loader-button"></div>');
		},
		success: function(data) {
			if (data['response'] == 'success') {
				document.location.href = '/panel/home';
			} else {
				if ($('.error-container').length > 0) {
					$('.error-container').slideUp(500, function() {
						$('.error-container').html(data['append']).slideDown(500);
					});
				} else {
					$('.error-container').html(data['append']).hide();
					$('.error-container').slideDown(500);
				}
			}

			form.find('button[type="submit"]').attr('disabled', null);
			form.find('button[type="submit"]').html(lastButton);
		}
	});

	return false;
});

$(document).on('submit', 'form.form-edit-article', function(e) {
	var form = $(this),
	lastButton = form.find('button[type="submit"]').html(),
	data = {
		order: 'article/edit',
		article_id: form.attr('data-article-id'),
		title: form.find('input[name="title"]').val(),
		subtitle: form.find('input[name="subtitle"]').val(),
		thumbnail: form.find('input[name="thumbnail"]').val(),
		category: form.find('select[name="category"]').val(),
		body: form.find('textarea[name="body"]').val(),
		date_expire: form.find('input[name="date-expire"]').val(),
		hour_expire: form.find('input[name="hour-expire"]').val(),
		draft: form.find('select[name="draft"]').val(),
		form: form.find('select[name="form"]').val(),
		use_badge: form.find('select[name="use_badge"]').val(),
		badge_code: form.find('input[name="badgeCod"]').val()
	}

	$.ajax({
		url: '/api/panel',
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
			if (data['response'] == 'warn') {
				if (data['updates']['title']) {
					content.find('.header-content > label > h2 > span').text(data['updates']['title']);
					form.find('.form-warns').html(data['append']).hide().slideDown(500);
				}

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

$(document).on('submit', 'form.form-create-article', function(e) {
	var form = $(this),
	lastButton = form.find('button[type="submit"]').html(),
	data = {
		order: 'article/create',
		title: form.find('input[name="title"]').val(),
		subtitle: form.find('input[name="subtitle"]').val(),
		thumbnail: form.find('input[name="thumbnail"]').val(),
		category: form.find('select[name="category"]').val(),
		body: form.find('textarea[name="body"]').val(),
		date_expire: form.find('input[name="date-expire"]').val(),
		hour_expire: form.find('input[name="hour-expire"]').val(),
		draft: form.find('select[name="draft"]').val(),
		use_badge: form.find('select[name="use_badge"]').val(),
		badge_code: form.find('input[name="badgeCod"]').val()

	}

	$.ajax({
		url: '/api/panel',
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
				CKEDITOR.instances['body'].setData('');

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

$(document).on('submit', 'form.form-host-badge', function(e) {
	var form = $(this),
	lastButton = form.find('button[type="submit"]').html();

	if (form.find('input[name="order"]').val() == 'host-badge') {
		$.ajax({
			url: '/api/panel',
			type: 'POST',
			data: new FormData(this),
			dataType: 'json',
			processData: false,
			contentType: false,
			beforeSend: function() {
				form.find('.form-warns').empty();
				form.find('.error-input').removeClass('error-input');
				form.find('.error-input-warn').empty();

				form.find('button[type="submit"]').attr('disabled', 'disabled');
				form.find('button[type="submit"]').find('label h5').html('<div class="loader-button"></div>');
			},
			success: function(data) {
				if (data['response'] == 'success') {
					form.find('.form-warns').html(data['append']).hide().slideDown(500);

					form.trigger('reset');
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
	}

	return false;
});

$(document).on('click', 'a.my-article-action-delete', function() {
	var button = $(this),
	article = button.parent().parent().parent(),
	data = {
		order: 'article/delete',
		article_id: article.attr('data-article-id')
	}

	$.ajax({
		url: '/api/panel',
		type: 'POST',
		data: data,
		dataType: 'json',
		success: function(data) {
			if (data['response'] == 'success') {
				article.fadeOut(500, function() {
					$(this).remove();

					if ($('.card-columns.my-articles > div').length == 0) {
						$('<label class="text-center pd-2 flex width-content"><h4 class="mr-auto">Nenhuma noticia para ser mostrada por aqui.</h4></label>').appendTo('.card-columns.my-articles').fadeIn(250);
					}
				});
			} else {
				return false;
			}
		}
	});

	return false;
});


$('select[name="use_badge"]').change(function() {
	if ($(this).val() == "1") {

		if($('form-create-article .another-options')) {
			$('form.form-create-article .another-options').find('.badge-code-promo').slideDown(250);
		}

		if ($('form.form-edit-article .another-options')) {
			$('form.form-edit-article .another-options').find('.badge-code-promo').slideDown(250);
		}
	} else {
		if($('form-create-article .another-options')) {
			$('form.form-create-article .another-options').find('.badge-code-promo').slideUp(250);
		}

		if ($('form.form-edit-article .another-options')) {
			$('form.form-edit-article .another-options').find('.badge-code-promo').slideUp(250);
		}
	}
});

$('select[name="category"]').change(function() {
	if ($(this).val() == 'Promoções') {
		if ($('form.form-create-article .another-options')) {
			$('form.form-create-article .another-options').find('.promotions-date-expire').slideDown(250);
		}

		if ($('form.form-edit-article .another-options')) {
			$('form.form-edit-article .another-options').find('.promotions-date-expire').slideDown(250);
		}
	} else {
		if ($('form.form-create-article .another-options')) {
			$('form.form-create-article .another-options').find('.promotions-date-expire').slideUp(250);
		}

		if ($('form.form-edit-article .another-options')) {
			$('form.form-edit-article .another-options').find('.promotions-date-expire').slideUp(250);
		}
	}
});

$('select[name="form"]').change(function() {
	if ($(this).val() == 'enabled') {
		$(this).parent().find('.form-input-link').slideDown(250);
	} else {
		$(this).parent().find('.form-input-link').slideUp(250);
	}
});

$('select[name="points-action"]').change(function() {
	if ($(this).val() == 'add-points') {
		$(this).parent().parent().find('button[type="submit"] h5 > span').text('Adicionar');
	} else {
		$(this).parent().parent().find('button[type="submit"] h5 > span').text('Remover');
	}
});

$(document).on('click', '.sideBar-controller', function() {
	var sideBar = $('.container > .sideBar'),
	sideBarOverlay = $('.container > .sideBar-overlay');

	sideBar.addClass('active');
	sideBarOverlay.fadeIn(250);
});

$(document).on('click', '.container > .sideBar-overlay', function() {
	var sideBar = $('.container > .sideBar'),
	sideBarOverlay = $('.container > .sideBar-overlay');

	if (sideBar.hasClass('active')) {
		sideBar.removeClass('active');
		sideBarOverlay.fadeOut(250);
	}
});

$(function() {
	var categories = $('select[name="category"]');

	categories.find('option[value="' + categories.attr('data-category') + '"]').attr('select', 'select').prop('selected', true);
});

$(document).on('submit', 'form.form-hall-points', function(e) {
	var form = $(this),
	lastButton = form.find('button[type="submit"]').html(),
	data = {
		order: 'hall-points',
		username: form.find('input[name="username"]').val(),
		points_type: form.find('select[name="points-type"]').val(),
		points_amount: form.find('input[name="points-amount"]').val(),
		points_action: form.find('select[name="points-action"]').val()
	}

	$.ajax({
		url: '/api/panel',
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


$(document).on('keyup', 'input', function(e) {
	$(this).attr('value', $(this).val());
});

function deleteBan(id) {
	$.post('../../../api/actions/delete-bans.php', {id: id}, function(dados) {
		if(dados == 'sucesso') {
			alert("Ban removido com sucesso!");
			window.location.reload()
		} else {
			alert("Erro ao retirar banimento");
		}
	});
}

$(document).on('submit', 'form.form-addpin', function(e) {
	var form = $(this),
	lastButton = form.find('button[type="submit"]').html(),
	data = {
		order: 'add-pin',
		username: form.find('input[name="user-give-pin"]').val(),
		pin: form.find('input[name="user-pin"]').val()
	}

	$.ajax({
		url: '/api/panel',
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

$(document).on('submit', 'form.form-give-rank', function(e) {
	var form = $(this),
	lastButton = form.find('button[type="submit"]').html(),
	data = {
		order: 'give-rank',
		username: form.find('input[name="user-give-rank"]').val(),
		rank: form.find('select[name="user-rank"]').val()
	}

	$.ajax({
		url: '/api/panel',
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

$(document).on('submit', 'form.form-create-page', function(e) {
	var form = $(this),
	lastButton = form.find('button[type="submit"]').html(),
	data = {
		order: 'create-page',
		pageTitle: form.find('input[name="titlePage"]').val(),
		pageLink: form.find('input[name="linkPage"]').val()
	}

	$.ajax({
		url: '/api/panel',
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

$(document).on('submit', 'form.form-add-furni', function(e) {
	var form = $(this),
	lastButton = form.find('button[type="submit"]').html(),
	data = {
		order: 'add-furni',
		page: form.find('select[name="page_id"]').val(),
		catalogName: form.find('input[name="catalog_name"]').val(),
		costDiamonds: form.find('input[name="cost_diamonds"').val(),
		costCredits: form.find('input[name="cost_credits"').val(),
		costDuckets: form.find('input[name="cost_pixels"').val(),
		costCrazzys: form.find('input[name="cost_seasonal"').val(),
		amount: form.find('input[name="amount"').val(),
		limitedStack: form.find('input[name="limited_stack"').val(),
		badgeId: form.find('input[name="badge_id"').val(),
		downloadFrom: form.find('select[name="downloadFrom"]').val(),
		itemName: form.find('input[name="item_name"').val(),
		publicName: form.find('input[name="public_name"').val(),
		typeMobi: form.find('select[name="type"]').val(),
		width: form.find('input[name="width"').val(),
		length: form.find('input[name="length"').val(),
		stackHeight: form.find('input[name="stack_height"').val(),
		canStack: form.find('select[name="can_stack"]').val(),
		canSit: form.find('select[name="can_sit"]').val(),
		isWalkable: form.find('select[name="is_walkable"]').val(),
		allowRecycle: form.find('select[name="allow_recycle"]').val(),
		allowTrade: form.find('select[name="allow_trade"]').val(),
		allowMarketplace: form.find('select[name="allow_marketplace_sell"]').val(),
		allowGift: form.find('select[name="allow_gift"]').val(),
		allowInvStack: form.find('select[name="allow_inventory_stack"]').val(),
		interactionType: form.find('input[name="interaction_type"').val(),
		interactionCount: form.find('input[name="interaction_modes_count"').val(),
		vendingsId: form.find('input[name="vending_ids"').val(),
		effectId: form.find('input[name="effect_id"').val(),
		variableHeight: form.find('input[name="variable_heights"').val(),
		description: form.find('input[name="description"').val(),
		canLayon: form.find('select[name="canlayon"]').val(),
		requireRights: form.find('select[name="requires_rights"]').val(),
		idSound: form.find('input[name="song_id"').val()
	}

	$.ajax({
		url: '/api/panel',
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


$(document).on('submit', 'form.form-edit-campaign', function(e) {
	var form = $(this),
	lastButton = form.find('button[type="submit"]').html(),
	data = {
		order: 'campaign/edit',
		article_id: form.attr('data-article-id'),
		titleCampaign: form.find('input[name="title-campaign"]').val(),
		descriptionCampaign: form.find('input[name="description-campaign"]').val(),
		thumbnailCampaign: form.find('input[name="thumbnail-campaign"]').val(),
		idCampaign: form.find('input[name="id-campaign"]').val(),
		activeCampaign: form.find('select[name="activeCampaign"]').val()
	}

	$.ajax({
		url: '/api/panel',
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

$(document).on('submit', 'form.form-search-user', function(e) {
	var form = $(this),
	lastButton = form.find('button[type="submit"]').html(),
	data = {
		order: 'edit-user',
		username: form.find('input[name="username"]').val()
	}

	$.ajax({
		url: '/api/panel',
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

$(document).on('submit', 'form.form-info-user', function(e) {
	var form = $(this),
	lastButton = form.find('button[type="submit"]').html(),
	data = {
		order: 'info-user',
		id: form.find('input[name="info-id"]').val(),
		username: form.find('input[name="info-username"]').val(),
		email: form.find('input[name="info-email"]').val(),
		motto: form.find('input[name="info-motto"]').val(),
		rank: form.find('select[name="info-rank"]').val()
	}

	$.ajax({
		url: '/api/panel',
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

$(document).on('submit', 'form.form-send-vip', function(e) {
	var form = $(this),
	lastButton = form.find('button[type="submit"]').html(),
	data = {
		order: 'send-vip',
		username: form.find('input[name="username"]').val(),
		plans: form.find('select[name="plans"]').val()

	}

	$.ajax({
		url: '/api/panel',
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