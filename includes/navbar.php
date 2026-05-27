<?php

if(session_status() === PHP_SESSION_NONE)
{
    session_start();
}

// Detect admin folder
$isAdmin = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;

$base = $isAdmin ? '../' : '';

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">

        <a class="navbar-brand fw-bold"
           href="<?php echo $base; ?>index.php">

            Job Portal

        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
             id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <!-- Show Home only for normal users and guests -->
                <?php if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') { ?>

                <li class="nav-item">

                    <?php

// Guest users
if(!isset($_SESSION['user_id']))
{
?>

<li class="nav-item">

    <a class="nav-link"
       href="<?php echo $base; ?>index.php">

        Home

    </a>

</li>

<?php
}

// Normal users
else if($_SESSION['role'] == 'user')
{
?>

<li class="nav-item">

    <a class="nav-link"
       href="<?php echo $base; ?>dashboard.php">

        Dashboard

    </a>

</li>

<?php
}
?>

                </li>

                <?php } ?>

                <!-- Jobs -->
                <?php if(isset($_SESSION['user_id'])) { ?>

<li class="nav-item">

<?php if(isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin') { ?>

    <a class="nav-link"
       href="<?php echo $base; ?>admin/jobs.php">

        Jobs

    </a>

<?php } else { ?>

    <a class="nav-link"
       href="<?php echo $base; ?>jobs.php">

        Jobs

    </a>

<?php } ?>

</li>
<?php } ?>

                <?php if(isset($_SESSION['user_id'])) { ?>

                    <!-- Admin Navbar -->
                    <?php if($_SESSION['role'] == 'admin') { ?>

                        <li class="nav-item">

                            <a class="nav-link"
                               href="<?php echo $base; ?>admin/dashboard.php">

                                Dashboard

                            </a>

                        </li>

                    <?php } else { ?>

                        <!-- Normal User Navbar -->
                        <li class="nav-item">

                            <a class="nav-link"
                               href="<?php echo $base; ?>profile.php">

                                My Applications

                            </a>

                        </li>

                    <?php } ?>

                    <!-- Logout -->
                    <li class="nav-item">

                        <a class="nav-link"
                           href="<?php echo $base; ?>logout.php">

                            Logout

                        </a>

                    </li>

                <?php } else { ?>

                    <!-- Guest Navbar -->
                    <li class="nav-item">

                        <a class="nav-link"
                           href="<?php echo $base; ?>login.php">

                            Login

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link"
                           href="<?php echo $base; ?>register.php">

                            Register

                        </a>

                    </li>

                <?php } ?>

            </ul>

        </div>

    </div>

</nav>