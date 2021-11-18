<?php
/**
 * All functions here
 */


if (!function_exists('empm_get_var')) {
    /**
     * Return var from anywhere
     *
     * @param $key
     * @param $args
     *
     * @return mixed|string
     */
    function empm_get_var($key, $args = array())
    {

        if (empty($args)) {
            $args = $_SESSION;
        }

        return isset($args[$key]) ? $args[$key] : '';
    }
}

if (!function_exists('empm_user_registration')) {
    /**
     * Register user and return user_id, return error when an error occurs
     *
     * @param $un
     * @param $email
     * @param $pw
     * @return mixed
     */
    function empm_user_registration($un, $email, $pw)
    {
        $conn = empm_get_var('conn');
        $password = md5($pw);
        $sql = "INSERT INTO " . EMPM_TBL_USERS . " (user_name, email_address, password) VALUES ('$un', '$email', '$password')";

        if (!$conn->query($sql)) {
            return $conn->error;
        }

        return $conn->insert_id;
    }
}

if (!function_exists('empm_check_user_login')) {
    /**
     * Check username and password to login a user. Return false if no user found with the given information.
     *
     * @param $un
     * @param $pw
     * @return false|mixed
     */
    function empm_check_user_login($un, $pw)
    {
        $pw = md5($pw);
        $conn = empm_get_var('conn');
        $sql = "SELECT (id) FROM " . EMPM_TBL_USERS . " WHERE `user_name` = '$un' AND `password` = '$pw' AND `status` = 'active' LIMIT 1";

        if (!$result = $conn->query($sql)) {
            return false;
        }

        $user_data = $result->fetch_assoc();

        if (is_array($user_data) && isset($user_data['id'])) {
            return $user_data['id'];
        }

        return false;
    }
}

if (!function_exists('empm_current_user_id')) {
    /**
     * If any user logged in then return that user ID, if no return false
     *
     * @return mixed|string
     */
    function empm_current_user_id()
    {
        return empm_get_var('user_logged_in', $_COOKIE);
    }
}

if (!function_exists('empm_get_user')) {
    /**
     * Return User data from username
     *
     * @param $username
     * @return false
     */
    function empm_get_user($username)
    {

        $conn = empm_get_var('conn');
        $sql = "SELECT * FROM " . EMPM_TBL_USERS . " WHERE `user_name` = '$username' LIMIT 1";

        if (!$result = $conn->query($sql)) {
            return false;
        }

        return $result->fetch_assoc();
    }
}


if (!function_exists('empm_get_users')) {
    /**
     * Return User data from username
     *
     * @return array
     */
    function empm_get_users()
    {

        $conn = empm_get_var('conn');
        $sql = "SELECT * FROM " . EMPM_TBL_USERS . " WHERE 1";
        $users = array();

        if (!$result = $conn->query($sql)) {
            return array();
        }

        while ($user = $result->fetch_assoc()) {
            $users[] = $user;
        }

        return $users;
    }
}



