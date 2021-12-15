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

if ($action == 'empm_get_user_details') {

    $response = array();
    $user_name = empm_get_var('user_name', $_POST);
    $user_data = empm_get_user($user_name);

    if (!$user_data) {
        $response = array(
            'status' => false,
            'message' => 'User data not found!',
        );
    }

    $response = array(
        'status' => true,
        'message' => $user_data,
    );

    echo json_encode($response);
    die();
}

// Update user data 
if ($action == 'empm_update_user_details') {

    $conn = empm_get_var('conn');
    $_form_data = empm_get_var('form_data', $_POST);

    parse_str($_form_data, $form_data);

    $user_id = empm_get_var('id', $form_data);

    $response['status'] = empm_update_user($form_data);
    $response['message'] = empm_get_user_row($user_id);
    $response['user_id'] = $user_id;

    echo json_encode($response);
    die();
}

// Search users
//if ($action == 'empm_search_users') {
//
//    $conn = empm_get_var('conn');
//    $search_keyword = empm_get_var('s', $_POST);
//
//    $sql_search = "SELECT * FROM " . EMPM_TBL_USERS . "
//                    WHERE
//                        `first_name` LIKE '%$search_keyword%' OR
//                        `last_name` LIKE '%$search_keyword%' OR
//                        `email_address` LIKE '%$search_keyword%' OR
//                        `user_name` LIKE '%$search_keyword%'";
//    $users = array();
//
//    if (!$result = $conn->query($sql_search)) {
//        echo json_encode(array());
//        die();
//    }
//
//    while ($user = $result->fetch_assoc()) {
//        $user_id = empm_get_var('id', $user);
//        $users[] = sprintf('<tr data-user-id="%s">%s</tr>', $user_id, empm_get_user_row($user_id));
//    }
//
//    echo json_encode(array(
//        'status' => true,
//        'message' => implode(' ', $users),
//    ));
//    die();
//}

if ($action == 'empm_search_users') {

    $search_keyword = empm_get_var('s', $_POST);
    $users = array();

    foreach (empm_get_users(array('s' => $search_keyword)) as $user) {
        $user_id = empm_get_var('id', $user);
        $users[] = sprintf('<tr data-user-id="%s">%s</tr>', $user_id, empm_get_user_row($user_id));
    }

    echo json_encode(array(
        'status' => true,
        'message' => implode(' ', $users),
    ));
    die();
}