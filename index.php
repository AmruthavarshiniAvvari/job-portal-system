<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Job Portal</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <main>

<?php include 'includes/navbar.php'; ?>

<div class="container mt-5">

    <!-- Hero Section -->
    <div class="hero-section text-center">

        <h1 class="display-4 fw-bold">
            Find Your Dream Job
        </h1>

        <p class="lead mt-3">
            Search and apply for jobs from top companies
        </p>

        <a href="register.php" class="btn btn-light btn-lg mt-3">
            Get Started
        </a>

    </div>

    <!-- Featured Jobs -->
    <section class="mt-5">

    <h2 class="text-center mb-5">
        Why Choose Us
    </h2>

    <div class="row g-4">

        <div class="col-md-4">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body text-center p-4">

                    <h1>💼</h1>

                    <h4 class="mt-3">
                        Easy Job Search
                    </h4>

                    <p>
                        Find jobs quickly with live search and filters.
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body text-center p-4">

                    <h1>📄</h1>

                    <h4 class="mt-3">
                        Resume Upload
                    </h4>

                    <p>
                        Upload resumes and apply for jobs easily.
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body text-center p-4">

                    <h1>📊</h1>

                    <h4 class="mt-3">
                        Application Tracking
                    </h4>

                    <p>
                        Track your application status in real time.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

</main>

<?php include 'includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>