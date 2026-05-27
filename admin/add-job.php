<?php

session_start();

include '../config/db.php';

// Admin Protection
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../login.php");
}

// Add Job
if(isset($_POST['add_job']))
{
    $title = $_POST['title'];

    $company = $_POST['company'];

    $location = $_POST['location'];

    $salary = $_POST['salary'];

    $description = $_POST['description'];

    $sql = "INSERT INTO jobs(title, company, location, salary, description)
            VALUES('$title', '$company', '$location', '$salary', '$description')";

    if(mysqli_query($conn, $sql))
    {
        header("Location: jobs.php?success=1");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Add Job</title>

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

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body p-4">

                    <!-- Heading -->
                    <div class="text-center mb-4">

                        <h2 class="fw-bold">
                            ➕ Add New Job
                        </h2>

                        <p class="text-muted">
                            Create and publish new job opportunities
                        </p>

                    </div>

                    <!-- Form -->
                    <form method="POST">

                        <!-- Job Title -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Job Title

                            </label>

                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   placeholder="Enter job title"
                                   required>

                        </div>

                        <!-- Company -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Company Name

                            </label>

                            <input type="text"
                                   name="company"
                                   class="form-control"
                                   placeholder="Enter company name"
                                   required>

                        </div>

                        <!-- Row -->
                        <div class="row">

                            <!-- Location -->
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">

                                    Location

                                </label>

                                <input type="text"
                                       name="location"
                                       class="form-control"
                                       placeholder="Enter location"
                                       required>

                            </div>

                            <!-- Salary -->
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">

                                    Salary

                                </label>

                                <input type="text"
                                       name="salary"
                                       class="form-control"
                                       placeholder="Enter salary"
                                       required>

                            </div>

                        </div>

                        <!-- Description -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Job Description

                            </label>

                            <textarea name="description"
                                      rows="4"
                                      class="form-control"
                                      placeholder="Enter detailed job description"
                                      required></textarea>

                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-3">

                            <button type="submit"
                                    name="add_job"
                                    class="btn btn-primary">

                                Publish Job

                            </button>

                            <a href="dashboard.php"
                               class="btn btn-outline-secondary">

                                Cancel

                            </a>

                        </div>

                    </form>

                </div>

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