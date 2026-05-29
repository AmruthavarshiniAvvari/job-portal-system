<?php


session_start();

include 'config/db.php';

$message = "";

if(isset($_POST['login']))
{
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(empty($email) || empty($password))
    {
        $message = "<div class='alert alert-danger'>
                        All fields are required
                    </div>";
    }

    else
    {
        $sql = "SELECT * FROM users WHERE email='$email'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1)
        {
            $user = mysqli_fetch_assoc($result);

            // Verify Password
            if(password_verify($password, $user['password']))
            {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                if($user['role'] == 'admin')
                {
                    header("Location: admin/dashboard.php");
                }

                else
                {
                    header("Location: dashboard.php");
                }
            }

            else
            {
                $message = "<div class='alert alert-danger'>
                                Invalid Password
                            </div>";
            }
        }

        else
        {
            $message = "<div class='alert alert-danger'>
                            Email not found
                        </div>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
<main>

<?php include 'includes/navbar.php'; ?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h2 class="text-center mb-4">
                        Login
                    </h2>

                    <?php echo $message; ?>

                    <form method="POST">

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

                        <button type="submit"
                                name="login"
                                class="btn btn-primary w-100">

                            Login

                        </button>

                    </form>

                    <p class="text-center mt-3">

                        Don't have an account?

                        <a href="register.php">
                            Register
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