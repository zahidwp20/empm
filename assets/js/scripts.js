/* globals Chart:false, feather:false */

(function ($) {
    'use strict'
    feather.replace({'aria-hidden': 'true'});


    $(document).on('click', '.empm-update-user-status', function () {

        let thisButton = $(this),
            thisRow = thisButton.parent().parent(),
            userID = thisRow.data('user-id'),
            userStatusTarget = thisButton.data('status-target');

        thisButton.html('Working...');

        $.ajax({
            url: 'ajax.php',
            type: 'post',
            context: this,
            data: {
                action: 'empm_update_user_status',
                user_id: userID,
                status_target: userStatusTarget,
            },
            success: function (result) {

                let response = JSON.parse(result);

                if (response.status) {
                    setTimeout(function () {
                        thisRow.html(response.message);
                    }, 500);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

        return false;
    });


    $(document).on('show.bs.modal', function (e) {

        let thisEditButton = $(e.relatedTarget),
            thisRow = thisEditButton.parent().parent(),
            userName = thisRow.find('.user-name').data('user-name');

        $(e.target).find('#exampleModalLabel').html('Edit User: ' + userName);
    });

})(jQuery)