/* globals Chart:false, feather:false */

(function ($) {
    'use strict'
    feather.replace({
        'aria-hidden': 'true'
    });


    $(document).ready(function () {

        let allSelect2 = $('.select2');

        if (allSelect2.length > 0) {
            allSelect2.select2();
        }
    });


    /**
     * aJax search
     */
    $(document).on('input', '#searchField', function () {

        let thisSearchField = $(this),
            thisSearchValue = thisSearchField.val(),
            usersTable = $('.table-users');

        $.ajax({
            url: 'ajax.php',
            type: 'post',
            context: this,
            data: {
                action: 'empm_search_users',
                s: thisSearchValue,
            },
            success: function (result) {

                let response = JSON.parse(result);

                if (response.status) {
                    usersTable.find('tbody').html(response.message);
                }
            }
        });
    });


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

        let thisButton = $(e.relatedTarget),
            thisRow = thisButton.parent().parent(),
            userName = thisRow.find('.user-name').data('user-name'),
            modalForm = $('form.modal-user-update'),
            viewModalForm = $('#showViewWindow');


        $(e.target).find('#exampleModalLabel').html('Edit User: ' + userName);

        $.ajax({
            url: 'ajax.php',
            type: 'post',
            context: this,
            data: {
                action: 'empm_get_user_details',
                user_name: userName,
            },
            success: function (result) {

                let response = JSON.parse(result);

                if (response.status) {

                    // For View
                    if (thisButton.hasClass('view-user-data')) {
                        $.each(response.message, function (key, value) {
                            viewModalForm.find('.' + key).html(value);
                        });
                    }

                    // For Edit
                    if (thisButton.hasClass('edit-user-data')) {
                        $.each(response.message, function (key, value) {

                            let thisField = modalForm.find('.' + key),
                                thisFieldTag = thisField.prop("tagName"),
                                thisFieldType = thisField.attr('type');

                            if (thisFieldTag == 'INPUT' && thisFieldType == 'radio') {
                                modalForm.find('input[value="' + value + '"].' + key).prop("checked", true);
                            } else {
                                thisField.val(value);
                            }
                        });
                    }
                }
            }
        });
    });

    $(document).on('hide.bs.modal', function () {
        $('form.modal-user-update').trigger('reset');
    });

    $(document).on('submit', 'form.modal-user-update', function () {

        let modalForm = $(this),
            modalFormData = modalForm.serialize(),
            usersTable = $('.table-users');

        $.ajax({
            url: 'ajax.php',
            type: 'post',
            context: this,
            data: {
                action: 'empm_update_user_details',
                form_data: modalFormData,
            },
            success: function (result) {

                let response = JSON.parse(result);

                if (response.status) {

                    // update the row data
                    usersTable.find('tr[data-user-id="' + response.user_id + '"]').html(response.message);

                    // Close the modal
                    $('.modal').modal('hide');
                }
            }
        });


        return false;
    });
})(jQuery)