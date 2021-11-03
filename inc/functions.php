<?php
/**
 * All functions here
 */


if (!function_exists('empm_get_var')) {
    /**
     * Return var from session
     *
     * @param $session_key
     * @return mixed|string
     */
    function empm_get_var($session_key)
    {
        return isset($_SESSION[$session_key]) ? $_SESSION[$session_key] : '';
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
        $table = empm_get_var('db_tbl_users');
        $password = md5($pw);
        $sql = "INSERT INTO $table (user_name, email_address, password) VALUES ('$un', '$email', '$password')";

        if (!$conn->query($sql)) {
            return $conn->error;
        }

        return $conn->insert_id;
    }
}