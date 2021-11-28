<?php
/**
 * All functions here
 */


if (!function_exists('empm_get_var')) {
    /**
     * Return var from variable $args
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
     * Return User data from username or user ID
     *
     * @param $username_or_id
     * @return false
     */
    function empm_get_user($username_or_id)
    {

        $conn = empm_get_var('conn');

        if (is_numeric($username_or_id)) {
            $sql = "SELECT * FROM " . EMPM_TBL_USERS . " WHERE `id` = '$username_or_id' LIMIT 1";
        } else {
            $sql = "SELECT * FROM " . EMPM_TBL_USERS . " WHERE `user_name` = '$username_or_id' LIMIT 1";
        }

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

if (!function_exists('empm_get_user_row')) {
    /**
     * Return HTML for an user row
     *
     * @param $user_id
     * @return false|string
     */
    function empm_get_user_row($user_id)
    {
        $user = empm_get_user($user_id);
        $current_user = empm_get_user(empm_current_user_id());

        ob_start();
        ?>
        <td><?php echo $user_id; ?> <span class="d-none user-name" data-user-name="<?php echo empm_get_var('user_name', $user); ?>"></span></td>
        <td><?php echo empm_get_var('first_name', $user) . empm_get_var('last_name', $user); ?></td>
        <td><?php echo empm_get_var('user_name', $user); ?></td>
        <td><?php echo empm_get_var('email_address', $user); ?></td>
        <td><?php echo ucwords(empm_get_var('user_role', $user)); ?></td>
        <td><?php echo ucwords(empm_get_var('status', $user)); ?></td>
        <td>
            <a href="" class="btn btn-primary btn-sm">View</a>

            <?php if ($user_id != empm_current_user_id() && empm_get_var('user_role', $current_user) == 'administrator') : ?>

                <?php if (empm_get_var('status', $user) == 'pending') : ?>
                    <a href="" class="btn btn-success btn-sm empm-update-user-status" data-status-target="active">Activate</a>
                    <a href="" class="btn btn-warning btn-sm empm-update-user-status" data-status-target="deactive">Deactivate</a>
                <?php elseif (empm_get_var('status', $user) == 'active') : ?>
                    <a href="" class="btn btn-warning btn-sm empm-update-user-status" data-status-target="deactive">Deactivate</a>
                <?php elseif (empm_get_var('status', $user) == 'deactive') : ?>
                    <a href="" class="btn btn-success btn-sm empm-update-user-status" data-status-target="active">Activate</a>
                <?php endif; ?>

            <?php endif; ?>

            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#showEditWindow">Edit</button>
        </td>
        <?php
        return ob_get_clean();
    }
}

function empm_is_user_administrator($user_id_user_name = '')
{
    $user_id_user_name = empty($user_id_user_name) ? empm_current_user_id() : $user_id_user_name;
    $user_role = empm_get_var('user_role', empm_get_user($user_id_user_name));

    return $user_role == 'administrator';
}