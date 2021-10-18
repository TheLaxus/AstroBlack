
$(document).on('click', '.set-client-version > button', function() {
    var button = $(this),
        data = {
            order: 'version',
            version: $(this).attr('version')
        }

    $.ajax({
        url: '/api/client',
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function() {
            $('.set-client-version').addClass('pointer-none');

            button.animate({
                'opacity': '0.8'
            });
        },
        success: function(data) {
            if (data['response']) {
                window.location.reload();
            } else {
                $('.set-client-version').removeClass('pointer-none');

                button.animate({
                    'opacity': '1'
                });
            }
        }
    });
});