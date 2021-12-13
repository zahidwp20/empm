<?php
/**
 * Header Template
 */

include './inc/functions.php';
include './inc/conn.php';


// Login check
$curr_script_name = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '';
$curr_script_name = explode('/', $curr_script_name);
$exclude_pages = array('login.php', 'register.php');

if (empty(empm_current_user_id()) && !in_array(end($curr_script_name), $exclude_pages)) {
    header('Location: login.php');
}


// Sign out handling
if (empm_get_var('logout', $_GET) === 'true') {

    // Remove cookie data
    setcookie('user_logged_in', '');

    // Redirect to login page
    header('Location: login.php');
}

$current_user_id = empm_current_user_id();
$current_user = empm_get_user($current_user_id);
$current_user_name = empm_get_var('user_name', $current_user);

?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.88.1">
        <title>Employee Management Application</title>
        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <meta name="theme-color" content="#7952b3">

        <!-- Custom styles for this template -->
        <link href="https://getbootstrap.com/docs/5.1/examples/dashboard/dashboard.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
        <link href="assets/css/style.css" rel="stylesheet">
    </head>

<body>


<?php if (!in_array('login.php', $curr_script_name) && !in_array('register.php', $curr_script_name)) : ?>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?php echo empm_get_option('project_name'); ?></a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="dropdown me-3">
            <a class="btn btn-secondary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $current_user_name; ?>
            </a>

            <ul class="dropdown-menu">
                <!--                <li><a class="dropdown-item" href="#">Action</a></li>-->
                <li><a class="nav-link px-3" href="?logout=true">Sign out</a></li>
            </ul>
        </div>

        <!--        <div class="navbar-nav">-->
        <!--            <div class="nav-item text-nowrap">-->
        <!--                <a href=""></a>-->
        <!--                <a class="nav-link px-3" href="?logout=true">Sign out</a>-->
        <!--            </div>-->
        <!--        </div>-->
    </header>
<?php endif; ?>