<?php

session_start();

include '../config/db.php';

// Admin Protection
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../login.php");
}

// Counts
$userCount = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM users")
);

$jobCount = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM jobs")
);

$appCount = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM applications")
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet"
          href="../assets/css/style.css">

</head>

<body>

<!-- Navbar -->
<?php include '../includes/navbar.php'; ?>

<div class="container py-5">

    <!-- Heading -->
    <div class="mb-5">

        <h1 class="fw-bold">
            Welcome Admin,
            <?php echo $_SESSION['user_name']; ?>
        </h1>

        <p class="text-muted">
            Manage jobs, users, and applications efficiently.
        </p>

    </div>

    <!-- Statistics Cards -->
    <div class="row g-4">

        <!-- Users -->
        <div class="col-md-4">

            <div class="card bg-primary text-white shadow-lg border-0 rounded-4">

                <div class="card-body text-center p-4">

                    <h1>
                        👥 <?php echo $userCount; ?>
                    </h1>

                    <h5 class="mt-3">
                        Total Users
                    </h5>

                </div>

            </div>

        </div>

        <!-- Jobs -->
        <div class="col-md-4">

            <div class="card bg-success text-white shadow-lg border-0 rounded-4">

                <div class="card-body text-center p-4">

                    <h1>
                        💼 <?php echo $jobCount; ?>
                    </h1>

                    <h5 class="mt-3">
                        Total Jobs
                    </h5>

                </div>

            </div>

        </div>

        <!-- Applications -->
        <div class="col-md-4">

            <div class="card bg-warning text-dark shadow-lg border-0 rounded-4">

                <div class="card-body text-center p-4">

                    <h1>
                        📄 <?php echo $appCount; ?>
                    </h1>

                    <h5 class="mt-3">
                        Total Applications
                    </h5>

                </div>

            </div>

        </div>

    </div>

    <!-- Action Buttons -->
    <div class="d-flex gap-3 mt-5 flex-wrap">

        <a href="add-job.php"
           class="btn btn-primary btn-lg">

            ➕ Add New Job

        </a>

        <a href="jobs.php"
           class="btn btn-success btn-lg">

            📋 Manage Jobs

        </a>

        <a href="applicants.php"
           class="btn btn-warning btn-lg">

            👨‍💼 View Applicants

        </a>

    </div>

</div>

<!-- Bootstrap JS -->
 <script src="assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>