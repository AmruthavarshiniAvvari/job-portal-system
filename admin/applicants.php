<?php

session_start();

include '../config/db.php';

// Admin Protection
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../login.php");
}

// Fetch Applicants
$sql = "SELECT applications.*,
        users.name,
        users.email,
        jobs.title
        FROM applications
        JOIN users ON applications.user_id = users.id
        JOIN jobs ON applications.job_id = jobs.id
        ORDER BY applications.id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Applicants</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet"
          href="../assets/css/style.css">

</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Job Applicants</h2>

        <a href="dashboard.php"
           class="btn btn-dark">

            Back

        </a>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead >

                    <tr>

                        <th>ID</th>
                        <th>Applicant</th>
                        <th>Email</th>
                        <th>Job Title</th>
                        <th>Resume</th>
                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                <?php while($row = mysqli_fetch_assoc($result)) { ?>

                    <tr>

                        <td>
                            <?php echo $row['id']; ?>
                        </td>

                        <td>
                            <?php echo $row['name']; ?>
                        </td>

                        <td>
                            <?php echo $row['email']; ?>
                        </td>

                        <td>
                            <?php echo $row['title']; ?>
                        </td>

                        <td>

                            <a href="../uploads/<?php echo $row['resume']; ?>"
                               target="_blank"
                               class="btn btn-primary btn-sm">

                                View Resume

                            </a>

                        </td>

                        <td>

    <form method="POST" action="update-status.php">

        <input type="hidden"
               name="application_id"
               value="<?php echo $row['id']; ?>">

        <select name="status"
                class="form-select"
                onchange="this.form.submit()">

            <option value="Pending"
                <?php if($row['status'] == 'Pending') echo 'selected'; ?>>

                Pending

            </option>

            <option value="Approved"
                <?php if($row['status'] == 'Approved') echo 'selected'; ?>>

                Approved

            </option>

            <option value="Rejected"
                <?php if($row['status'] == 'Rejected') echo 'selected'; ?>>

                Rejected

            </option>

        </select>

    </form>

</td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>