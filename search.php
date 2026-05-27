<?php

include 'config/db.php';

$keyword = $_GET['keyword'];

$sql = "SELECT * FROM jobs
        WHERE title LIKE '%$keyword%'
        OR company LIKE '%$keyword%'
        OR location LIKE '%$keyword%'
        ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0)
{
    while($job = mysqli_fetch_assoc($result))
    {
?>

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

            <a href="apply.php?id=<?php echo $job['id']; ?>"
               class="btn btn-primary">

                Apply Now

            </a>

        </div>

    </div>

</div>

<?php
    }
}

else
{
    echo "<h4 class='text-center text-danger'>
            No Jobs Found
          </h4>";
}
?>