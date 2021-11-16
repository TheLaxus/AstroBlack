(function() {
	const Radio = {
		url: player.url,
		volume: player.volume,
		stream: null,
		streamDetectInterval: null,
		streamLoaded: false,
		streamPlayed: false,
		streamReloading: false,

		load: function(url) {
			var self = this;

			self.url = url;

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
					console.log("Minimizou");
				} else if (player.hasClass('minimized')) {
					player.removeClass('minimized').addClass('maximized');
					console.log("Maximizou");

				}
			});

			$(document).on('click', '.player-large-actions-playpause', function() {
				if (self.stream.played.length == 0 && self.stream.currentTime <= 0) {
					self.stream.muted = false;
					self.stream.play();

					$(this).removeClass('paused').addClass('played');
				} else {
					if ($(this).hasClass('played')) {
						self.stream.muted = true;
						$(this).removeClass('played').addClass('paused');
					} else {
						self.stream.muted = false;
						$(this).removeClass('paused').addClass('played');
					}
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
				self.stream = new Audio();
				self.stream.className = 'haibbo-stream-radio';
				self.stream.src = self.url;
				self.stream.muted = true;
				$('.haibbo-player').append(self.stream);

				self.stream.addEventListener('canplay', function() {
					self.streamLoaded = true;

					console.log('[RÁDIO] Streaming de áudio carregado com sucesso...');

					$('.haibbo-player.loadding').removeClass('loadding');

					self.setVolume(self.volume);

					if (self.streamReloading == true) {
						self.stream.muted = false;
						self.stream.play();

						$('.haibbo-player .player-large-actions-playpause.paused').removeClass('paused').addClass('played');

						self.streamReloading = false;
					}
				});

				self.stream.addEventListener('ended', function() {
					console.log('[RÁDIO] O streaming de áudio foi finalizado...');

					self.reload();
				});

				self.stream.addEventListener('error', function() {
					self.reload();

					console.log('[RÁDIO] Erro ao carregar streaming de áudio...');
				});
			}
		},

		reload: function() {
			var self = this;

			console.log('[RÁDIO] Recarregando streaming de áudio...');

			this.streamReloading = true;

			if (this.streamReloading == true) {
				if ($('audio.haibbo-stream-radio').length > 0) {
					$('.haibbo-player').addClass('loadding');
					$('.haibbo-player .player-large-actions-playpause.played').addClass('paused');

					if (this.streamDetectInterval != null) {
						self.streamDetectInterval = null;
					}

					self.streamLoaded = false;

					self.stream.pause();
					$('audio.haibbo-stream-radio').remove();
					self.stream = null;

					setTimeout(function() {
						self.init();
					}, 2500);
				}
			}
		},

		setVolume: function(volume) {
			this.volume = volume;
			this.stream.volume = parseFloat(volume);
		},

		refresh: function(type) {
			var self = this;

			if (type == 'numbers') {
				$.ajax({
					type: 'POST',
					url: '/api/radio.php',
					data: {
						url: self.url,
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
					url: '/api/radio.php',
					data: {
						url: self.url,
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
		setInterval(function() {
			Radio.refresh('numbers');
		}, 5000);

		Radio.load('http://srv11.ipstm.net:7022/;');
	});
})();