<?php
/**
 * Side Navigation
 */

?>
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>

            <?php if (empm_is_user_administrator()) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">
                        <span data-feather="users"></span>
                        <span>Users</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span data-feather="bar-chart-2"></span>
                        Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span data-feather="layers"></span>
                        <span>Settings</span>
                    </a>
                </li>

            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">
                        <span data-feather="profile"></span>
                        <span>Profile</span>
                    </a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link" href="?logout=true">
                    <span data-feather="log-out"></span>
                    <span>Sign out</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
