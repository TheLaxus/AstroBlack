const Radio = {
	url: player.url,
	volume: player.volume,
	stream: null,

	load: function() {
		var self = this;

		$('.player-large-actions-volume-bar').slider({
			value: this.volume * 100,
			orientation: "horizontal",
			range: "min",
			min: 0,
			max: 100,
			slide: function(event, ui) {
				self.setVolume(ui.value / 100);
			}
		});

		$('.haibbo-player').draggable({
			axis: 'y',
			containment: '.haibbo-player-area',
			scroll: false,
			handle: '.player-large-actions-dragplayer'
		});

		$(document).on('click', '.haibbo-player-large-control', function() {
			var player = $('.haibbo-player');

			if (player.hasClass('maximized')) {
				player.removeClass('maximized').addClass('minimized');
			} else if (player.hasClass('minimized')) {
				player.removeClass('minimized').addClass('maximized');
			}
		});

		$(document).on('click', '.player-large-actions-playpause', function() {
			if ($(this).hasClass('played')) {
				self.stream.mute(true);
				$(this).removeClass('played').addClass('paused');
			} else {
				self.stream.mute(false);
				$(this).removeClass('paused').addClass('played');
			}
		});

		$(document).on('click', '.player-large-actions-reconnect', function() {
			self.reload();
		});

		this.init();
		this.refresh('status');
	},

	init: function() {
		var self = this;

		if (this.stream == null) {
			self.stream = new Howl({
				src: self.url,
				volume: self.volume,
				format: 'mp3',
				onplay: function() {
					$('.player-large-actions-playpause').removeClass('paused').addClass('played');
					self.refreshEffect('end');
				},
				onloaderror: function() {
					self.reload();
				},
				onplayerror: function() {
					self.reload();
				},
				onload: function() {
					self.setVolume(self.volume);
					$('.haibbo-player').removeClass('loadding');
					self.stream.play();
				},
				onend: function() {
					self.reload();
				}
			});
		}
	},

	setVolume: function(volume) {
		this.volume = volume;
		this.stream.volume(parseFloat(volume));
	},

	reload: function() {
		if (!$('.haibbo-player').hasClass('loadding')) {
			$('.haibbo-player').addClass('loadding');
		}

		if ($('.player-large-actions-playpause').hasClass('played')) {
			$('.player-large-actions-playpause').removeClass('played').addClass('paused');
		}

		this.stream.unload();
		this.stream = null;
		this.init();
	},

	refresh: function(type) {
		var self = this;

		if (type == 'numbers') {
			$.ajax({
				type: 'POST',
				url: '/api/radio',
				data: {
					order: 'status'
				},
				dataType: 'json',
				success: function(data) {
					$('.haibbo-player-infos-speaker > span').text(data['speaker']);
					$('.haibbo-player-speaker > .haibbo-player-speaker-imager').css({'background-image': 'url(' + data['figure'] + ''});
					$('.haibbo-player-infos-programation > span').text(data['programation']);
					$('.haibbo-player-infos-listeners > span').text(data['listeners'] + ' ouvintes');

					self.refreshEffect('end');
				}
			});
		} else if (type == 'status') {
			self.refreshEffect('start');

			$.ajax({
				type: 'POST',
				url: '/api/radio',
				data: {
					order: 'status'
				},
				dataType: 'json',
				success: function(data) {
					$('.haibbo-player-infos-speaker > span').text(data['speaker']);
					$('.haibbo-player-speaker > .haibbo-player-speaker-imager').css({'background-image': 'url(' + data['figure'] + ''});
					$('.haibbo-player-infos-programation > span').text(data['programation']);
					$('.haibbo-player-infos-listeners > span').text(data['listeners'] + ' ouvintes');

					self.refreshEffect('end');
				}
			});
		}
	},

	refreshEffect: function(type) {
		if (type == 'start') {
			$('.haibbo-player-infos-speaker > span').animate({'opacity':'0.3'}, 500);
			$('.haibbo-player-infos-speaker > span').animate({'opacity':'0.8'}, 500);

			$('.haibbo-player-infos-programation > span').animate({'opacity':'0.3'}, 500);
			$('.haibbo-player-infos-programation > span').animate({'opacity':'0.8'}, 500);

			$('.haibbo-player-infos-listeners > span').animate({'opacity':'0.3'}, 500);
			$('.haibbo-player-infos-listeners > span').animate({'opacity':'0.8'}, 500);

			$('.haibbo-player-infos-speaker > span').animate({'opacity':'0.3'}, 500);
			$('.haibbo-player-infos-speaker > span').animate({'opacity':'0.8'}, 500);

			$('.haibbo-player-infos-programation > span').animate({'opacity':'0.3'}, 500);
			$('.haibbo-player-infos-programation > span').animate({'opacity':'0.8'}, 500);

			$('.haibbo-player-infos-listeners > span').animate({'opacity':'0.3'}, 500);
			$('.haibbo-player-infos-listeners > span').animate({'opacity':'0.8'}, 500);
		} else if (type == 'end') {
			$('.haibbo-player-infos-speaker > span').animate({'opacity':'1'}, 500);
			$('.haibbo-player-infos-programation > span').animate({'opacity':'1'}, 500);
			$('.haibbo-player-infos-listeners > span').animate({'opacity':'1'}, 500);
		}
	}
}

$(window).on('load', function() {
	Radio.load(2500);

	setInterval(function() {
		Radio.refresh('numbers');
	}, 60000);
});