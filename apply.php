<?php

session_start();

include 'config/db.php';

// User must login
if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
}

$job_id = $_GET['id'];

$message = "";

// Fetch Job
$jobQuery = mysqli_query($conn, "SELECT * FROM jobs WHERE id=$job_id");

$job = mysqli_fetch_assoc($jobQuery);

if(isset($_POST['apply']))
{
    $user_id = $_SESSION['user_id'];

    // Resume Upload
    $resume = $_FILES['resume']['name'];

    $temp_name = $_FILES['resume']['tmp_name'];

    $folder = "uploads/" . $resume;

    move_uploaded_file($temp_name, $folder);
    $check = mysqli_query($conn,
"SELECT * FROM applications
 WHERE user_id='$user_id'
 AND job_id='$job_id'");

if(mysqli_num_rows($check) > 0)
{
    $message = "<div class='alert alert-warning'>
                    You already applied for this job
                </div>";
}
else
{

    // Insert Application
    $sql = "INSERT INTO applications(user_id, job_id, resume)
            VALUES('$user_id','$job_id','$resume')";

    if(mysqli_query($conn, $sql))
{
    $message = "<div class='alert alert-success'>
                    Application Submitted Successfully
                </div>";
}
else
{
    die(mysqli_error($conn));
}

  
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Apply Job</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
      href="assets/css/style.css">

</head>

<body>

<?php include 'includes/navbar.php'; ?>

<main>

<div class="container py-5">

    <div class="row justify-content-center align-items-center">

        <div class="col-lg-7">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body p-5">

                    <!-- Heading -->
                    <div class="text-center mb-4">

                        <h1 class="fw-bold">
                            Apply For Job
                        </h1>

                        <p class="text-muted">
                            Submit your resume for this opportunity
                        </p>

                    </div>

                    <?php echo $message; ?>

                    <!-- Job Details -->
                    <div class="job-info rounded-4 p-4 mb-4">

                        <h3 class="fw-bold mb-3">
                            <?php echo $job['title']; ?>
                        </h3>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <p class="mb-1 text-muted">
                                    Company
                                </p>

                                <h6>
                                    <?php echo $job['company']; ?>
                                </h6>

                            </div>

                            <div class="col-md-6 mb-3">

                                <p class="mb-1 text-muted">
                                    Location
                                </p>

                                <h6>
                                    <?php echo $job['location']; ?>
                                </h6>

                            </div>

                        </div>

                    </div>

                    <!-- Form -->
                    <form method="POST"
                          enctype="multipart/form-data">

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Upload Resume

                            </label>

                            <input type="file"
                                   name="resume"
                                   class="form-control form-control-lg"
                                   required>

                        </div>

                        <div class="d-grid">

                            <button type="submit"
                                    name="apply"
                                    class="btn btn-success btn-lg">

                                Submit Application

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</main>

<?php include 'includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
