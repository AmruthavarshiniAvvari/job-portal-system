<?php

session_start();

include '../config/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../login.php");
}

$id = $_GET['id'];

$jobQuery = mysqli_query($conn, "SELECT * FROM jobs WHERE id=$id");

$job = mysqli_fetch_assoc($jobQuery);

$message = "";

if(isset($_POST['updateJob']))
{
    $title = $_POST['title'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $description = $_POST['description'];

    $sql = "UPDATE jobs
            SET
            title='$title',
            company='$company',
            location='$location',
            salary='$salary',
            description='$description'
            WHERE id=$id";

    if(mysqli_query($conn, $sql))
    {
        header("Location: jobs.php");
    }

    else
    {
        $message = "<div class='alert alert-danger'>
                        Update Failed
                    </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Job</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet"
          href="../assets/css/style.css">

</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-body">

                    <h2 class="mb-4">
                        Edit Job
                    </h2>

                    <?php echo $message; ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label>Job Title</label>

                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   value="<?php echo $job['title']; ?>">

                        </div>

                        <div class="mb-3">

                            <label>Company</label>

                            <input type="text"
                                   name="company"
                                   class="form-control"
                                   value="<?php echo $job['company']; ?>">

                        </div>

                        <div class="mb-3">

                            <label>Location</label>

                            <input type="text"
                                   name="location"
                                   class="form-control"
                                   value="<?php echo $job['location']; ?>">

                        </div>

                        <div class="mb-3">

                            <label>Salary</label>

                            <input type="text"
                                   name="salary"
                                   class="form-control"
                                   value="<?php echo $job['salary']; ?>">

                        </div>

                        <div class="mb-3">

                            <label>Description</label>

                            <textarea name="description"
                                      class="form-control"
                                      rows="5"><?php echo $job['description']; ?></textarea>

                        </div>

                        <button type="submit"
                                name="updateJob"
                                class="btn btn-primary">

                            Update Job

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>