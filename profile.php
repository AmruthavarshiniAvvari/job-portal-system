<?php

session_start();

include 'config/db.php';

// User must login
if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];

// Fetch Applied Jobs
$sql = "SELECT applications.*,
        jobs.title,
        jobs.company,
        jobs.location
        FROM applications
        JOIN jobs ON applications.job_id = jobs.id
        WHERE applications.user_id = '$user_id'
        ORDER BY applications.id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>My Applications</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link rel="stylesheet"
      href="assets/css/style.css">

</head>

<body>
    <main>

<?php include 'includes/navbar.php'; ?>

<div class="card shadow-lg border-0 rounded-4 mt-4">

    <div class="card-body p-4">

        <h2 class="mb-4 fw-bold">
            My Applications
        </h2>

        <?php if(mysqli_num_rows($result) > 0) { ?>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Applied Date</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php while($row = mysqli_fetch_assoc($result)) { ?>

                        <tr>

                            <td>
                                <?php echo $row['id']; ?>
                            </td>

                            <td>
                                <?php echo $row['title']; ?>
                            </td>

                            <td>
                                <?php echo $row['company']; ?>
                            </td>

                            <td>
                                <?php echo $row['location']; ?>
                            </td>

                            <td>

                                <?php
                                $status = $row['status'];

                                if($status == 'Approved')
                                {
                                    echo "<span class='badge bg-success'>Approved</span>";
                                }

                                else if($status == 'Rejected')
                                {
                                    echo "<span class='badge bg-danger'>Rejected</span>";
                                }

                                else
                                {
                                    echo "<span class='badge bg-warning text-dark'>Pending</span>";
                                }
                                ?>

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

                No applications found.

            </div>

        <?php } ?>

    </div>

</div>
</main>
<?php include 'includes/footer.php'; ?>

</body>
</html>