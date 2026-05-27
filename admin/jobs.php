<?php

session_start();

include '../config/db.php';

// Admin Protection
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../login.php");
    exit();
}

// Fetch Jobs
$jobs = mysqli_query(
    $conn,
    "SELECT * FROM jobs ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Manage Jobs</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet"
          href="../assets/css/style.css">

</head>

<body>

<?php include '../includes/navbar.php'; ?>

<main>

<div class="container py-5">

    <!-- Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

        <div>

            <h1 class="fw-bold mb-1">
                Manage Jobs
            </h1>

            <p class="text-muted">
                View, edit, and manage all posted jobs
            </p>

        </div>

        <a href="add-job.php"
           class="btn btn-primary">

            ➕ Add New Job

        </a>

    </div>

    <!-- Success Message -->
    <?php if(isset($_GET['success'])) { ?>

        <div class="alert alert-success">

            Job Added Successfully

        </div>

    <?php } ?>

    <!-- Jobs Table -->
    <div class="card shadow-lg border-0 rounded-4">

        <div class="card-body p-4">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Title</th>
                            <th>Company</th>
                            <th>Location</th>
                            <th>Salary</th>
                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php if(mysqli_num_rows($jobs) > 0) { ?>

                        <?php while($job = mysqli_fetch_assoc($jobs)) { ?>

                            <tr>

                                <td>
                                    <?php echo $job['id']; ?>
                                </td>

                                <td>
                                    <?php echo $job['title']; ?>
                                </td>

                                <td>
                                    <?php echo $job['company']; ?>
                                </td>

                                <td>
                                    <?php echo $job['location']; ?>
                                </td>

                                <td>
                                    <?php echo $job['salary']; ?>
                                </td>

                                <td>

                                    <div class="d-flex gap-2">

                                        <a href="edit-job.php?id=<?php echo $job['id']; ?>"
                                           class="btn btn-warning btn-sm">

                                            Edit

                                        </a>

                                        <a href="delete-job.php?id=<?php echo $job['id']; ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Are you sure you want to delete this job?')">

                                            Delete

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php } ?>

                    <?php } else { ?>

                        <tr>

                            <td colspan="6"
                                class="text-center">

                                No jobs found.

                            </td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</main>

<?php include '../includes/footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>