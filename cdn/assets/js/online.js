var intervalOnlineCount = null,
intervalOnlineCountInit = function() {
	$.post(API + '/get/online.php', function(data) {
		$('.online-count-box').html(data['count']);
	});
}

function SetIntervals() {
	/* ---------------------------------------------- */
	intervalOnlineCount = setInterval(intervalOnlineCountInit, 60000);
	/* ---------------------------------------------- */
}

SetIntervals();