<?php

session_start();

include 'config/db.php';

// User must login
if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];

// Count applications
$appCount = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM applications
         WHERE user_id='$user_id'"
    )
);

// Latest applications
$sql = "SELECT jobs.title,
        jobs.company,
        applications.status,
        applications.created_at
        FROM applications
        JOIN jobs
        ON applications.job_id = jobs.id
        WHERE applications.user_id='$user_id'
        ORDER BY applications.id DESC
        LIMIT 5";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>User Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet"
          href="assets/css/style.css">

</head>

<body class="bg-light">

<?php include 'includes/navbar.php'; ?>

<main>

<div class="container py-5">

    <!-- Welcome Section -->
    <div class="mb-5">

        <h1 class="fw-bold">
            Welcome,
            <?php echo $_SESSION['user_name']; ?>
        </h1>

        <p class="text-muted">
            Track your job applications and explore opportunities.
        </p>

    </div>

    <!-- Dashboard Cards -->
    <div class="row g-4">

        <!-- Total Applications -->
        <div class="col-md-4 d-flex">

            <div class="card bg-primary text-white shadow-lg border-0 rounded-4 w-100">

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

        <!-- Explore Jobs -->
        <div class="col-md-4 d-flex">

            <div class="card bg-success text-white shadow-lg border-0 rounded-4 w-100">

                <div class="card-body text-center p-4">

                    <h1>
                        💼
                    </h1>

                    <h5 class="mt-3">
                        Explore Jobs
                    </h5>

                    <a href="jobs.php"
                       class="btn btn-light mt-3">

                        View Jobs

                    </a>

                </div>

            </div>

        </div>

        <!-- My Applications -->
        <div class="col-md-4 d-flex">

            <div class="card bg-warning text-dark shadow-lg border-0 rounded-4 w-100">

                <div class="card-body text-center p-4">

                    <h1>
                        👤
                    </h1>

                    <h5 class="mt-3">
                        My Applications
                    </h5>

                    <a href="profile.php"
                       class="btn btn-dark mt-3">

                        View Profile

                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- Recent Applications -->
    <div class="card shadow-lg border-0 rounded-4 mt-5">

        <div class="card-body p-4">

            <h3 class="mb-4">
                Recent Applications
            </h3>

            <?php if(mysqli_num_rows($result) > 0) { ?>

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>

                                <th>Job</th>
                                <th>Company</th>
                                <th>Status</th>
                                <th>Date</th>

                            </tr>

                        </thead>

                        <tbody>

                        <?php while($row = mysqli_fetch_assoc($result)) { ?>

                            <tr>

                                <td>
                                    <?php echo $row['title']; ?>
                                </td>

                                <td>
                                    <?php echo $row['company']; ?>
                                </td>

                                <td>

                                    <span class="badge bg-warning text-dark">

                                        <?php echo $row['status']; ?>

                                    </span>

                                </td>

                                <td>
                                    <?php echo $row['created_at']; ?>
                                </td>

                            </tr>

                        <?php } ?>

                        </tbody>

                    </table>

                </div>

            <?php } else { ?>

                <div class="alert alert-info">

                    You have not applied for any jobs yet.

                </div>

            <?php } ?>

        </div>

    </div>

</div>

</main>

<?php include 'includes/footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>