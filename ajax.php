<?php
/**
 * Receive all ajax request here
 */

include './inc/functions.php';
include './inc/conn.php';

$action = empm_get_var('action', $_POST);

if ($action == 'empm_update_user_status') {

    $response = array();
    $conn = empm_get_var('conn');
    $user_id = empm_get_var('user_id', $_POST);
    $status_target = empm_get_var('status_target', $_POST);
    $sql = "UPDATE " . EMPM_TBL_USERS . " SET status = '" . $status_target . "' WHERE id = $user_id";

    if (!$conn->query($sql)) {
        $response['status'] = false;
        $response['message'] = 'Something went wrong!';
        die();
    }

    $response['status'] = true;
    $response['message'] = empm_get_user_row($user_id);

    echo json_encode($response);
    die();
}


if( $action == 'empm_get_user_details' ) {

    $response = array();
    $user_name = empm_get_var('user_name', $_POST);
    $user_data = empm_get_user($user_name);

    if( ! $user_data ) {
        $response = array(
            'status' => false,
            'message' => 'User data not found!',
        );
    }

    $response = array(
        'status' => true,
        'message' => $user_data,
    );

    echo json_encode( $response );
    die();
}

// Update user data 
if( $action == 'empm_update_user_details' ) {

    $response = array();
    $conn = empm_get_var('conn');
    $_form_data = empm_get_var('form_data', $_POST);
    
    parse_str( $_form_data, $form_data );

    $user_id = empm_get_var('id', $form_data);

    $sql = "UPDATE " . EMPM_TBL_USERS . " 
            SET 
                first_name = '" . empm_get_var('first_name', $form_data) . "',
                last_name = '" . empm_get_var('last_name', $form_data) . "',
                phone_number = '" . empm_get_var('phone_number', $form_data) . "',
                designation = '" . empm_get_var('designation', $form_data) . "',
                street_address = '" . empm_get_var('street_address', $form_data) . "',
                city = '" . empm_get_var('city', $form_data) . "',
                zipcode = '" . empm_get_var('zipcode', $form_data) . "',
                country = '" . empm_get_var('country', $form_data) . "',
                gender = '" . empm_get_var('gender', $form_data) . "',
                religion = '" . empm_get_var('religion', $form_data) . "',
                salary = '" . empm_get_var('salary', $form_data) . "'
            WHERE id = $user_id";

    if (!$conn->query($sql)) {
        $response['status'] = false;
        $response['message'] = $conn->error;
        die();
    }

    $response['status'] = true;
    $response['message'] = empm_get_user_row($user_id);
    $response['user_id'] = $user_id;

    echo json_encode($response);
    die();
}