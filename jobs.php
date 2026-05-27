<?php

session_start();

include 'config/db.php';

// Fetch Jobs
$jobs = mysqli_query($conn, "SELECT * FROM jobs ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Available Jobs</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
<main>

<?php include 'includes/navbar.php'; ?>

<div class="container mt-5">

    <h2 class="text-center mb-5">
        Available Jobs
    </h2>

    <!-- Search Bar -->
    <div class="row mb-4">

        <div class="col-md-6 mx-auto">

            <input type="text"
                   id="search"
                   class="form-control form-control-lg"
                   placeholder="Search jobs...">

        </div>

    </div>

    <!-- Job Results -->
    <div class="row g-4" id="jobResults">

        <?php while($job = mysqli_fetch_assoc($jobs)) { ?>

        <div class="col-md-4">

            <div class="card shadow-sm h-100">

                <div class="card-body">

                    <h4>
                        <?php echo $job['title']; ?>
                    </h4>

                    <p>
                        <strong>Company:</strong>
                        <?php echo $job['company']; ?>
                    </p>

                    <p>
                        <strong>Location:</strong>
                        <?php echo $job['location']; ?>
                    </p>

                    <p>
                        <strong>Salary:</strong>
                        <?php echo $job['salary']; ?>
                    </p>

                    <p>
                        <?php echo substr($job['description'], 0, 100); ?>...
                    </p>

                    <a href="apply.php?id=<?php echo $job['id']; ?>"
                       class="btn btn-primary">

                        Apply Now

                    </a>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>

</div>
</main>

<?php include 'includes/footer.php'; ?>

<script src="assets/js/script.js"></script>

</body>
</html>