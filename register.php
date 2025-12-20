<?php
require "includes/nav.php";
require "connect_db.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["first_name"])) {
        $errors[] = "Enter your first name.";
    } else {
        $fn = mysqli_real_escape_string($link, trim($_POST["first_name"]));
    }

    if (empty($_POST["last_name"])) {
        $errors[] = "Enter your last name.";
    } else {
        $ln = mysqli_real_escape_string($link, trim($_POST["last_name"]));
    }

    if (empty($_POST["email"])) {
        $errors[] = "Enter your email address.";
    } else {
        $e = mysqli_real_escape_string($link, trim($_POST["email"]));
    }

    if (!empty($_POST["pass1"])) {
        if ($_POST["pass1"] != $_POST["pass2"]) {
            $errors[] = "Passwords do not match.";
        } else {
            $p = mysqli_real_escape_string($link, trim($_POST["pass1"]));
        }
    } else {
        $errors[] = "Enter your password.";
    }

    if (empty($errors)) {
        $q = "SELECT user_id FROM users WHERE email='$e'";
        $r = mysqli_query($link, $q);
        if (mysqli_num_rows($r) != 0) {
            $errors[] = "Email address already registered.";
        }
    }

    if (empty($errors)) {
        $q = "INSERT INTO users (first_name, last_name, email, pass, reg_date)
              VALUES ('$fn','$ln','$e','$p',NOW())";
        mysqli_query($link, $q);

        echo '
        <div class="container mt-5">
            <div class="alert alert-success">
                <h4 class="alert-heading">Registration Successful</h4>
                <p>You are now registered.</p>
                <hr>
                <a href="login.php" class="btn btn-primary">Login</a>
            </div>
        </div>';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register – READIFY</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-body">

                    <h3 class="text-center mb-4">Register</h3>

                    <?php
                    if (!empty($errors)) {
                        echo '<div class="alert alert-danger">';
                        foreach ($errors as $msg) {
                            echo $msg . '<br>';
                        }
                        echo '</div>';
                    }
                    ?>

                    <form action="register.php" method="post">

                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control"
                                   value="<?php if (isset($_POST["first_name"])) echo $_POST["first_name"]; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control"
                                   value="<?php if (isset($_POST["last_name"])) echo $_POST["last_name"]; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                   value="<?php if (isset($_POST["email"])) echo $_POST["email"]; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="pass1" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="pass2" class="form-control">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Register</button>
                        </div>

                    </form>

                    <p class="text-center mt-3">
                        Already have an account?
                        <a href="login.php">Login</a>
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
