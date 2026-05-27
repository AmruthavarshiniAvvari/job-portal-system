<?php

include 'config/db.php';

$message = "";

if(isset($_POST['register']))
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validation
    if(empty($name) || empty($email) || empty($password) || empty($confirm_password))
    {
        $message = "<div class='alert alert-danger'>All fields are required</div>";
    }

    elseif($password != $confirm_password)
    {
        $message = "<div class='alert alert-danger'>Passwords do not match</div>";
    }

    else
    {
        // Check duplicate email
        $checkEmail = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $checkEmail);

        if(mysqli_num_rows($result) > 0)
        {
            $message = "<div class='alert alert-danger'>Email already exists</div>";
        }

        else
        {
            // Password Hashing
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert Query
            $sql = "INSERT INTO users(name, email, password)
                    VALUES('$name', '$email', '$hashedPassword')";

            if(mysqli_query($conn, $sql))
            {
                $message = "<div class='alert alert-success'>
                                Registration Successful
                            </div>";
            }

            else
            {
                $message = "<div class='alert alert-danger'>
                                Something went wrong
                            </div>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <main>

<?php include 'includes/navbar.php'; ?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h2 class="text-center mb-4">
                        Register
                    </h2>

                    <?php echo $message; ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label>Name</label>

                            <input type="text"
                                   name="name"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>

                            <input type="email"
                                   name="email"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>

                            <input type="password"
                                   name="password"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Confirm Password</label>

                            <input type="password"
                                   name="confirm_password"
                                   class="form-control">
                        </div>

                        <button type="submit"
                                name="register"
                                class="btn btn-primary w-100">

                            Register

                        </button>

                    </form>

                    <p class="text-center mt-3">

                        Already have an account?

                        <a href="login.php">
                            Login
                        </a>

                    </p>

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